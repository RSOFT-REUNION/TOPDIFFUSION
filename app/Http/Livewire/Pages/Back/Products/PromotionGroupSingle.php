<?php

namespace App\Http\Livewire\Pages\Back\Products;

use App\Models\MyProduct;
use App\Models\MyProductPromotionItems;
use Livewire\Component;
use Carbon\Carbon;


class PromotionGroupSingle extends Component
{

    public $productsPromos;
    public $promoItems;
    public $groupId;

    public function mount()
    {
        $groupId = request()->route()->parameter('id');

        $this->productsPromos = MyProductPromotionItems::where('group_id', $groupId)->get();
        $this->promoItems = [];

        foreach ($this->productsPromos as $productPromo) {
            $product = MyProduct::find($productPromo->product_id);
            if ($product) {
                $this->promoItems[] = $product;
            }
        }
    }

    public function render()
    {
        return view('livewire.pages.back.products.promotion-group-single');
    }
}
