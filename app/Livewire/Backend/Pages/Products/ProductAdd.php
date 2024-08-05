<?php

namespace App\Livewire\Backend\Pages\Products;

use App\Models\Product;
use App\Models\ProductBike;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use App\Models\ProductData;
use App\Models\ProductInfo;
use App\Models\ProductStock;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductAdd extends Component
{
    use WithFileUploads;

    public $type, $brand, $category, $name, $slug, $description, $price, $cover, $keywords, $ugs, $kit, $kit_element;
    public $infos = [];
    public $bikes = [];
    public $variants = [];
    public $sizes = [];
    public $colors = [];

    protected $listeners = [
        'brandSelected' => 'handleBrandSelected',
        'categorySelected' => 'handleCategorySelected',
        'infosAdded' => 'handleAddInfos',
        'bikesAdded' => 'handleAddBikes',
        'variantAdded' => 'handleAddVariant'
    ];

    #[Rule([
        'name' => 'required|string|unique:products,name',
        'price' => 'required|numeric',
    ], message: [
        'name.required' => 'Le nom du produit est requis',
        'name.string' => 'Le nom du produit doit être une chaîne de caractères',
        'name.unique' => 'Ce nom de produit est déjà utilisé',
        'price.required' => 'Le prix du produit est requis',
        'price.numeric' => 'Le prix du produit doit être un nombre',
    ])]

    public function mount($type)
    {
        $this->type = $type;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function handleBrandSelected($brandId)
    {
        $this->brand = ProductBrand::find($brandId);
    }

    public function handleCategorySelected($categoryId)
    {
        $this->category = ProductCategory::find($categoryId);
    }

    public function handleAddInfos($infos)
    {
        foreach ($infos as $info) {
            // Vérifier si l'information n'existe pas déjà dans le tableau
            if (!in_array($info, $this->infos)) {
                $this->infos[] = $info;
            }
        }
    }

    public function handleAddVariant($variants)
    {
        foreach ($variants as $variant) {
            // Vérifier si l'information n'existe pas déjà dans le tableau
            if (!in_array($variants, $this->infos)) {
                $this->variants[] = $variant;
            }
        }
    }

    public function handleAddBikes($bikes)
    {
        foreach ($bikes as $bike) {
            // Vérifier si l'information n'existe pas déjà dans le tableau
            if (!in_array($bike, $this->infos)) {
                $this->bikes[] = $bike;
            }
        }
    }

    public function removeInfo($index)
    {
        unset($this->infos[$index]);
        $this->infos = array_values($this->infos);
    }

    public function removeVariant($index)
    {
        unset($this->variants[$index]);
        $this->variants = array_values($this->variants);
    }

    public function removeBike($index)
    {
        unset($this->bikes[$index]);
        $this->bikes = array_values($this->bikes);
    }

    // Fonction permettant de créer le produit
    public function createProduct()
    {
        $exist = Product::where('slug', Str::slug($this->name))->first();
        if(!$exist) {
            if($this->price != null) {
                if($this->cover){
                    $cover_name = Str::slug($this->name) . '.' . $this->cover->getClientOriginalExtension();
                } else {
                    $cover_name = null;
                }

                // Gestion des variantes
                if($this->type == 'variable') {
                    // Séparer les attributs de type 'text' et 'color'
                    foreach ($this->variants as $variant) {
                        if ($variant['type'] == 'text') {
                            $this->sizes[] = $variant;
                        } elseif ($variant['type'] == 'color') {
                            $this->colors[] = $variant;
                        }
                    }
                }

                if($this->category && $this->brand) {
                    // Création du produit
                    $product = new Product;
                    $product->type = $this->type == 'simple' && $this->kit ? 'kit' : $this->type;
                    $product->name = $this->name;
                    $product->description = $this->description;
                    $product->keywords = $this->keywords;
                    $product->slug = Str::slug($this->name);
                    $product->cover = $cover_name ? $cover_name : null;
                    $product->brand_id = $this->brand->id;
                    $product->category_id = $this->category->id;
                    if($product->save()) {
                        // Si il y a une cover
                        if($cover_name) {
                            Storage::disk('public')->putFileAs('products/covers', $this->cover, $cover_name);
                        } else {
                            return null;
                        }

                        if($this->type == 'simple') {
                            // Ajout des variantes du produit
                            $productData = new ProductData;
                            $productData->product_id = $product->id;
                            $productData->type = 0;
                            $productData->stock_state = 1;
                            $productData->ugs_code = $this->ugs;
                            $productData->price_unit = $this->price;
                            $productData->kit_element = $this->kit_element;
                            if($productData->save()) {
                                // Ajout des stocks
                                $productStock = new ProductStock;
                                $productStock->product_id = $product->id;
                                $productStock->variant_id = $productData->id;
                                $productStock->quantity = 1;
                                $productStock->save();
                            }
                        } else {
                            // Ajout des variantes du produit
                            foreach ($this->sizes as $size) {
                                foreach ($this->colors as $color) {
                                    // Ajout des variantes du produit
                                    $productData = new ProductData;
                                    $productData->product_id = $product->id;
                                    $productData->type = 0;
                                    $productData->size_name = $size['name'];
                                    $productData->size = $size['variable'];
                                    $productData->color_name = $color['name'];
                                    $productData->color = $color['variable'];
                                    $productData->ugs_code = $this->ugs;
                                    $productData->stock_state = 1;
                                    $productData->ugs_code_variant = $size['slug'] . '-' . $color['slug'];
                                    $productData->price_unit = $this->price;
                                    if ($productData->save()) {
                                        // Ajout des stocks
                                        $productStock = new ProductStock;
                                        $productStock->product_id = $product->id;
                                        $productStock->variant_id = $productData->id;
                                        $productStock->quantity = 1;
                                        $productStock->save();
                                    }
                                }
                            }
                        }


                        // Ajout des informations du produit
                        foreach ($this->infos as $info) {
                            $productInfo = new ProductInfo;
                            $productInfo->product_id = $product->id;
                            $productInfo->key = $info['key'];
                            $productInfo->value = $info['value'];
                            $productInfo->save();
                        }

                        // Ajout des motos compatibles
                        foreach ($this->bikes as $bike) {
                            $productBike = new ProductBike;
                            $productBike->product_id = $product->id;
                            $productBike->bike_id = $bike['id'];
                            $productBike->save();
                        }


                        return to_route('bo.products.list');
                    }
                }
            } else {
                $this->addError('price', 'Le prix du produit est requis');
            }
        } else {
            $this->addError('name', 'Ce nom de produit est déjà utilisé');
        }
    }

    public function render()
    {
        return view('livewire.backend.pages.products.product-add');
    }
}
