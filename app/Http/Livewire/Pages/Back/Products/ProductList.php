<?php

namespace App\Http\Livewire\Pages\Back\Products;

use App\Models\MyProduct;
use App\Models\Product;
use Livewire\Component;

class ProductList extends Component
{
    public function render()
    {
        $data = [];
        $data['products'] = MyProduct::orderBy('created_at', 'desc')->get();
        return view('livewire.pages.back.products.product-list', $data);
    }
}
