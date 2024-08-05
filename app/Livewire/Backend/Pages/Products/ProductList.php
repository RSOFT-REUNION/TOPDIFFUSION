<?php

namespace App\Livewire\Backend\Pages\Products;

use App\Models\Product;
use Livewire\Component;

class ProductList extends Component
{
    public function render()
    {
        $data = [];
        $data['products'] = Product::orderBy('id', 'desc')->where('active', 1)->get();
        return view('livewire.backend.pages.products.product-list', $data);
    }
}