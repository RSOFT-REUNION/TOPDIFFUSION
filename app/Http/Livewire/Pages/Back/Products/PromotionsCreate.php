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
    protected $listeners = ['productSelected' => 'handleProductSelected'];

    public function mount()
    {
        $this->product_selected = [];
    }

    // public function handleProductSelected($products)
    // {
    //     // dd($products);
    //     $existingIds = collect($this->product_selected)->pluck('id')->all();

    //     foreach ($products as $productId) {
    //         $newProduct = MyProduct::where('id', $productId)->first();
    //         if ($newProduct && !in_array($newProduct->id, $existingIds)) {
    //             $this->product_selected[] = $newProduct;
    //         }
    //     }
    // }



    public function btn() {
        dd($this->product_selected);
    }

    public function handleProductSelected($product)
    {
        $this->alex[] = $product;
        $this->product_selected = MyProduct::where('id', $product)->get();
        $this->product_selected->map(function ($item) {
            return [
                'cover' => $item->cover,
                'id' => $item->id,
            ];
        });;

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



    // public $checkedProducts = [];
    // public $checkedProduct = [];
    // public $title;
    // public $percentage;
    // public $image1;
    // public $image2;
    // public $image4;
    // public $image3;

    // public function updated($title, $value1)
    // {
    //     if ($title == "title") {
    //         $this->title = $value1;
    //     } elseif ($title == "percentage") {
    //         $this->percentage = $value1;
    //     }
    // }

    // public function getCheckedProductIds()
    // {
    //     return array_keys(array_filter($this->checkedProducts));
    // }

    // public function test()
    // {
    //     foreach ($this->checkedProducts as $key => $value) {
    //         if ($value === true) {
    //             $this->checkedProduct[] = $key;
    //         }
    //     }
    //     dd($this->checkedProduct);
    // }

    // public function create()
    // {
    //     foreach ($this->checkedProducts as $keys => $values) {
    //         if ($values === true) {
    //             $this->checkedProduct[] = $keys;
    //         }
    //     }

    //     $productPromotion = new MyProductPromotion();

    //     foreach ($this->checkedProduct as $value) {
    //         $createPromotion = MyProduct::find($value);
    //         if ($createPromotion) {
    //             $productPromotion->title = $this->title;
    //             $productPromotion->discount = $this->percentage;
    //             $productPromotion->code = 'CODE';


    //             if ($productPromotion->save()) {
    //                 $promoItem = new MyProductPromotionItems();
    //                 $promoItem->group_id = $productPromotion->id;
    //                 $promoItem->product_id = $createPromotion->id;
    //                 $promoItem->save();
    //             }
    //         }
    //     }
    //     return redirect()->route('back.product.promotions');
    // }

    // public function CheckedProducts()
    // {
    //     $checkedProductID = $this->checkedProducts;
    //     // $product = MyProduct::whereIn('id', $checkedProductID)->get()->first();
    //     // $this->image1 = $product->cover;
    //     dd($checkedProductID);
    // }

    // public function updatedCheckedProducts()
    // {
    //     $ids = $this->getCheckedProductIds();

    //     if ($ids) {
    //         // Get the first selected product
    //         $this->checkedProduct = MyProduct::find($ids[0]);
    //     } else {
    //         $this->checkedProduct = null;
    //     }
    // }



    public function render()
    {
        $data = [];
        $data['products'] = MyProduct::orderBy('created_at', 'desc')->get();
        return view('livewire.pages.back.products.promotions-create', $data);
    }
}
