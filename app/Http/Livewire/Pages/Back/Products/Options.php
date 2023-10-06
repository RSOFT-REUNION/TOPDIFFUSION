<?php

namespace App\Http\Livewire\Pages\Back\Products;

use App\Models\kitsChain;
use App\Models\kitsCrown;
use App\Models\kitsPignon;
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
        $data['pignons'] = kitsPignon::orderBy('id', 'desc')->get()->take(10);
        $data['chains'] = kitsChain::orderBy('id', 'desc')->get()->take(10);
        $data['crowns'] = kitsCrown::orderBy('id', 'desc')->get()->take(10);
        return view('livewire.pages.back.products.options', $data);
    }
}
