<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\SettingGeneral;
use App\Models\UserCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Payline\PaylineSDK;

class CartController extends Controller
{
    // Affichage de la page de Panier
    public function showCart(Request $request)
    {
        $merchant_id = Config::get('payment.merchant_id');
        $environment = Config::get('payment.environment');
        $access_key = Config::get('payment.access_key');
        $proxy_host = null;
        $proxy_port = null;
        $proxy_login = null;
        $proxy_password = null;

        if($request->paylinetoken != null) {
            $paylineSDK = new PaylineSDK($merchant_id, $access_key, $proxy_host, $proxy_port, $proxy_login, $proxy_password, $environment);

            $getWebPaymentDetailsRequest = array();
            $getWebPaymentDetailsRequest['paylinetoken'] = $_GET['paylinetoken']; // web payment session unique identifier

            $getWebPaymentDetailsResponse = $paylineSDK->getWebPaymentDetails($getWebPaymentDetailsRequest);
            if($getWebPaymentDetailsRequest == '02305') {
                $data['response_payment'] = 'Paiement annulé';
            }
        }

        $cart = UserCart::where('user_id', auth()->user()->id)->first();

        $data = [];
        $data['page'] = 'cart';
        $data['setting'] = SettingGeneral::where('id', 1)->first();
        if($cart) {
            return view('pages.frontend.cart.cart', $data);
        } else {
            // Si le panier est vide, ça redirige vers la page d'accueil
            return redirect()->route('front.home');
        }

    }

    // Récupération de la réponse du controller
    public function showPaymentReturn(Request $request)
    {
        $data = [];

        $merchant_id = Config::get('payment.merchant_id');
        $environment = Config::get('payment.environment');
        $access_key = Config::get('payment.access_key');
        $proxy_host = null;
        $proxy_port = null;
        $proxy_login = null;
        $proxy_password = null;

        if($request->paylinetoken != null) {
            $paylineSDK = new PaylineSDK($merchant_id, $access_key, $proxy_host, $proxy_port, $proxy_login, $proxy_password, $environment);

            $getWebPaymentDetailsRequest = array();
            $getWebPaymentDetailsRequest['paylinetoken'] = $_GET['paylinetoken']; // web payment session unique identifier

            $getWebPaymentDetailsResponse = $paylineSDK->doWebPayment($getWebPaymentDetailsRequest);
            $data['response_payment'] = $getWebPaymentDetailsResponse['result']['longMessage'];
        } else {
            $data['response_payment'] = 'Paiement annulé';
        }


        $data['page'] = 'success_payment';
        $data['setting'] = SettingGeneral::where('id', 1)->first();
        return view('pages.frontend.cart.success-payment', $data);
    }

}
