<?php

namespace App\Models;

use App\Helpers\ConfigHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCart extends Model
{
    use HasFactory;

    // Afficher le nombre de produit présent dans le panier (en terme de quantité)
    public function getCartQuantityCount()
    {
        return UserCartItem::where('user_cart_id', $this->id)->sum('quantity');
    }

    // Avoir le montant total HT
    public function getCartTotalHT()
    {
        $total = 0.0;
        $cartItems = UserCartItem::where('user_cart_id', $this->id)->get();
        foreach($cartItems as $item) {
            $total += $item->productData()->price_unit * $item->quantity;
        }
        return $total;
    }

    // Avoir le montant des frais de livraison
    public function getShippingTax()
    {
        $total = $this->getCartTotalHT();
        $taxes = ShippingTaxe::where('max_price', '<=', $total)->latest('max_price')->first()->amount;
        return $taxes;
    }

    // Avoir le montant de la TVA
    public function getTVA()
    {
        $total = 0.0;
        $rate_tva = TvaRate::where('default', 1)->first()->rate;
        $cartItems = UserCartItem::where('user_cart_id', $this->id)->get();
        foreach ($cartItems as $item)
        {
            $tva = $item->productData()->price_unit * $rate_tva / 100;
            $total += $tva * $item->quantity;
        }

        return $total;
    }

    // Avoir le montant total de la remise de groupe
    public function getGroupDiscount()
    {
        $group_discount = UserGroup::where('id', auth()->user()->group_id)->first()->discount;
        $total = $this->getCartTotalHT() * $group_discount / 100;
        return $total;
    }

    // Avoir le montant total du produit
    public function getTotalPrice()
    {
        if(ConfigHelper::getSettings()['shipping']) {
            // Frais de livraison actif
            $taxes = 1;
            $amount = $this->getShippingTax();
        } else {
            // Frais de livraison pas actif
            $taxes = 0;
        }
        if($this->getGroupDiscount() > 0) {
            if($taxes == 1) {
                $total = $this->getCartTotalHT() - $this->getGroupDiscount() + $this->getTVA() + $amount;
            } else {
                $total = $this->getCartTotalHT() - $this->getGroupDiscount() + $this->getTVA();
            }
            return $total;
        } else {
            if($taxes == 1) {
                $total = $this->getCartTotalHT() + $this->getTVA() + $amount;
            } else {
                $total = $this->getCartTotalHT() + $this->getTVA();
            }
            return $total;
        }
    }
}
