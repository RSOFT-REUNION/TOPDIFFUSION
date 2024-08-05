<?php

namespace App\Livewire\Backend\Popups\Product\AddProduct;

use App\Models\Attribute;
use App\Models\ProductData;
use LivewireUI\Modal\ModalComponent;

class AddVariant extends ModalComponent
{

    public $attribute_groups;
    public $attribute_items;

    public $selectedAttributes = [];
    public $attributesAdded = [];

    public function mount()
    {
        $this->attribute_groups = Attribute::where('is_group', true)->orderBy('name')->get();
        $this->attribute_items = Attribute::where('is_group', false)->orderBy('name')->get();
    }

    public function addVariant()
    {

        foreach ($this->selectedAttributes as $attribute)
        {
            $attri = Attribute::where('id', $attribute)->first();
            if($attri)
            {
                $this->attributesAdded[] = $attri;
            }
        }
        $this->dispatch('variantAdded', $this->attributesAdded);
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.backend.popups.product.add-product.add-variant');
    }
}
