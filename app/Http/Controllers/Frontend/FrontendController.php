<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Bikes;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use App\Models\ShippingPoint;
use App\Models\UserFavoriteProduct;
use App\Models\UserOrder;
use App\Models\UserOrderItem;
use Illuminate\Http\Request;
use Livewire\Livewire;

class FrontendController extends Controller
{
    // Affichage de la page d'accueil
    public function showHomePage()
    {
        $data = [];
        $data['products'] = Product::orderBy('created_at', 'desc')->get()->where('active', 1)->take('8');
        $data['brands'] = ProductBrand::orderBy('created_at', 'desc')->get()->take('4');
        return view('pages.frontend.home', $data);
    }

    // Affichage de la page des d'inscription
    public function showRegisterPage()
    {
        if(auth()->check())
        {
            return to_route('fo.home')->with('info', 'Vous êtes déjà connecté');
        } else {
            return view('pages.frontend.register');
        }
    }

    /*
     * Gestion des produits
     */

    // Affichage d'un produit simple
    public function showSingleProduct($slug)
    {
        $data = [];
        $data['product'] = Product::where('slug', $slug)->where('active', 1)->first();
        return view('pages.frontend.products.product_single', $data);
    }

    // Affichage du panier de produit
    public function showCart()
    {
        $data = [];
        return view('pages.frontend.products.cart', $data);
    }

    // Affichage des motos par filtres
    public function showBikesByFilters($id)
    {
        $data = [];
        $data['bike'] = Bikes::where('id', $id)->first();
        return view('pages.frontend.products.product_list_bikes', $data);
    }

    // Affichage des produits par categories
    public function showProductByCategory($slug)
    {
        $category = ProductCategory::where('slug', $slug)->first();
        $data = [];
        $data['category'] = $category;
        $data['products'] = Product::where('category_id', $category->id)->where('active', 1)->get();
        return view('pages.frontend.products.product_category', $data);
    }


    /*
     * Gestion du profil
     */

    // Affichage de la page de profil
    public function showProfile()
    {
        $data = [];
        return view('pages.frontend.profile.profile');
    }

    // Affichage de la page des favoris
    public function showProfileFavorite()
    {
        $data = [];
        $data['favorites'] = UserFavoriteProduct::where('user_id', auth()->user()->id)->get();
        return view('pages.frontend.profile.profile-favorite', $data);
    }

    // Affichage de la page des commandes
    public function showProfileOrders()
    {
        $data = [];
        $data['orders'] = UserOrder::where('user_id', auth()->user()->id)->get();
        return view('pages.frontend.profile.profile-orders', $data);
    }
    public function showProfileOrderSingle($id)
    {
        $data = [];
        $data['order'] = UserOrder::where('id', $id)->first();
        $data['orderItems'] = UserOrderItem::where('user_order_id', $id)->get();
        $data['shipping_point'] = ShippingPoint::where('id', $data['order']->shipping_point_id)->first();
        return view('pages.frontend.profile.order-single', $data);
    }

    // Affichage de la page des commandes
    public function showProfileEdit()
    {
        $data = [];
        return view('pages.frontend.profile.profile-edit', $data);
    }

    /*
     * Gestion des pages de mentions
     */
    // Toutes les pages ci-dessous doivent être rempli par RSOFT
    public function showAboutPage()
    {
        $data = [];
        return view('pages.frontend.mentions.about', $data);
    }
    public function showMentionsPage()
    {
        $data = [];
        return view('pages.frontend.mentions.mention-legal', $data);
    }
    public function showCGVPage()
    {
        $data = [];
        return view('pages.frontend.mentions.CGV', $data);
    }
    public function showCGUPage()
    {
        $data = [];
        return view('pages.frontend.mentions.CGU', $data);
    }
}
