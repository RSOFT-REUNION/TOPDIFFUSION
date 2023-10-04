<?php

namespace App\Http\Livewire\Pages\Front;

use App\Models\bike;
use App\Models\MyProduct;
use App\Models\MyProductStock;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use Livewire\Component;
use App\Models\MyProductCategories;
use App\Models\Product;
use function Symfony\Component\Translation\t;

class ProductList extends Component
{
    public $slug;
    public $categories;
    public $arianne = [];
    public $motor_brands = [];

    public $selectedBrands = [];

    public $identifiant;


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
        $data['products'] = MyProduct::where('category_id', $this->categories->id)->paginate(8);
        $data['stocks'] = MyProductStock::where('quantity', '>', 3)->get();
        $data['low_stock'] = MyProductStock::whereIn('quantity', [1, 2, 3])->get();

        // Gestion des filtres
        if ($this->selectedBrands) {
            if (count($this->selectedBrands) > 2) {
                dd($this->selectedBrands);
                $data['products'] = MyProduct::whereIn('brand_id', $this->selectedBrands)->paginate(8);
            } else {
                $data['products'] = MyProduct::where('brand_id', $this->selectedBrands)->paginate(8);
            }
        } else {
            $this->clear();
            $data['products'] = MyProduct::where('category_id', $this->categories->id)->paginate(8);
        }
        return view('livewire.pages.front.product-list', $data);
    }
}

