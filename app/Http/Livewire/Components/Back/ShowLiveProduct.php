<?php

namespace App\Http\Livewire\Components\Back;

use App\Models\Product;
use Livewire\Component;

class ShowLiveProduct extends Component
{

    public $product_id;

    public function mount($product_id)
    {
        $this->product_id = $product_id;
    }

    public function render()
    {
        $data = [];
        $data['product'] = Product::where('id', $this->product_id)->first();
        return view('livewire.components.back.show-live-product', $data);
    }
}
