<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyProductSwatch extends Model
{
    use HasFactory;


    // Récupérer le prix TTC du produit
    public function getPriceTTC()
    {
        $price = $this->price_ttc;
        return $price;
    }

    // Récupérer le prix HT du produit
    public function getPriceHT()
    {
        $price = $this->price_ht;
        return number_format($price, '2', ',', ' ');
    }

     //Récupérer le prix Pro avec les remises
    public function getPriceWithDiscount()
    {
        $price = $this->price_ht;
        $product = MyProduct::where('product_id', $this->product_id)->first();
        $discountCategory = ProductCategoriesDiscount::where('group_id', auth()->user()->group_user)->where('category_id', $product->category_id)->first()->discount;

        // Si l'utilisateur est un professionnel
        if(auth()->user()->professionnal == 1 && auth()->user()->verified == 1) {
            return $discountCategory;
        }

    }


    public function getPriceProfessionnal()
    {
        $price =  $this->professionnal_price;
        return number_format($price, '2', ',', ' ');
    }

    public function getPriceCustomer()
    {
        $price =  $this->customer_price;
        return number_format($price, '2', ',', ' ');
    }

    public function getPricePourcentage()
    {
        $percent = $this->pourcentage_price;
        return $percent;
    }

    // Récupération des groupes pour les produits variables
    public function getVariablesGroup()
    {
        return ProductGroupTag::where('id', $this->swatch_group_id)->first();
    }

    // Récupération des items lié au groupe
    public function getVariablesItem()
    {
        return ProductTag::where('id', $this->swatch_tags_id)->first();
    }
}
