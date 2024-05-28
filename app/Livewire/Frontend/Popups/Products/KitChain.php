<?php

namespace App\Livewire\Frontend\Popups\Products;

use App\Models\Bikes;
use App\Models\Product;
use App\Models\ProductBike;
use App\Models\ProductData;
use App\Models\ProductStock;
use App\Models\UserCart;
use App\Models\UserCartItem;
use LivewireUI\Modal\ModalComponent;

class KitChain extends ModalComponent
{
    public $bike;
    public $products = [];
    public $chains = [];
    public $pignons = [];
    public $crowns = [];

    public $chain_type;
    public $pignon_denture;
    public $crown_denture;

    public $kit_price;

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function mount($bike)
    {
        $this->bike = Bikes::where('id', $bike)->first();
        $this->getProducts();
    }

    public function updated()
    {
        if($this->pignon_denture && $this->crown_denture && $this->chain_type) {
            $this->kit_price = 0;

            // Récupération du produit lié à la chaine
            $product_chain = Product::where('id', $this->chain_type)->first();
            $this->kit_price += $product_chain->getUnitPrice();

            // Récupération du produit lié au pignon
            $product_pignon = Product::where('id', $this->pignon_denture)->first();
            $this->kit_price += $product_pignon->getUnitPrice();

            // Récupération du produit lié à la couronne
            $product_crown = Product::where('id', $this->crown_denture)->first();
            $this->kit_price += $product_crown->getUnitPrice();

        }
    }

    public function getProducts()
    {
        $product_bikes = ProductBike::where('bike_id', $this->bike->id)->get();
        foreach ($product_bikes as $bike) {
            $product = Product::find($bike->product_id);
            $product_data = ProductData::where('product_id', $product->id)->first();
            if($product->type == 'kit')
                $this->products[] = $product;
                if($product_data->kit_element == 'chain') {
                    $this->chains[] = $product;
                } elseif($product_data->kit_element == 'pignon') {
                    $this->pignons[] = $product;
                } elseif($product_data->kit_element == 'crown') {
                    $this->crowns[] = $product;
                }

        }
    }

    // Fonction privé d'ajout des produits dans le panier
    private function addProductToCart($cart, $productId, $productDataId, $quantity)
    {
        $cartItem = UserCartItem::where('user_cart_id', $cart->id)
            ->where('product_id', $productId)
            ->where('product_data_id', $productDataId)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            if ($cartItem->update()) {
                // Mettre à jour les stocks
                $this->updateStock($productId, $productDataId, $quantity);
            }
        } else {
            $cartItem = new UserCartItem;
            $cartItem->user_cart_id = $cart->id;
            $cartItem->product_id = $productId;
            $cartItem->product_data_id = $productDataId;
            $cartItem->quantity = $quantity;
            if ($cartItem->save()) {
                // Mettre à jour les stocks
                $this->updateStock($productId, $productDataId, $quantity);
            }
        }
    }

    private function updateStock($productId, $productDataId, $quantity)
    {
        $stock = ProductStock::where('product_id', $productId)
            ->where('variant_id', $productDataId)
            ->first();
        if ($stock) {
            $stock->quantity -= $quantity;
            $stock->update();
        }
    }

    // Envoi du kit dans le panier
    public function sendToCart()
    {
        $product_chain = Product::where('id', $this->chain_type)->first();
        $product_pignon = Product::where('id', $this->pignon_denture)->first();
        $product_crown = Product::where('id', $this->crown_denture)->first();

        $quantity = 1;

        $cart = UserCart::where('user_id', auth()->user()->id)->first();

        if (!$cart) {
            $cart = new UserCart;
            $cart->state = 0;
            $cart->user_id = auth()->user()->id;
            $cart->save();
        }

        // Ajout des produits au panier
        $this->addProductToCart($cart, $product_chain->id, $this->chain_type, $quantity);
        $this->addProductToCart($cart, $product_pignon->id, $this->pignon_denture, $quantity);
        $this->addProductToCart($cart, $product_crown->id, $this->crown_denture, $quantity);

        $this->dispatch('cartUpdated');
        $this->dispatch('closeModal');

    }

    public function render()
    {
        $data = [];
        $data['products'] = $this->products;
        return view('livewire.frontend.popups.products.kit-chain', $data);
    }
}
