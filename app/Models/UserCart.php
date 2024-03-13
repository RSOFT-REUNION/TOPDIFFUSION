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
        $product = MyProduct::where('id', $this->product_id)->first();
         if(auth()->user()->professionnal == 1 && auth()->user()->verified == 1) {
             return number_format($product->getPriceWithDiscount(), '2', ',', ' ');
         } else {
             return number_format($product->getPriceWithDiscount(), '2', ',', ' ');
         }
    }

    // Récupérer la quantité en stock de l'article
    public function getProductStock()
    {
        return MyProductStock::where('product_id', $this->product_id)->first();
    }

    // Avoir le prix total de chaque article à la ligne
    public function getTotalPriceLine()
    {
        $product = MyProduct::where('id', $this->product_id)->first();
        if(auth()->user()->professionnal == 1 && auth()->user()->verified == 1) {
            // Avoir le tarif unitaire
            $amount = $product->getPriceWithDiscount() * $this->quantity;
            return number_format($amount, '2', ',', ' ');
        } else {
            // Avoir le tarif unitaire
            $amount = $product->getPriceWithDiscount() * $this->quantity;
            return number_format($amount, '2', ',', ' ');
        }

    }

    // Avoir le montant économisé
    public function getTotalPriceSpend()
    {
        $product = MyProduct::where('id', $this->product_id)->first();
        if(auth()->user()->professionnal == 1 && auth()->user()->verified == 1) {
            $amount = $product->getPriceHT();
            return $amount;
        }
    }

    // Avoir le prix total de chaque article à la ligne sans la mise en forme
    public function getTotalPriceLineBlank()
    {
        $product = MyProduct::where('id', $this->product_id)->first();
        if(auth()->user()->professionnal == 1 && auth()->user()->verified == 1) {
            $amount = $product->getPriceWithDiscount() * $this->quantity;
            return $amount;
        } else {
            $amount = $this->getSwatches()->getPriceTTC() * $this->quantity;
            return $amount;
        }
    }

    public function getLinePriceHT()
    {
        $productSwatch = $this->getSwatches();
        return $productSwatch->price_ht * $this->quantity;
    }

    // Cette méthode calcule le montant total des taxes pour une ligne de panier
    public function getLineTaxAmount()
    {
        $productSwatch = $this->getSwatches();
        $taxRate = $productSwatch->tax_rate; // Assurez-vous que cette valeur est définie dans votre modèle
        return $this->getLinePriceHT() * ($taxRate / 100);
    }

    // Cette méthode calcule le prix TTC pour une ligne de panier
    public function getLinePriceTTC()
    {
        return $this->getLinePriceHT() + $this->getLineTaxAmount();
    }

    public function product()
    {
        return $this->belongsTo(MyProduct::class, 'product_id');
    }

    public function getTaxAmount()
    {
        $priceHT = $this->getLinePriceHT(); // Assurez-vous que ceci est un nombre décimal.

        // Convertissez la chaîne formatée en nombre décimal.
        // Remplacez les virgules par des points et convertissez la chaîne en float.
        $priceTTC = floatval(str_replace(',', '.', $this->getTotalPriceLine()));

        // Calculez le montant de la taxe en soustrayant HT de TTC.
        $taxAmount = $priceTTC - $priceHT;

        return $taxAmount;
    }


}
