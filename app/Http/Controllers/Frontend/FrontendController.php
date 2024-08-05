<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Bikes;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use App\Models\ShippingPoint;
use App\Models\UserCart;
use App\Models\UserCartItem;
use App\Models\UserFavoriteProduct;
use App\Models\UserOrder;
use App\Models\UserOrderItem;
use Illuminate\Support\Facades\Config;
use Payline\PaylineSDK;

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

    // Gestion des paiements
    public function paymentRedirectPage()
    {
        $data = [];
        if(request()->query('paylinetoken')) {
            $paylinetoken = request()->query('paylinetoken');

            // Initialiser le paiement
            $merchant_id = Config::get('payment.merchant_id');
            $environment = Config::get('payment.environment');
            $access_key = Config::get('payment.access_key');
            $proxy_host = null;
            $proxy_port = null;
            $proxy_login = null;
            $proxy_password = null;
            $contract_number = Config::get('payment.contract_number');

            $paylineSDK = new PaylineSDK($merchant_id, $access_key, $proxy_host, $proxy_port, $proxy_login, $proxy_password, $environment);

            $getWebPaymentDetails = array();
            $getWebPaymentDetails['token'] = $paylinetoken;

            $getWebPaymentResponse = $paylineSDK->getWebPaymentDetails($getWebPaymentDetails);

            // Récupération de la commande
            $order = UserOrder::where('token', $paylinetoken)->first();
            // Mise à jour de la commande par rapport à la réponse de Payline
            if($getWebPaymentResponse['result']['code'] == '00000') {
                // Paiement accepté
                $order->is_paid = true;
                $order->state = 1;
                $order->update();
            } elseif($getWebPaymentResponse['result']['code'] == '03022') {
                // Paiement refusé
                $order->is_paid = false;
                $order->state = 0;
                $order->update();
            } elseif($getWebPaymentResponse['result']['code'] == '02319') {
                // Paiement annulé
                $order->is_paid = false;
                $order->state = 2;
                $order->update();
            } else {
                // Carte perdu ou volé
                $order->is_paid = false;
                $order->state = 3;
                $order->update();
            }

            // Suppression du panier ainsi que des produits
            $cart = UserCart::where('user_id', auth()->user()->id)->first();
            if($cart && $getWebPaymentResponse['result']['code'] == '00000') {
                $cartItems = UserCartItem::where('user_cart_id', $cart->id)->get();
                foreach($cartItems as $item) {
                    $item->delete();
                }
                $cart->delete();
            }

            $data['paymentData'] = $getWebPaymentResponse;
            $data['order'] = $order;
        }
        return view('pages.frontend.payments.payment-redirect', $data);
    }
}
