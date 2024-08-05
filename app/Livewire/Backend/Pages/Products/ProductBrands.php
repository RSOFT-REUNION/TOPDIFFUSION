<?php

namespace App\Livewire\Backend\Pages\Products;

use App\Models\ProductBrand;
use Livewire\Component;
use Livewire\WithPagination;

class ProductBrands extends Component
{
    use WithPagination;

    public function render()
    {
        $data = [];
        $data['brands'] = ProductBrand::orderBy('name')->paginate(20);
        return view('livewire.backend.pages.products.product-brands', $data);
    }
}
