<?php

namespace App\Http\Livewire\Components\Front\Products;

use App\Models\Product;
use Livewire\Component;
use App\Models\MyProduct;
use App\Models\MyFavorite;
use App\Models\UserSetting;
use App\Models\MyProductStock;
use App\Models\SettingGeneral;
use App\Models\ProductCategory;

class ProductThumbnails extends Component
{
    public $product, $category_id;

    protected $listeners = ['refreshLines' => '$refresh'];

    public function mount($product_id)
    {
        $this->product = MyProduct::where('id', $product_id)->first();
        $this->category_id = ProductCategory::find($this->product->category_id);
    }

    public function addProductToFavorite($id)
    {
        $actualUser = auth()->user()->id;

        $verifyIfProductExists = MyFavorite::where('product_id', $id)->first();


        if (!$verifyIfProductExists) {
            $fav = new MyFavorite([
                'user_id' => $actualUser,
                'product_id' => $id
            ]);
            if ($fav->save()) {
                redirect()->route('front.home');
            } else {
                redirect()->route('about');
            }
        }
    }

    public function deleteFavorite($id)
    {
        $user = auth()->user();
        $productId = $id;

        $favorite = MyFavorite::where('user_id', $user->id)->where('product_id', $productId)->first();

        if ($favorite) {
            $favorite->delete();
        } else {
            redirect()->route('back.product.list');
        }
    }

    public function render()
    {
        $data = [];
        $data['product'] = $this->product;
        $data['product_stock'] = MyProductStock::where('product_id', $this->product->id)->get()->sum('quantity');
        $data['category'] = $this->category_id;
        $data['setting'] = SettingGeneral::where('id', 1)->first();
        if (auth()->user()) {
            $data['my_setting'] = UserSetting::where('user_id', auth()->user()->id)->first();
        }
        return view('livewire.components.front.products.product-thumbnails', $data);
    }
}
