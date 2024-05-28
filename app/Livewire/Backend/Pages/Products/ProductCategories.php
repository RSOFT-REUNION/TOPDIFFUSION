<?php

namespace App\Livewire\Backend\Pages\Products;

use App\Models\ProductCategory;
use Livewire\Component;

class ProductCategories extends Component
{
    public function render()
    {
        $data = [];
        $data['parent_categories'] = ProductCategory::where('parent_id', null)->orderBy('name', 'asc')->get();
        $data['child_categories'] = ProductCategory::where('parent_id', '<>', null)->where('parent_id_2', null)->orderBy('name', 'asc')->get();
        $data['child_categories_2'] = ProductCategory::where('parent_id', '<>', null)->where('parent_id_2', '<>', null)->orderBy('name', 'asc')->get();
        return view('livewire.backend.pages.products.product-categories', $data);
    }
}
