<?php

namespace App\Http\Livewire\Pages\Back\Products;

use App\Models\MyProduct;
use Livewire\Component;

class PromotionsList extends Component
{

    //

    public function render()
    {
        $data = [];
        $data['products'] = MyProduct::orderBy('created_at', 'desc')->get();
        return view('livewire.pages.back.products.promotions-list', $data);
    }
}
