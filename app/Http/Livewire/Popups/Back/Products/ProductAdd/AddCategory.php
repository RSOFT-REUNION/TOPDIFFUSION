<?php

namespace App\Http\Livewire\Popups\Back\Products\ProductAdd;

use App\Models\ProductCategory;
use App\Models\ProductTemp;
use LivewireUI\Modal\ModalComponent;

class AddCategory extends ModalComponent
{
    public $product;
    public $category;

    public function mount($product_temp_id)
    {
        $this->product = ProductTemp::where('id', $product_temp_id)->first();
    }

    public function addCategory()
    {
        $temp = $this->product;
        $temp->category_id = $this->category;
        if($temp->update()) {
            $this->emit('refreshLines');
            $this->closeModal();
        }
    }

    public function render()
    {
        $data = [];
        $data['categories_level_1'] = ProductCategory::where('level', 1)->orderBy('id', 'asc')->get();
        $data['categories_level_2'] = ProductCategory::where('level', 2)->orderBy('id', 'asc')->get();
        $data['categories_level_3'] = ProductCategory::where('level', 3)->orderBy('id', 'asc')->get();
        return view('livewire.popups.back.products.product-add.add-category',$data);
    }
}
