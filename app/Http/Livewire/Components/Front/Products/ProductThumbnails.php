<?php

namespace App\Http\Livewire\Components\Front\Products;

use App\Models\MyProduct;
use App\Models\MyProductStock;
use App\Models\Product;
use App\Models\SettingGeneral;
use App\Models\UserSetting;
use Livewire\Component;

class ProductThumbnails extends Component
{
    public $product;

    protected $listeners = ['refreshLines' => '$refresh'];

    public function mount($product_id)
    {
        $this->product = MyProduct::where('id', $product_id)->first();
    }

    public function render()
    {
        $data = [];
        $data['product'] = $this->product;
        $data['product_stock'] = MyProductStock::where('product_id', $this->product->id)->get()->sum('quantity');
        $data['setting'] = SettingGeneral::where('id', 1)->first();
        if(auth()->user()) {
            $data['my_setting'] = UserSetting::where('user_id', auth()->user()->id)->first();
        }
        return view('livewire.components.front.products.product-thumbnails', $data);
    }
}