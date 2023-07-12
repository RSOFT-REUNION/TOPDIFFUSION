<?php

namespace App\Http\Livewire\Pages\Back\Products;

use App\Models\MyProductStock;
use App\Models\ProductStock;
use Livewire\Component;

class Stocks extends Component
{
    public function render()
    {
        $data = [];
        $data['stocks'] = MyProductStock::all();
        return view('livewire.pages.back.products.stocks', $data);
    }
}
