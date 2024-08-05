<?php

namespace App\Livewire\Frontend\Pages\Products;

use App\Models\ProductStock;
use App\Models\UserCart;
use App\Models\UserCartItem;
use App\Models\UserOrder;
use App\Models\UserOrderItem;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Livewire\Component;
use Payline\PaylineSDK;

class Cart extends Component
{
    public $cart;
    public $cartItems;
    public $shipping_address;

    protected $listeners = [
        'cartUpdated',
        'shippingPointAdded' => 'addShippingPoint'
    ];

    public function mount()
    {
        $this->cart = UserCart::where('user_id', auth()->id())->first();
        $this->cartItems = UserCartItem::where('user_cart_id', $this->cart->id)->get();
    }

    public function addShippingPoint($shipping_address)
    {
        $this->shipping_address = $shipping_address;
    }

    // Fonction de suppression de l'article du panier
    public function removeItem($id)
    {
        $item = UserCartItem::where('id', $id)->first();
        // Mettre à jour les stocks
        if($item->product()->type == 'simple' || $item->product()->type == 'kit') {
            $stock = ProductStock::where('product_id', $item->product()->id)->first();
        } else {
            $stock = ProductStock::where('variant_id', $item->productData()->id)->where('product_id', $item->product()->id)->first();
        }
        $stock->quantity = $stock->quantity + $item->quantity;
        $stock->update();
        // Supprimer l'article
        $item->delete();

        $this->dispatch('cartUpdated');
    }

    // Ajout d'une quantité au panier
    public function plusQuantity($id)
    {
        $item = UserCartItem::where('id', $id)->first();
        if($item->product()->type == 'simple' || $item->product()->type == 'kit') {
            $stock = ProductStock::where('product_id', $item->product()->id)->first();
        } else {
            $stock = ProductStock::where('variant_id', $item->productData()->id)->where('product_id', $item->product()->id)->first();
        }
        // Si la quantité est plus petite que celle en stock, on ajoute 1
        if($item->quantity < $stock->quantity) {
            $item->quantity += 1;
            if($item->update())
            {
                // Mettre à jour les stocks
                $stock->quantity = $stock->quantity - 1;
                $stock->update();
            }
        }
        $this->dispatch('cartUpdated');

    }

    // Ajout d'une quantité au panier
    public function minusQuantity($id)
    {
        $item = UserCartItem::where('id', $id)->first();
        if($item->quantity < 2) {
            $item->quantity = 1;
        } else {
            $item->quantity -= 1;
            if($item->update())
            {
                // Mettre à jour les stocks
                if($item->product()->type == 'simple' || $item->product()->type == 'kit') {
                    $stock = ProductStock::where('product_id', $item->product()->id)->first();
                } else {
                    $stock = ProductStock::where('variant_id', $item->productData()->id)->where('product_id', $item->product()->id)->first();
                }
                $stock->quantity = $stock->quantity + 1;
                $stock->update();
            }
        }
        $this->dispatch('cartUpdated');
    }
    // Procéder au paiement
    public function proceedToPayment($type)
    {
        // Récupérer les informations du panier
        $cart = $this->cart;
        $cartItems = $this->cartItems;

        // Création d'une commande
        $order = new UserOrder;
        $order->code = Str::random(10);
        $order->user_id = auth()->user()->id;
        if($this->shipping_address) {
            $order->shipping_point_id = $this->shipping_address;
        }
        $order->total = $cart->getTotalPrice();
        if($type == 'card') {
            // S'il s'agit d'un paiement par carte
            $order->payment_method = 'card';
        } elseif($type == 'virement') {
            // S'il s'agit d'un paiement par virement
            $order->payment_method = 'virement';
        } else {
            // S'il s'agit d'un paiement par espèces
            $order->payment_method = 'later';
        }
        $order->is_paid = false;
        $order->state = 4;
        if($order->save())
        {
            // Ajouter les articles dans la commande
            foreach($cartItems as $item)
            {
                $orderItem = new UserOrderItem;
                $orderItem->user_order_id = $order->id;
                $orderItem->product_id = $item->product_id;
                $orderItem->product_variant_id = $item->product_data_id;
                $orderItem->quantity = $item->quantity;
                $orderItem->price_unit_ht = $item->productData()->price_unit;
                $orderItem->save();
            }

            if($type == 'card') {
                // Initialiser le paiement
                $merchant_id = Config::get('payment.merchant_id');
                $environment = Config::get('payment.environment');
                $access_key = Config::get('payment.access_key');
                $proxy_host = null;
                $proxy_port = null;
                $proxy_login = null;
                $proxy_password = null;
                $contract_number = Config::get('payment.contract_number');

                $price = floatval($cart->getTotalPrice());
                $convert_price = number_format($price, '2', '', '');

                $paylineSDK = new PaylineSDK($merchant_id, $access_key, $proxy_host, $proxy_port, $proxy_login, $proxy_password, $environment);

                $doWebPaymentRequest = array();

                $doWebPaymentRequest['cancelURL'] = route('fo.payment.redirect');
                $doWebPaymentRequest['returnURL'] = route('fo.payment.redirect');
                $doWebPaymentRequest['notificationURL'] = route('fo.payment.redirect');

                // Le paiement
                $doWebPaymentRequest['payment']['amount'] = $convert_price; // this value has to be an integer amount is sent in cents
                $doWebPaymentRequest['payment']['currency'] = 978; // ISO 4217 code for euro
                $doWebPaymentRequest['payment']['action'] = 101; // 101 stand for "authorization+capture"
                $doWebPaymentRequest['payment']['mode'] = 'CPT'; // one shot payment

                // La commande
                $doWebPaymentRequest['order']['ref'] = 'TEST'; // the reference of your order
                $doWebPaymentRequest['order']['amount'] = $convert_price; // may differ from payment.amount if currency is different
                $doWebPaymentRequest['order']['currency'] = 978; // ISO 4217 code for euro
                $doWebPaymentRequest['order']['date'] = date('d/m/Y H:i', strtotime(Carbon::now()));

                // CONTRACT NUMBERS
                $doWebPaymentRequest['payment']['contractNumber'] = $contract_number;

                $doWebPaymentResponse = $paylineSDK->doWebPayment($doWebPaymentRequest);

                if($doWebPaymentResponse['redirectURL']) {
                    // Modifier la commande afin de lui faire passer le token
                    $order->token = $doWebPaymentResponse['token'];
                    $order->update();

                    return redirect($doWebPaymentResponse['redirectURL']);
                } else {
                    // TODO: Traiter la réponse
                    dd("pas de réponse");
                }
            } else {
                // Supprimer les articles du panier
                foreach($cartItems as $item)
                {
                    $item->delete();
                }

                // Supprimer le panier
                $cart->delete();

                return to_route('fo.home')->with('success', 'Votre commande a été enregistrée avec succès !');
            }





        }
    }

    public function render()
    {
        return view('livewire.frontend.pages.products.cart');
    }
}
