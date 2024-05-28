<?php

namespace App\Livewire\Backend\Popups\Product;

use LivewireUI\Modal\ModalComponent;

class AddProduct extends ModalComponent
{
    public $type;

    public function addProduct()
    {
        return redirect()->route('bo.products.add', ['type' => $this->type]);
    }

    public function render()
    {
        return view('livewire.backend.popups.product.add-product');
    }
}
