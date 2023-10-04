<?php

namespace App\Http\Livewire\Pages\Front;

use App\Models\MyProduct;
use App\Models\MyProductStock;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use Livewire\Component;
use App\Models\MyProductCategories;
use App\Models\Product;

class ProductList extends Component
{
    public $slug;
    public $categories;
    public $arianne = [];
    public $motor_brands = [];

    public $selectedBrands = [];

    public $startPrice, $endPrice;

    public $croissant, $decroissant;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->categories = ProductCategory::where('slug', $slug)->first();

        $this->motor_brands = ProductBrand::all();
//        $idBrand = array_keys($this->motor_brands);
//        dd($idBrand);
//        $brand = MyProduct::where('id', $this->motor_brands[0])->get();
    }

    public function arianneRoad()
    {
        $category = ProductCategory::where('slug', $this->slug)->first();
        if($category->parent_id != null) {
            $parent_category = ProductCategory::where('id', $category->parent_id)->first();
        }

    }

    public function clear()
    {
        $this->selectedBrands = [];
    }

    public function render()
    {
        $data = [];
        $data['category'] = ProductCategory::where('slug', $this->slug)->first();
//        $data['products'] = MyProduct::where('category_id', $this->categories->id)->paginate(8);
        $baseQuery = MyProduct::where('category_id', $this->categories->id);
        $data['stocks'] = MyProductStock::where('quantity', '>', 3)->get();
        $data['low_stock'] = MyProductStock::whereIn('quantity', [1, 2, 3])->get();

        // Filtrer par marque
        if ($this->selectedBrands) {
            $baseQuery->whereIn('brand_id', $this->selectedBrands);
        }

        // Filtrer par prix
        if ($this->startPrice && $this->endPrice) {
            $baseQuery = $baseQuery->join('my_product_swatches', 'my_products.id', '=', 'my_product_swatches.product_id')
                ->whereBetween('my_product_swatches.professionnal_price', [$this->startPrice, $this->endPrice]);
        }

        // Trier les produits
        if ($this->croissant) {
            $orderByField = auth()->user()->professionnal ? 'professionnal_price' : 'customer_price';
            $baseQuery->orderBy($orderByField, 'asc');
        } elseif ($this->decroissant) {
            $orderByField = auth()->user()->professionnal ? 'professionnal_price' : 'customer_price';
            $baseQuery->orderBy($orderByField, 'desc');
        }

        // Paginer les résultats
        $products = $baseQuery->paginate(8);

//        dd($products);


        $data['products'] = $products;
        return view('livewire.pages.front.product-list', $data);
    }

}

