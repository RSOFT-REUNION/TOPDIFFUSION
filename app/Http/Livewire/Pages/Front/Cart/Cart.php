<?php

namespace App\Http\Livewire\Pages\Front\Cart;

use App\Models\MyProduct;
use App\Models\MyProductSwatch;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserCart;
use App\Models\UserOrder;
use App\Models\UserOrderItem;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Livewire\Component;

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
        $cart->delete();
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
        // Format du numéro de document (ex: CM_HOARAU-VAPQR_2023-09-19_FHO87)
        $document_number = 'CM_'. auth()->user()->customer_code .'_'. date('Y-m-d', strtotime(Carbon::now())) .'_'. strtoupper(Str::random(5));

        // Création de la commande
        $order = new UserOrder;
        $order->user_id = auth()->user()->id;
        $order->document_number = $document_number;
        $order->total_product = $this->getQuantityTotal();
        $order->total_amount = $this->getPriceTotal();
        $order->total_ship = 0;
        if($order->save()) {
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
                if(auth()->user()->professionnal === 1 && auth()->user()->verified === 1) {
                    $orderItems->product_price = $swatch->professionnal_price;
                } else {
                    $orderItems->product_price = $swatch->customer_price;
                }
                $orderItems->save();

            }

            Session::flash('success', "Nous avons bien pris en compte votre commande.");
            return redirect()->route('front.home');
        } else {
            Session::flash('erreur', "Une erreur s'est produite");
            return redirect()->route('front.home');
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
