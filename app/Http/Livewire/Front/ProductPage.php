<?php

namespace App\Http\Livewire\Front;

use App\Models\ActivityLog;
use App\Models\CompatibleBike;
use App\Models\MyFavorite;
use App\Models\MyProduct;
use App\Models\MyProductInfo;
use App\Models\MyProductPicture;
use App\Models\MyProductPromotion;
use App\Models\MyProductStock;
use App\Models\MyProductSwatch;
use App\Models\ProductCategory;
use App\Models\ProductGroupTag;
use App\Models\ProductTag;
use App\Models\SettingGeneral;
use App\Models\UserCart;
use App\Models\UserBike;
use App\Models\UserSetting;
use Livewire\Component;

class ProductPage extends Component
{
    protected $listeners = ['refreshLines' => '$refresh'];
    public $active_tab = '1';
    public $product_id, $product, $quantity, $category_id, $favoriteLike, $config_swatch, $promotion_id, $promotion, $declinaison_2;
    public $userBikeCompatible = false;
    // public $allCompatibleBike = [];

    public $productIsInFavorites = false;

    public $images = [];
    public $activeImage = 0;

    public function setActiveImage($index)
    {
        $this->activeImage = $index;
    }

    public function mount($product_id)
    {
        $this->product_id = $product_id;
        $category_id_product = MyProduct::where('id', $this->product_id)->first();
        $this->category_id = ProductCategory::find($category_id_product->category_id);
        $this->product = MyProduct::where('id', $this->product_id)->first();


        if($this->quantity == null) {
            $this->quantity = 1;
        }

        $favorite = MyFavorite::where('product_id', $product_id)->first();

        if ($favorite) {
            $this->favoriteLike = true;
        } else {
            $this->favoriteLike = false;
        }

        $picture = MyProductPicture::where('product_id', $product_id)->get();

        $this->promotion_id = $this->product->promotion->first() ? $this->product->promotion->first() : null;
        $this->promotion = $this->promotion_id ? (!$this->promotion_id->code ? ($this->promotion_id->active ? MyProductPromotion::where('id', $this->promotion_id->id)->first() : null) : null): null;
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

    // Ajouter une quantité au produit
    public function addQuantity()
    {
        $this->quantity += 1;
    }

    // Supprimer une quantité au produit
    public function minusQuantity()
    {
        if($this->quantity > 1) {
            $this->quantity -= 1;
        }
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

    // Récupérer les bons groupes de tags
    public function getGroupTag()
    {
        $swatches = MyProductSwatch::where('product_id', $this->product_id)->get();
        $groupTagIds = $swatches->pluck('swatch_group_id')->toArray();
        $groupTags = ProductGroupTag::whereIn('id', $groupTagIds)->get();

        return $groupTags;
    }

    // Récupérer les bons tags
    public function getTag()
    {
        $swatches = MyProductSwatch::where('product_id', $this->product_id)->get();
        $tagIds = $swatches->pluck('swatch_tags_id')->toArray();
        $tags = ProductTag::whereIn('id', $tagIds)->get();

        return $tags;
    }

    // Récupérer la bonne déclinaison sélectionnée
    public function getGoodSwatches()
    {
        if($this->declinaison_2 != null) {
            $value = $this->declinaison_2;
            preg_match('/^(\d+)\/(\d+)$/', $value, $matches);
            $group_tag = $matches[1];
            $tag = $matches[2];

            $mySwatch = MyProductSwatch::where('product_id', $this->product_id)
                ->where('swatch_group_id', $group_tag)
                ->where('swatch_tags_id', $tag)
                ->first();
            return $mySwatch;
        }

    }

    public function createCart()
    {



        // Récupération du panier du client
        $myCart = UserCart::where('user_id', auth()->user()->id)->where('product_id', $this->product_id)->first();
        $product = MyProduct::where('id', $this->product_id)->first();

        // Récupération des swatches du produit
        if($product->type == 1) {
            $swatch = MyProductSwatch::where('product_id', $this->product_id)->get();
        } else {
            $swatch = $this->getGoodSwatches();
        }

        $productName = $product->title;

        // Vérification si la ligne existe déjà
        if($myCart) {
            // Ajout des nouvelles quantités dans la ligne du panier
            $myCart->quantity += $this->quantity;
            $myCart->update();

            // Enregistrez l'activité de mise à jour du panier
            ActivityLog::logActivity(
                auth()->user()->id,
                'Mise à jour du panier',
                ' a ajouté ' . $this->quantity . " " . $productName . ' au panier'
            );
        } else {
            // Création de l'article dans le panier
            $cart = new UserCart;
            $cart->product_id = $this->product_id;
            $cart->user_id = auth()->user()->id;
            $cart->swatch_id = $swatch->id;
            $cart->quantity = $this->quantity;
            $cart->save();

            // Récupération du nom de l'article
            // Enregistrez l'activité d'ajout d'article au panier avec le nom de l'article
            ActivityLog::logActivity(
                auth()->user()->id,
                'Article ajouté au panier',
                ' a ajouté ' . $productName . ' au panier'
            );

        }

        // Recharge en temps reel le compteur
        $this->emit('refreshLines');
    }

    public function render()
    {
        $goodProduct = MyProduct::where('id', $this->product_id)->first();

        $data = [];
        $data['tab'] = $this->active_tab;
        $data['promotion'] = $this->promotion;
        $data['product'] = MyProduct::where('id', $this->product_id)->first();
        $data['product_infos'] = MyProductInfo::where('product_id', $this->product_id)->get();
        $data['product_pictures'] = MyProductPicture::where('product_id', $this->product_id)->get();
        $data['product_swatches'] = MyProductSwatch::where('product_id', $this->product_id)->get();
        if($this->getGoodSwatches() != null) {
            // Si une déclinaison est bien sélectionnée
            $data['product_swatch'] = $this->getGoodSwatches();
        } else {
            $data['product_swatch'] = "";
        }

        if($goodProduct->type == 2) {
            // Récuperer les informations sur les déclinaisons
            $data['product_group_tag'] = $this->getGroupTag();
            $data['product_tag'] = $this->getTag();
        } else {
            $data['product_group_tag'] = null;
            $data['product_tag'] = null;
        }
        $data['settings'] = SettingGeneral::where('id', 1)->first();
        $data['product_stock'] = MyProductStock::where('product_id', $this->product_id)->get()->sum('quantity');
        $data['category'] = $this->category_id;
        if (!auth()->guest()) {
            $data['my_setting'] = UserSetting::where('user_id', auth()->user()->id)->first();
        }
        $data['increment'] = 1;
        $data['swatch_info'] = MyProductSwatch::where('id', $this->config_swatch)->first();

        // FIXME: Ne pas afficher toutes les motos (ils sont en doubles)
        // Compatible BIKE
        if(!auth()->guest()) {
            $userBike = UserBike::where('user_id', auth()->user()->id)->get();
            $compatibleBikeIds = $userBike->pluck('bike_id')->toArray();
            $data['allCompatibleBike'] = CompatibleBike::whereIn('bike_id', $compatibleBikeIds)->with('bike')->get();

            $isUserBikeCompatible = $data['allCompatibleBike']->count() > 0; // Vérifier si la collection n'est pas vide

            if ($isUserBikeCompatible) {
                // L'utilisateur a au moins une moto compatible
                $this->userBikeCompatible = true;
            }
        } else {
            $data['allCompatibleBike'] = CompatibleBike::where('product_id', $this->product_id)->orderBy('marque', 'asc')->get();
        }




        return view('livewire.front.product-page', $data);
    }
}
