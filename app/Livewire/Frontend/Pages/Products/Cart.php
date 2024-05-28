<?php

namespace App\Livewire\Frontend\Pages\Products;

use App\Models\ProductStock;
use App\Models\UserCart;
use App\Models\UserCartItem;
use Livewire\Component;

class Cart extends Component
{
    public $cart;
    public $cartItems;

    protected $listeners = ['cartUpdated'];

    public function mount()
    {
        $this->cart = UserCart::where('user_id', auth()->id())->first();
        $this->cartItems = UserCartItem::where('user_cart_id', $this->cart->id)->get();
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

    public function render()
    {
        return view('livewire.frontend.pages.products.cart');
    }
}
