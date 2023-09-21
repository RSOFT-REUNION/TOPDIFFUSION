<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyProductSwatch extends Model
{
    use HasFactory;

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
