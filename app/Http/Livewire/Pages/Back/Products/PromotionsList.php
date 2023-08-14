<?php

namespace App\Http\Livewire\Pages\Back\Products;

use App\Models\MyProduct;
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
        $data['productsPromotion'] = MyProduct::whereNotNull('promotion_group')->get();
        return view('livewire.pages.back.products.promotions-list', $data);
    }
}
