<?php

namespace App\Http\Livewire\Pages\Back\Products;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\MyProduct;
use App\Models\MyProductPromotion;
use App\Models\MyProductPromotionItems;

class PromotionsCreate extends Component
{
    public $mode;
    public $percentage, $name_promo, $dateDebut, $dateFin, $codePromo, $codePromoGen;
    public $product_selected;
    public $alex = [];
    protected $listeners = ['productsSelected' => 'addSelectedProducts'];
    public $products;

    public function addSelectedProducts($selectedProductIds) {
        $ids = array_map('intval', $selectedProductIds);
        $selectedProducts = MyProduct::whereIn('id', $ids)->get();
        $this->products = $selectedProducts->toArray();
    }

    public function deleteProduct($productId) {
        $this->products = array_filter($this->products, function ($product) use ($productId) {
            return $product['id'] !== $productId;
        });
    }

    public function formatDate($date)
    {
        return date("d/m/Y", strtotime($date));
    }

    public function generatePromoCode()
    {
        if (!$this->codePromo) {
            $this->codePromoGen = 'PROMO' . strtoupper(Str::random(3));
        }
    }

    public function create()
    {
        $productPromotion = new MyProductPromotion();

        foreach ($this->products as $value) {
            $createPromotion = MyProduct::find($value['id']);
            if ($createPromotion) {
                $productPromotion->title = $this->name_promo;
                $productPromotion->discount = $this->percentage;
                $productPromotion->code = $this->codePromoGen;


                if ($productPromotion->save()) {
                    $promoItem = new MyProductPromotionItems();
                    $promoItem->group_id = $productPromotion->id;
                    $promoItem->product_id = $createPromotion->id;
                    $promoItem->save();
                }
            }
        }
        return redirect()->route('back.product.promotions');
    }

    public function render()
    {
        $data = [];
        $data['products'] = MyProduct::orderBy('created_at', 'desc')->get();
        return view('livewire.pages.back.products.promotions-create', $data);
    }
}
