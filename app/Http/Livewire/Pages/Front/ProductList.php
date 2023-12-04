<?php

namespace App\Http\Livewire\Pages\Front;

use App\Models\MyFavorite;
use App\Models\MyProduct;
use App\Models\MyProductStock;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use App\Models\SettingGeneral;
use App\Models\UserSetting;
use Livewire\Component;
use App\Models\MyProductCategories;
use App\Models\Product;

class ProductList extends Component
{
    public $slug;
    public $categories;
    public $stockStatus = ['En_stock' => false, 'Stock_faible' => false];
    protected $products;
    public $selectedBrands = [];
    public $arianne = [];
    public $motor_brands = [];
    protected $queryString = ['selectedBrands'];

    public $product;
    public $minPrice;
    public $maxPrice;

    public $sortOrder = 'asc'; // Par défaut, tri croissant

    public $isFavorite;
    public $myFavoriteProducts = [];

    public function mount($slug, $products)
    {
        $this->slug = $slug;
        $this->categories = ProductCategory::where('slug', $slug)->first();
        $this->motor_brands = ProductBrand::all();
        $this->products = $products;
        $this->isFavorite = [];

        foreach ($this->products as $product) {
            $productStock = MyProductStock::where('product_id', $product->id)->first();

            // Ajoutez une propriété stock à chaque produit
            $product->stock = $productStock ? $productStock->quantity : 0;

            // Vérifiez si le produit est en favori (si l'utilisateur est connecté)
            if (auth()->check()) {
                $this->myFavoriteProducts[$product->id] = MyFavorite::where('product_id', $product->id)
                    ->where('user_id', auth()->user()->id)
                    ->exists();
            }
        }
    }

    public function addProductToFavorite($id)
    {
        if (auth()->check()) {
            $actualUser = auth()->user()->id;

            $verifyIfProductExists = MyFavorite::where('product_id', $id)
                ->where('user_id', $actualUser)
                ->first();

            if (!$verifyIfProductExists) {
                $fav = new MyFavorite;
                $fav->user_id = $actualUser;
                $fav->product_id = $id;
                $fav->save();

                // Update the associative array with the new information
                $this->myFavoriteProducts[$id] = true;
            }
        } else {
            redirect()->route('front.login');
        }
    }

    public function deleteFavorite($id)
    {
        $user = auth()->user();
        $productId = $id;

        $favorite = MyFavorite::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        if ($favorite) {
            $favorite->delete();

            $this->myFavoriteProducts[$id] = false;
        }
    }


    public function arianneRoad()
    {
        $category = ProductCategory::where('slug', $this->slug)->first();
        if ($category->parent_id != null) {
            $parent_category = ProductCategory::where('id', $category->parent_id)->first();
        }

    }

    public function render()
    {
        $data = [];
        $data['category'] = ProductCategory::where('slug', $this->slug)->first();

        if (!$this->products) {
            $this->products = MyProduct::where('category_id', $this->categories->id)
                ->when($this->selectedBrands, function ($q) {
                    $q->whereIn('brand_id', $this->selectedBrands);
                })
                ->when($this->stockStatus['En_stock'] || $this->stockStatus['Stock_faible'], function ($q) {
                    $q->whereIn('id', function ($query) {
                        $query->select('product_id')
                            ->from('my_product_stocks')
                            ->whereIn('product_id', array_keys($this->myFavoriteProducts))
                            ->where(function ($subQuery) {
                                if ($this->stockStatus['En_stock']) {
                                    $subQuery->where('quantity', '>', 3);
                                }
                                if ($this->stockStatus['Stock_faible']) {
                                    $subQuery->whereIn('quantity', [1, 2, 3]);
                                }
                            });
                    });
                })
                ->when(auth()->check() && auth()->user()->type === 'professional', function ($q) {
                    $q->when($this->minPrice, function ($subQuery) {
                        $subQuery->whereHas('swatches', function ($subSubQuery) {
                            $subSubQuery->where('price_ht', '>=', $this->minPrice);
                        });
                    })
                        ->when($this->maxPrice, function ($subQuery) {
                            $subQuery->whereHas('swatches', function ($subSubQuery) {
                                $subSubQuery->where('price_ht', '<=', $this->maxPrice);
                            });
                        });
                }, function ($q) {
                    // Filtrez par price_ttc si l'utilisateur n'est pas un professionnel
                    $q->when($this->minPrice, function ($subQuery) {
                        $subQuery->whereHas('swatches', function ($subSubQuery) {
                            $subSubQuery->where('price_ttc', '>=', $this->minPrice);
                        });
                    })
                        ->when($this->maxPrice, function ($subQuery) {
                            $subQuery->whereHas('swatches', function ($subSubQuery) {
                                $subSubQuery->where('price_ttc', '<=', $this->maxPrice);
                            });
                        });
                })

                ->orderBy('title', $this->sortOrder)
                ->paginate(8);
        }

//        if ($this->minPrice){
//            dd($this->minPrice);
//        }

        $data['setting'] = SettingGeneral::where('id', 1)->first();
        if (auth()->user()) {
            $data['my_setting'] = UserSetting::where('user_id', auth()->user()->id)->first();
        }

        $stockInfo = [];

        foreach ($this->products as $product) {
            // Ajoutez une propriété stock à chaque produit
            $productStock = MyProductStock::where('product_id', $product->id)->first();
            $product->stock = $productStock ? $productStock->quantity : 0;

            $stockInfo[$product->id] = $productStock ? $productStock->quantity : 0;
        }

        $data['product_stock'] = $stockInfo;

        $data['products'] = $this->products;
        return view('livewire.pages.front.product-list', $data);
    }

}
