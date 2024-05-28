<?php

namespace App\Livewire\Backend\Pages\Products;

use App\Models\Attribute;
use Livewire\Component;

class ProductAttribute extends Component
{
    public function render()
    {
        $data = [];
        $data['attributes'] = Attribute::all();
        $data['attribute_groups'] = Attribute::where('is_group', true)->orderBy('name', 'asc')->get();
        $data['attribute_items'] = Attribute::where('is_group', false)->orderBy('name', 'asc')->get();
        return view('livewire.backend.pages.products.product-attribute', $data);
    }
}
