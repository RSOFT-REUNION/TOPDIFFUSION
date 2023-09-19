<?php

namespace App\Http\Livewire\Pages\Front\Cart;

use App\Models\UserCart;
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

    public function render()
    {
        $data = [];
        $data['my_cart'] = UserCart::where('user_id', auth()->user()->id)->get();
        $data['total_quantity'] = $this->getQuantityTotal();
        $data['total_price'] = $this->getPriceTotal();
        return view('livewire.pages.front.cart.cart', $data);
    }
}
