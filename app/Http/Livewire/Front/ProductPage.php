<?php

namespace App\Http\Livewire\Front;

use App\Models\CompatibleBike;
use App\Models\MyFavorite;
use App\Models\MyProduct;
use App\Models\MyProductInfo;
use App\Models\MyProductPicture;
use App\Models\MyProductStock;
use App\Models\MyProductSwatch;
use App\Models\ProductCategory;
use App\Models\SettingGeneral;
use App\Models\UserCart;
use App\Models\UserBike;
use App\Models\UserSetting;
use Livewire\Component;

class ProductPage extends Component
{
    protected $listeners = ['refreshLines' => '$refresh'];
    public $active_tab = '1';
    public $product_id, $quantity, $category_id, $favoriteLike;

    public $seenChainsValue = [];
    public $seenPasValue = [];
    public $seenWidthValue = [];
    public $seenPignonValue = [];
    public $seenCrownValue = [];
    public $userBikeCompatible = false;
    // public $allCompatibleBike = [];

    public $productIsInFavorites = false;

    public function mount($product_id)
    {
        $this->product_id = $product_id;
        $category_id_product = MyProduct::where('id', $this->product_id)->first();
        $this->category_id = ProductCategory::find($category_id_product->category_id);

        $favorite = MyFavorite::where('product_id', $product_id)->first();

        if ($favorite) {
            $this->favoriteLike = true;
        } else {
            $this->favoriteLike = false;
        }
    }
    public function changeTab($tab)
    {
        switch ($tab) {
            case '1':
                $this->active_tab = '1';
                break;
            case '2':
                $this->active_tab = '2';
                break;
            case '3':
                $this->active_tab = '3';
                break;
        }
        // $this->category_id = ProductCategory::find($this->product->category_id);
    }

    public function createCart()
    {
        // Récupération des swatches du produit
        $swatches = MyProductSwatch::where('product_id', $this->product_id)->get();

        // Récupération du panier du client
        $myCart = UserCart::where('user_id', auth()->user()->id)->where('product_id', $this->product_id)->first();

        // Vérification si la ligne existe déjà
        if($myCart) {
            // Ajout des nouvelles quantités dans la ligne du panier
            $myCart->quantity += $this->quantity;
            $myCart->update();
        } else {
            // Création de l'article dans le panier
            $cart = new UserCart;
            $cart->product_id = $this->product_id;
            $cart->user_id = auth()->user()->id;
            if($swatches->count() === 1) {
                foreach ($swatches as $swatch) {
                    $cart->swatch_id = $swatch->id;
                }
            } else {
                //
            }
            $cart->quantity = $this->quantity;
            $cart->save();
        }

        // Recharge en temps reel le compteur
        $this->emit('refreshLines');
    }

    public function getProductIsInFavoritesProperty()
    {
        $user = auth()->user();
        $this->productIsInFavorites = $user->favorites->contains('id', $this->product->id);

        return $this->productIsInFavorites;
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
                redirect()->back();
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
        $data['tab'] = $this->active_tab;
        $data['product'] = MyProduct::where('id', $this->product_id)->first();
        $data['product_infos'] = MyProductInfo::where('product_id', $this->product_id)->get();
        $data['product_pictures'] = MyProductPicture::where('product_id', $this->product_id)->get();
        $data['product_swatches'] = MyProductSwatch::where('product_id', $this->product_id)->get();
        $data['settings'] = SettingGeneral::where('id', 1)->first();
        $data['product_stock'] = MyProductStock::where('product_id', $this->product_id)->get()->sum('quantity');
        $data['category'] = $this->category_id;
        if (!auth()->guest()) {
            $data['my_setting'] = UserSetting::where('user_id', auth()->user()->id)->first();
        }
        $data['increment'] = 1;

        // FIXME: Ne pas afficher toutes les motos (ils sont en doubles)
        // Compatible BIKE
        $userBike = UserBike::where('user_id', auth()->user()->id)->get();
        $compatibleBikeIds = $userBike->pluck('bike_id')->toArray();
        $data['allCompatibleBike'] = CompatibleBike::whereIn('bike_id', $compatibleBikeIds)->with('bike')->get();

        $isUserBikeCompatible = $data['allCompatibleBike']->count() > 0; // Vérifier si la collection n'est pas vide

        if ($isUserBikeCompatible) {
            // L'utilisateur a au moins une moto compatible
            $this->userBikeCompatible = true;
        }


        return view('livewire.front.product-page', $data);
    }
}
