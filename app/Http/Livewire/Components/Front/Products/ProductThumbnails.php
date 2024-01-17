<?php

namespace App\Http\Livewire\Components\Front\Products;

use App\Models\Product;
use Livewire\Component;
use App\Models\MyProduct;
use App\Models\MyFavorite;
use App\Models\MyProductPromotion;
use App\Models\UserSetting;
use App\Models\MyProductStock;
use App\Models\SettingGeneral;
use App\Models\ProductCategory;

class ProductThumbnails extends Component
{
    public $product, $category_id, $promotion_id, $promotion;

    public $isFavorite = false;

    protected $listeners = ['refreshLines' => '$refresh'];

    public function mount($product_id)
    {
        $this->product = MyProduct::where('id', $product_id)->first();
        $this->category_id = ProductCategory::find($this->product->category_id);

        if (auth()->check()) {
            $this->isFavorite = MyFavorite::where('product_id', $product_id)->where('user_id', auth()->user()->id)->exists();
        }

        $this->promotion_id = $this->product->promotion->first() ? $this->product->promotion->first() : null;
        $this->promotion = $this->promotion_id ? (!$this->promotion_id->code ? ($this->promotion_id->active ? MyProductPromotion::where('id', $this->promotion_id->id)->first() : null) : null): null;
    }

    public function addProductToFavorite($id)
    {
        if (auth()->check()) {
            $actualUser = auth()->user()->id;

            $verifyIfProductExists = MyFavorite::where('product_id', $id)->first();

            if (!$verifyIfProductExists) {
                $fav = new MyFavorite;
                $fav->user_id = $actualUser;
                $fav->product_id = $id;
                $fav->save();

                $this->isFavorite = true;
            }
        } else {
            redirect()->route('front.login');
        }
    }

    public function deleteFavorite($id)
    {
        $user = auth()->user();
        $productId = $id;

        $favorite = MyFavorite::where('user_id', $user->id)->where('product_id', $productId)->first();

        if ($favorite) {
            $favorite->delete();
            $this->isFavorite = false;
        }
    }


    public function render()
    {
        $data = [];
        $data['product'] = $this->product;
        $data['promotion'] = $this->promotion;
        $data['product_stock'] = MyProductStock::where('product_id', $this->product->id)->get()->sum('quantity');
        $data['category'] = $this->category_id;
        $data['setting'] = SettingGeneral::where('id', 1)->first();
        if (auth()->user()) {
            $data['my_setting'] = UserSetting::where('user_id', auth()->user()->id)->first();
        }
        return view('livewire.components.front.products.product-thumbnails', $data);
    }
}
