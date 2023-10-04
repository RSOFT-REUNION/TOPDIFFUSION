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

    public function formatDate($date)
    {
        return date("d/m/Y", strtotime($date));
    }

    public function changeActive($id)
    {
        $groupPromotion = MyProductPromotion::where('id', $id)->first();

        $groupPromotion->active = !$groupPromotion->active;

        // dd($groupPromotion->active);

        $groupPromotion->save();
    }

    public function render()
    {
        $data = [];
        // $data['productsPromotion'] = MyProductPromotion::whereNotNull('title')->get();
        $data['productsPromotion'] = MyProductPromotion::all();
        return view('livewire.pages.back.products.promotions-list', $data);
    }
}
