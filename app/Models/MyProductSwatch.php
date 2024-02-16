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
    $product = MyProduct::find($this->product_id);

    if (!$product) {
        // Handle the case where the product is not found
        return $price;
    }

//    $user_group = CustomerGroup::find(auth()->user()->customer_group_id);
//
//    if (!$user_group) {
//        // Handle the case where the user group is not found
//        return $price;
//    }

    $product_category = ProductCategory::find($product->category_id);

    if (!$product_category) {
        // Handle the case where the product category is not found
        return $price;
    }

    $category_customer_group = $product_category->customerGroups()->where('customer_group_id', $user_group->id)->first();

    if (!$category_customer_group) {
        // Handle the case where the category customer group is not found
        return $price;
    }

    $product_category_discount = $category_customer_group->pivot->discount_percentage;

    if ($product_category_discount != null) {
        $discount_amount = $price * ($product_category_discount / 100);
        $discount = $price - $discount_amount;
        return $discount;
    }

    return $price;
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
