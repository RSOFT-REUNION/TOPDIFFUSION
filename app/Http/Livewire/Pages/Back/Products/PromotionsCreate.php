<?php

namespace App\Http\Livewire\Pages\Back\Products;

use App\Models\MyProduct;
use Livewire\Component;

class PromotionsCreate extends Component
{

    public $checkedProducts = [];
    public $checkedProduct = [];
    public $title;
    public $percentage;
    public $image1;
    public $image2;
    public $image4;
    public $image3;

    public function updated($title, $value1)
    {
        if($title == "title") {
            $this->title = $value1;
        } elseif($title == "percentage") {
            $this->percentage = $value1;
        }
    }

    public function getCheckedProductIds()
    {
        return array_keys( array_filter($this->checkedProducts));
    }

    // public function test()
    // {
    //     foreach ($this->checkedProducts as $key => $value) {
    //         if ($value === true) {
    //             $this->checkedProduct[] = $key;
    //         }
    //     }
    //     dd($this->checkedProduct);
    // }

    public function create()
    {
        foreach ($this->checkedProducts as $keys => $values) {
            if ($values === true) {
                $this->checkedProduct[] = $keys;
            }
        }

        foreach ($this->checkedProduct as $key => $value) {
            $createPromotion = MyProduct::find($value);
            if ($createPromotion) {
                $createPromotion->promotion = $this->percentage;
                $createPromotion->promotion_group = $this->title;
                $createPromotion->save();
            }
        }

    }

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
