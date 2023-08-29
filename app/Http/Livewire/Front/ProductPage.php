<?php

namespace App\Http\Livewire\Front;

use App\Models\MyProduct;
use App\Models\MyProductInfo;
use App\Models\MyProductPicture;
use App\Models\MyProductStock;
use App\Models\MyProductSwatch;
use App\Models\ProductCategory;
use App\Models\SettingGeneral;
use App\Models\UserSetting;
use Livewire\Component;

class ProductPage extends Component
{
    protected $listeners = ['refreshLines' => '$refresh'];
    public $active_tab = '1';
    public $product_id, $quantity, $category_id;

    public $seenChainsValue = [];
    public $seenPasValue = [];
    public $seenWidthValue = [];
    public $seenPignonValue = [];
    public $seenCrownValue = [];

    public function mount($product_id)
    {
        $this->product_id = $product_id;
        $category_id_product = MyProduct::where('id', $this->product_id)->first();
        $this->category_id = ProductCategory::find($category_id_product->category_id);
    }
    public function changeTab($tab){
        switch ($tab) {
            case '1':
                $this->active_tab = '1';
                break;
            case '2' :
                $this->active_tab = '2';
                break;
            case '3' :
                $this->active_tab = '3';
                break;
        }
        // $this->category_id = ProductCategory::find($this->product->category_id);
    }

    public function shop()
    {

    }

    public function render()
    {
        $data = [];
        $data['tab'] = $this->active_tab;
        $data['product'] = MyProduct::where('id', $this->product_id)->first();
        $data['product_infos'] = MyProductInfo::where('product_id', $this->product_id)->get();
        $data['product_pictures'] = MyProductPicture::where('product_id', $this->product_id)->get();
        $data['product_swatches'] = MyProductSwatch::where('product_id', $this->product_id)->get();
        $data['settings'] = SettingGeneral::where('id', 1)->first();
        $data['product_stock'] = MyProductStock::where('product_id', $this->product_id)->get()->sum('quantity');
        $data['category'] = $this->category_id;
        if(!auth()->guest()) {
            $data['my_setting'] = UserSetting::where('user_id', auth()->user()->id)->first();
        }
        $data['increment'] = 1;
        return view('livewire.front.product-page', $data);
    }
}
