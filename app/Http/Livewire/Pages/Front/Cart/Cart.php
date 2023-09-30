<?php

namespace App\Http\Livewire\Pages\Front\Cart;

use App\Models\ActivityLog;
use App\Models\MyProduct;
use App\Models\MyProductSwatch;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserCart;
use App\Models\UserOrder;
use App\Models\UserOrderItem;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Livewire\Component;
use Payline\PaylineSDK;

class Cart extends Component
{
    public $quantity_line;

    // Ajouter une quantité au produit
    public function addQuantity($cart)
    {
        $cart = UserCart::where('id', $cart)->first();
        $cart->quantity += 1;
        $cart->update();
    }

    // Supprimer une quantité au produit
    public function minusQuantity($cart)
    {
        $cart = UserCart::where('id', $cart)->first();
        $cart->quantity -= 1;
        $cart->update();
    }

    // Supprimer le produit du panier
    public function deleteProduct($cart)
    {
        $cart = UserCart::where('id', $cart)->first();
        if ($cart){
        $productName = $cart->product->title;
        $cart->delete();
            // Enregistrez l'activité de suppression d'article au panier avec le nom de l'article
            ActivityLog::logActivity(
                auth()->user()->id,
                'Article supprimé du panier',
                auth()->user()->firstname . ' ' . auth()->user()->lastname . ' a supprimé ' . $productName . ' de son panier'
            );
        } else {
            session()->flash('error', 'Error lors de la suppression.');
        }

    }

    // Permet de savoir la quantité d'articles présent dans le panier
    public function getQuantityTotal()
    {
        $cart = UserCart::where('user_id', auth()->user()->id)->get();
        $quantity = 0;
        foreach ($cart as $item) {
            $quantity += $item->quantity;
        }
        return $quantity;
    }

    // Permet de savoir le prix total de mon panier
    public function getPriceTotal()
    {
        $cart = UserCart::where('user_id', auth()->user()->id)->get();
        $price = 0.0;
        foreach ($cart as $item) {
            $price += $item->getTotalPriceLineBlank();
        }
        return number_format($price, '2', ',', ' ');
    }

    // Initialise la commande par rapport au panier
    public function initOrder()
    {
        // TODO: terminer de gérer la commande et le paiement

        // Format du numéro de document (ex: CM_HOARAU-VAPQR_2023-09-19_FHO87)
        $document_number = 'CM_'. auth()->user()->customer_code .'_'. strtoupper(Str::random(5));

        // Création de la commande
        $order = new UserOrder;
        $order->user_id = auth()->user()->id;
        $order->document_number = $document_number;
        $order->total_product = $this->getQuantityTotal();
        $order->total_amount = $this->getPriceTotal();
        $order->total_ship = 0;
        if($order->save()) {
            // Enregistrez l'activité de création de commande
            ActivityLog::logActivity(auth()->user()->id, 'Commande créée', auth()->user()->firstname . ' ' . auth()->user()->lastname .' vient de passer une commande de ' . $this->getPriceTotal());

            // Ajout en base des articles du panier
            $cart = UserCart::where('user_id', auth()->user()->id)->get();
            foreach ($cart as $ca)
            {
                // Récupérer les informations du produit
                $swatch = MyProductSwatch::where('id', $ca->swatch_id)->first();

                // Ajoutes les données en base de données
                $orderItems = new UserOrderItem;
                $orderItems->order_id = $order->id;
                $orderItems->product_id = $ca->product_id;
                $orderItems->quantity = $ca->quantity;
                $orderItems->product_swatch_id = $swatch->id;
                if(auth()->user()->professionnal === 1 && auth()->user()->verified === 1) {
                    $orderItems->product_price = $swatch->professionnal_price;
                } else {
                    $orderItems->product_price = $swatch->customer_price;
                }
                $orderItems->save();

            }

            // **** initié le paiement
            $merchant_id = Config::get('payment.merchant_id');
            $environment = Config::get('payment.environment');
            $access_key = Config::get('payment.access_key');
            $proxy_host = null;
            $proxy_port = null;
            $proxy_login = null;
            $proxy_password = null;

            $price = floatval($this->getPriceTotal());
            $convert_price = number_format($price, '2', '', '');

            $paylineSDK = new PaylineSDK($merchant_id, $access_key, $proxy_host, $proxy_port, $proxy_login, $proxy_password, $environment);

            $doWebPaymentRequest = array();
            $doWebPaymentRequest['cancelURL'] = 'http://localhost:8000/mon-panier';
            $doWebPaymentRequest['returnURL'] = 'http://localhost:8000/returnURL';
            $doWebPaymentRequest['notificationURL'] = 'http://localhost:8000/notificationURL';

            // Le paiement
            $doWebPaymentRequest['payment']['amount'] = $convert_price; // this value has to be an integer amount is sent in cents
            $doWebPaymentRequest['payment']['currency'] = 978; // ISO 4217 code for euro
            $doWebPaymentRequest['payment']['action'] = 101; // 101 stand for "authorization+capture"
            $doWebPaymentRequest['payment']['mode'] = 'CPT'; // one shot payment

            // La commande
            $doWebPaymentRequest['order']['ref'] = $order->document_number; // the reference of your order
            $doWebPaymentRequest['order']['amount'] = $convert_price; // may differ from payment.amount if currency is different
            $doWebPaymentRequest['order']['currency'] = 978; // ISO 4217 code for euro
            $doWebPaymentRequest['order']['date'] = date('d/m/Y H:i', strtotime(Carbon::now()));

            // CONTRACT NUMBERS
            $doWebPaymentRequest['payment']['contractNumber'] = '1234567';

            $doWebPaymentResponse = $paylineSDK->doWebPayment($doWebPaymentRequest);

            if($doWebPaymentResponse) {
                /* FIXME: suppression du panier
                 * Suppression du panier
                 * ATTENTION : Avec cette methode nous n'attendons pas la réponse du payment, il faut retravailler cette méthode.
                 */
                $my_cart = UserCart::where('user_id', auth()->user()->id)->first();
                $my_cart->delete();

                //

                return redirect($doWebPaymentResponse['redirectURL']);
            } else {
                // TODO: Traiter la réponse
                dd("pas de reponse");
            }

//            Session::flash('success', "Nous avons bien pris en compte votre commande.");
//            return redirect()->route('front.home');
        } else {
            Session::flash('erreur', "Une erreur s'est produite");
            return redirect()->route('front.home');
        }
    }

    // TEST - Payment
    public function payment($order_id)
    {
        $merchant_id = Config::get('payment.merchant_id');
        $environment = Config::get('payment.environment');
        $access_key = Config::get('payment.access_key');
        $proxy_host = null;
        $proxy_port = null;
        $proxy_login = null;
        $proxy_password = null;

        $price = floatval($this->getPriceTotal());
        $convert_price = number_format($price, '2', '', '');

        $paylineSDK = new PaylineSDK($merchant_id, $access_key, $proxy_host, $proxy_port, $proxy_login, $proxy_password, $environment);

        $doWebPaymentRequest = array();
        $doWebPaymentRequest['cancelURL'] = 'http://localhost:8000/mon-panier';
        $doWebPaymentRequest['returnURL'] = 'http://localhost:8000/returnURL';
        $doWebPaymentRequest['notificationURL'] = 'http://localhost:8000/notificationURL';

        // Le paiement
        $doWebPaymentRequest['payment']['amount'] = $convert_price; // this value has to be an integer amount is sent in cents
        $doWebPaymentRequest['payment']['currency'] = 978; // ISO 4217 code for euro
        $doWebPaymentRequest['payment']['action'] = 101; // 101 stand for "authorization+capture"
        $doWebPaymentRequest['payment']['mode'] = 'CPT'; // one shot payment

        // La commande
        $doWebPaymentRequest['order']['ref'] = $order->document_name; // the reference of your order
        $doWebPaymentRequest['order']['amount'] = $convert_price; // may differ from payment.amount if currency is different
        $doWebPaymentRequest['order']['currency'] = 978; // ISO 4217 code for euro
        $doWebPaymentRequest['order']['date'] = date('d/m/Y H:i', strtotime(Carbon::now()));

        // CONTRACT NUMBERS
        $doWebPaymentRequest['payment']['contractNumber'] = '1234567';

        $doWebPaymentResponse = $paylineSDK->doWebPayment($doWebPaymentRequest);

        if($doWebPaymentResponse) {
            return redirect($doWebPaymentResponse['redirectURL']);
        } else {
            dd("pas de reponse");
        }
    }

    public function render()
    {
        $data = [];
        $data['my_cart'] = UserCart::where('user_id', auth()->user()->id)->get();
        $data['total_quantity'] = $this->getQuantityTotal();
        $data['total_price'] = $this->getPriceTotal();
        $data['user_address'] = UserAddress::where('user_id', auth()->user()->id)->get();
        return view('livewire.pages.front.cart.cart', $data);
    }
}
