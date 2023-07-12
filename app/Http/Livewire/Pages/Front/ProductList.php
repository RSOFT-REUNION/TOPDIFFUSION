<?php

namespace App\Http\Livewire\Pages\Front;

use App\Models\MyProduct;
use App\Models\MyProductCategories;
use App\Models\Product;
use App\Models\ProductCategory;
use Livewire\Component;

class ProductList extends Component
{
    public $slug;
    public $categories;
    public $arianne = [];

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->categories = ProductCategory::where('slug', $slug)->first();
    }

    public function arianneRoad()
    {
        $category = ProductCategory::where('slug', $this->slug)->first();
        if($category->parent_id != null) {
            $parent_category = ProductCategory::where('id', $category->parent_id)->first();
        }

    }

    public function render()
    {
        $data = [];
        $data['category'] = ProductCategory::where('slug', $this->slug)->first();
        $data['products'] = MyProduct::where('category_id', $this->categories->id)->paginate(8);
        return view('livewire.pages.front.product-list', $data);
    }
}
