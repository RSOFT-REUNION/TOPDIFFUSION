<?php

namespace App\Http\Livewire\Pages\Back\Products;

use App\Models\ProductGroupTag;
use App\Models\productOption;
use Livewire\Component;

class Options extends Component
{
    public function render()
    {
        $data = [];
        $data['group'] = ProductGroupTag::orderBy('id', 'asc')->get();
        $data['options'] = productOption::orderBy('id', 'asc')->get();
        return view('livewire.pages.back.products.options', $data);
    }
}
