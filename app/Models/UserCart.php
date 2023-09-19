<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCart extends Model
{
    use HasFactory;

    public function getProduct()
    {
        return MyProduct::where('id', $this->product_id)->first();
    }

    // Récupération des swatches
    public function getSwatches()
    {
        return MyProductSwatch::where('id', $this->swatch_id)->first();
    }

    // Avoir le prix unitaire de chaque article
    public function getUnitPrice()
    {
        return number_format($this->getSwatches()->professionnal_price, '2', ',', ' ');
    }

    // Récupérer la quantité en stock de l'article
    public function getProductStock()
    {
        return MyProductStock::where('product_id', $this->product_id)->first();
    }

    // Avoir le prix total de chaque article à la ligne
    public function getTotalPriceLine()
    {
        $amount = $this->getSwatches()->professionnal_price * $this->quantity;
        return number_format($amount, '2', ',', ' ');
    }

    // Avoir le prix total de chaque article à la ligne sans la mise en forme
    public function getTotalPriceLineBlank()
    {
        $amount = $this->getSwatches()->professionnal_price * $this->quantity;
        return $amount;
    }
}
