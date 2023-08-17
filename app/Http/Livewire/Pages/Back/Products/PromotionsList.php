<?php

namespace App\Http\Livewire\Pages\Back\Products;

use App\Models\MyProduct;
use App\Models\MyProductPromotion;
use Livewire\Component;

class PromotionsList extends Component
{

    public function GoToPromoSingle($id)
    {
        return redirect()->route('back.product.promotions-group', $id);
    }

    public function render()
    {
        $data = [];
        $data['productsPromotion'] = MyProductPromotion::whereNotNull('title')->get();
        return view('livewire.pages.back.products.promotions-list', $data);
    }
}
