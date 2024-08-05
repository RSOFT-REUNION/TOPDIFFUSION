<?php

namespace App\Livewire\Frontend\Pages\Products;

use App\Livewire\Backend\Pages\Products\ProductBikes;
use App\Models\ProductBike;
use App\Models\ProductData;
use App\Models\ProductStock;
use App\Models\UserBike;
use App\Models\UserCart;
use App\Models\UserCartItem;
use App\Models\UserFavoriteProduct;
use Livewire\Component;

class ProductSingle extends Component
{
    public $product;
    public $bikes;
    public $product_data;
    public $selectedColor;
    public $selectedSize;
    public $selectedVariantId;
    public $quantity = 1;
    public $stock_quantity;

    protected $listeners = ['cartUpdated'];

    public function mount($product)
    {
        $this->product = $product;
        $this->product_data = ProductData::where('product_id', $this->product->id)->get();
        $this->bikes = ProductBike::where('product_id', $this->product->id)->get();
        $this->selectedColor = null;
        $this->selectedSize = null;
        $this->selectedVariantId = null;
        $this->stock_quantity = 0;
    }

    public function selectColor($id)
    {
        $this->selectedColor = $id;
        $this->selectedSize = null;
        $this->quantity = 1;
        $this->updateSelectedVariantId();
    }

    public function selectSize($id)
    {
        $this->selectedSize = $id;
        $this->quantity = 1;
        $this->updateSelectedVariantId();
    }

    public function updateSelectedVariantId()
    {
        if ($this->selectedColor && $this->selectedSize) {
            $variant = ProductData::where('product_id', $this->product->id)
                ->where('color', $this->selectedColor)
                ->where('size', $this->selectedSize)
                ->first();

            $this->selectedVariantId = $variant ? $variant->id : null;
        } else {
            $this->selectedVariantId = null;
        }
    }


    // Ajout d'une quantité au panier
    public function plusQuantity()
    {
        if($this->product->type == 'simple' || $this->product->type == 'kit') {
            $stock = ProductStock::where('product_id', $this->product->id)->first();
        } else {
            $stock = ProductStock::where('id', $this->selectedVariantId)->first();
        }
        // Si la quantité est plus petite que celle en stock, on ajoute 1
        if($this->quantity < $stock->quantity) {
            $this->quantity += 1;
        }
    }

    // Ajout d'une quantité au panier
    public function minusQuantity()
    {
        if($this->quantity < 2) {
            $this->quantity = 1;
        } else {
            $this->quantity -= 1;
        }
    }

    // Fonction d'ajout au panier
    public function addToCart()
    {
        $data = ProductData::where('product_id', $this->product->id)->first();
        $cart = UserCart::where('user_id', auth()->user()->id)->first();
        // Ajout du produit dans le panier
        if($cart) {
            $cartItem = UserCartItem::where('user_cart_id', $cart->id)->where('product_id', $this->product->id)->where('product_data_id', $data->id)->first();
            if($cartItem) {
                $cartItem->quantity = $cartItem->quantity + $this->quantity;
                if($cartItem->update()) {
                    // Mettre à jour les stocks
                    $stock = ProductStock::where('product_id', $this->product->id)->where('variant_id', $data->id)->first();
                    $stock->quantity = $stock->quantity - $this->quantity;
                    $stock->update();
                }
            } else {
                $cartItem = new UserCartItem;
                $cartItem->user_cart_id = $cart->id;
                $cartItem->product_id = $this->product->id;
                $cartItem->product_data_id = $data->id;
                $cartItem->quantity = $this->quantity;
                if($cartItem->save()) {
                    // Mettre à jour les stocks
                    $stock = ProductStock::where('product_id', $this->product->id)->where('variant_id', $data->id)->first();
                    $stock->quantity = $stock->quantity - $this->quantity;
                    $stock->update();
                }
            }
        } else {
            $cart = new UserCart;
            $cart->state = 0;
            $cart->user_id = auth()->user()->id;
            if($cart->save()) {
                $cartItem = new UserCartItem;
                $cartItem->user_cart_id = $cart->id;
                $cartItem->product_id = $this->product->id;
                $cartItem->product_data_id = $data->id;
                $cartItem->quantity = $this->quantity;
                if($cartItem->save()) {
                    // Mettre à jour les stocks
                    $stock = ProductStock::where('product_id', $this->product->id)->where('variant_id', $data->id)->first();
                    $stock->quantity = $stock->quantity - $this->quantity;
                    $stock->update();
                }
            }
        }

        $this->dispatch('cartUpdated');
    }

    // Fonction afin de mettre le produit en favoris
    public function favorite()
    {
        $userFavorite = UserFavoriteProduct::where('user_id', auth()->user()->id)->where('product_id', $this->product->id)->first();
        if($userFavorite) {
            $userFavorite->delete();
        } else {
            $userFavorite = new UserFavoriteProduct;
            $userFavorite->user_id = auth()->user()->id;
            $userFavorite->product_id = $this->product->id;
            $userFavorite->save();
        }
    }

    // Fonction afin de déterminer si le produit est compatible ou non
    private function isCompatible()
    {
        if(auth()->check()) {
            $userBike = UserBike::where('user_id', auth()->user()->id)->get();
            foreach ($userBike as $bike) {
                foreach ($this->bikes as $productBike) {
                    if($bike->bike_id == $productBike->bike_id) {
                        return true;
                    } else {
                        return false;
                    }
                }
            }
        }

    }

    public function render()
    {
        $data = [];
        $data['isCompatible'] = $this->isCompatible();
        return view('livewire.frontend.pages.products.product-single', $data);
    }
}
