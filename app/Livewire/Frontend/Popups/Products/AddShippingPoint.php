<?php

namespace App\Livewire\Frontend\Popups\Products;

use App\Models\ShippingPoint;
use LivewireUI\Modal\ModalComponent;

class AddShippingPoint extends ModalComponent
{
    public $point;

    public function addShipping()
    {
        $this->dispatch('shippingPointAdded', $this->point);
        $this->closeModal();
    }

    public function render()
    {
        $data = [];
        $data['points'] = ShippingPoint::all();
        return view('livewire.frontend.popups.products.add-shipping-point', $data);
    }
}
