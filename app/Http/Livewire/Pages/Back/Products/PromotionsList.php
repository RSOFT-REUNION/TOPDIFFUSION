<?php

namespace App\Http\Livewire\Pages\Back\Products;

use App\Models\MyProduct;
use App\Models\MyProductPromotion;
use App\Models\MyProductPromotionItems;
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

    // public function changeActive($id)
    // {
    //     $groupPromotion = MyProductPromotion::where('id', $id)->first();

    //     $groupPromotion->active = !$groupPromotion->active;

    //     dd($groupPromotion->active);

    //     $groupPromotion->update();
    // }

    public function changeActive($id)
    {
        $groupPromotion = MyProductPromotion::where('id', $id)->first();
        $groupPromotion->active = !$groupPromotion->active;
        $groupPromotion->is_manually_activated = !$groupPromotion->active;
        $groupPromotion->save();

        // Demander à Livewire de rafraîchir le composant
        // $this->render();
    }

    // public function items($id)
    // {
    //     $promoItems = MyProductPromotionItems::where('product_id', $id)->first();
    //     $promoproduct = MyProduct::where('id', $promoItems->product_id)->first();
    //     return $promoproduct->cover;
    // }

    // public function items($id)
    // {
    //     $promo = MyProductPromotion::find($id);
    //     if ($promo && $promo->items->first()) {
    //         return $promo->items->first()->product->cover;
    //     }
    //     return null;
    // }

    public function render()
    {


        $data = [];
        // $data['productsPromotion'] = MyProductPromotion::whereNotNull('title')->get();
        $data['productsPromotion'] = MyProductPromotion::all();
        return view('livewire.pages.back.products.promotions-list', $data);
    }
}
