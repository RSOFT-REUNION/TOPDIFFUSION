<?php

namespace App\Livewire\Backend\Popups\Product\AddProduct;

use App\Models\ProductCategory;
use LivewireUI\Modal\ModalComponent;

class AddCategory extends ModalComponent
{
    public $category_selected;

    public static function modalMaxWidth(): string
    {
        return '6xl';
    }

    public function selectCategory()
    {
        $this->dispatch('categorySelected', $this->category_selected);
        $this->closeModal();
    }

    public function render()
    {
        $data = [];
        $data['parent_categories'] = ProductCategory::where('parent_id', null)->orderBy('name', 'asc')->get();
        $data['child_categories'] = ProductCategory::where('parent_id', '<>', null)->where('parent_id_2', null)->orderBy('name', 'asc')->get();
        $data['child_categories_2'] = ProductCategory::where('parent_id', '<>', null)->where('parent_id_2', '<>', null)->orderBy('name', 'asc')->get();
        return view('livewire.backend.popups.product.add-product.add-category', $data);
    }
}
