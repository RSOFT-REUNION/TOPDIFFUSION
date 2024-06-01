<?php

namespace App\Livewire\Frontend\Pages\Products;

use App\Models\ProductStock;
use App\Models\UserCart;
use App\Models\UserCartItem;
use App\Models\UserOrder;
use App\Models\UserOrderItem;
use Illuminate\Support\Str;
use Livewire\Component;

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
        $order->user_id = auth()->id();
        if($this->shipping_address) {
            $order->shipping_point_id = $this->shipping_address;
        }
        if($type == 'card') {
            $order->payment_method = 'card';
            $order->is_paid = true;
            $order->state = 1; // Commande acceptée sans paiement (0) ou payée (1)
        } elseif($type == 'virement') {
            $order->payment_method = 'virement';
            $order->is_paid = false;
            $order->state = 0; // Commande acceptée sans paiement (0) ou payée (1)
        } else {
            $order->payment_method = 'later';
            $order->is_paid = false;
            $order->state = 0; // Commande acceptée sans paiement (0) ou payée (1)
        }
        $order->total = $cart->getTotalPrice();

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
                // Supprimer l'article du panier
                $item->delete();
            }
            // Supprimer le panier
            $cart->delete();

            return to_route('fo.home')->with('success', 'Votre commande a été enregistrée avec succès !');
        }
    }

    public function render()
    {
        return view('livewire.frontend.pages.products.cart');
    }
}
