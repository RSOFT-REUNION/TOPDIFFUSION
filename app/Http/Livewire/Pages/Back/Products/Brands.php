<?php

namespace App\Http\Livewire\Pages\Back\Products;

use App\Models\ProductBrand;
use Livewire\Component;

class Brands extends Component
{
    public function render()
    {
        $data = [];
        $data['brands'] = ProductBrand::orderBy('title', 'asc')->get();
        return view('livewire.pages.back.products.brands', $data);
    }
}
