<?php

namespace App\Http\Livewire\Pages\Back\Products;

use App\Models\bike;
use Livewire\Component;

class Bikes extends Component
{
    public function render()
    {
        $data = [];
        $data['bikes'] = bike::orderBy('marque', 'asc')->paginate(50);
        return view('livewire.pages.back.products.bikes', $data);
    }
}
