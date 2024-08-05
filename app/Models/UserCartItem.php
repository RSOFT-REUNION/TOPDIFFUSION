<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCartItem extends Model
{
    use HasFactory;

    // Récupérer les informations du produit
    public function product()
    {
        return Product::where('id', $this->product_id)->first();
    }

    // Récupérer les données du produit
    public function productData()
    {
        return ProductData::where('id', $this->product_data_id)->first();
    }
}
