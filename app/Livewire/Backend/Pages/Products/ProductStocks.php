<?php

namespace App\Livewire\Backend\Pages\Products;

use App\Models\ProductStock;
use Livewire\Component;

class ProductStocks extends Component
{
    public function render()
    {
        $data = [];
        $data['stock_available'] = ProductStock::where('quantity', '>', 3)->get();
        $data['stock_low'] = ProductStock::where('quantity', '<=', 3)->where('quantity', '>', 0)->get();
        $data['stock_off'] = ProductStock::where('quantity', '<', 1)->get();
        return view('livewire.backend.pages.products.product-stocks', $data);
    }
}
