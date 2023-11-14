<?php

namespace App\Http\Livewire\Pages\Front;

use Livewire\Component;
use App\Models\MyProduct;
use App\Models\ProductCategory;

class ProductListAll extends Component
{
    public $productAll;
    public $arianne = [];

    public function mount()
    {
        $this->productAll = MyProduct::all();
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
        $data['products'] = MyProduct::orderBy('created_at', 'desc')->paginate(15);
        return view('livewire.pages.front.product-list-all', $data);
    }
}
