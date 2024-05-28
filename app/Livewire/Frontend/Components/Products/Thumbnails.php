<?php

namespace App\Livewire\Frontend\Components\Products;

use Livewire\Component;

class Thumbnails extends Component
{
    public $product;

    protected $listeners = ['cartUpdated'];

    public function mount($product)
    {
        $this->product = $product;
    }

    public function goToView()
    {
        return to_route('fo.product.single', ['slug' => $this->product->slug]);
    }

    public function render()
    {
        return view('livewire.frontend.components.products.thumbnails');
    }
}
