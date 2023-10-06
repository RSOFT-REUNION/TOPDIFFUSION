<?php

namespace App\Http\Livewire\Popups\Back\Products\ProductAdd;

use App\Models\ProductBrand;
use App\Models\ProductTemp;
use LivewireUI\Modal\ModalComponent;

class AddBrand extends ModalComponent
{
    public $product;
    public $brand_check;
    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function mount($product_temp_id)
    {
        $this->product = ProductTemp::where('id', $product_temp_id)->first();
    }

    // Définir la marque
    public function addBrand()
    {
        $temp = $this->product;
        $temp->brand_id = $this->brand_check;
        if($temp->update()) {
            $this->emit('refreshLines');
            $this->closeModal();
        }
    }

    public function render()
    {
        $data = [];
        $data['brands'] = ProductBrand::orderBy('title', 'asc')->get();
        return view('livewire.popups.back.products.product-add.add-brand', $data);
    }
}
