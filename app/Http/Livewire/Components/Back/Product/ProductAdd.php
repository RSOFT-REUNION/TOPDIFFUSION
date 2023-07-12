<?php

namespace App\Http\Livewire\Components\Back\Product;

use App\Models\MyProductCategories;
use App\Models\MyProductPicture;
use App\Models\MyProductPrice;
use App\Models\Product;
use Livewire\Component;

class ProductAdd extends Component
{
    public $product_id;
    public $professionnal_price, $pourcentage_price, $customer_price, $ugs;

    protected $rules = [
        'customer_price' => 'required',
    ];

    protected $messages = [
        'customer_price.required' => "Le prix client est obligatoire.",
    ];

    public function updated($customer_price)
    {
        $this->validateOnly($customer_price);
        if($this->customer_price && $this->pourcentage_price) {
            $this->professionnal_price = ($this->customer_price - ($this->customer_price * $this->pourcentage_price / 100));
        }
    }

    public function mount($product_id)
    {
        $this->product_id = $product_id;
    }

    public function create()
    {
        $product = Product::where('id', $this->product_id)->first();
        if($product->type == 1) {
            $product->ugs = $this->ugs;
            if($product->update()){
                $prices = new MyProductPrice;
                $prices->product_id = $product->id;
                $prices->customer_price = number_format($this->customer_price, '2', '.', null);
                $prices->professionnal_price = number_format($this->professionnal_price, '2', '.', null);
                $prices->professionnal_discount_price = number_format($this->pourcentage_price, '2', '.', null);
                $prices->prices_for_swatches = 0;
                if($prices->save()) {
                    $product->active = 1;
                    if($product->update())
                    {
                        return redirect()->route('back.product.list');
                    }
                }
            }
        }

    }

    public function render()
    {
        $data = [];
        $data['product'] = Product::where('id', $this->product_id)->first();
        $data['categories'] = MyProductCategories::where('product_id', $this->product_id)->get();
        $data['pictures'] = MyProductPicture::where('product_id', $this->product_id)->get();
        return view('livewire.components.back.product.product-add', $data);
    }
}
