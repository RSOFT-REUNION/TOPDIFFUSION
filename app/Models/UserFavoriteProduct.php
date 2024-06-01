<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFavoriteProduct extends Model
{
    use HasFactory;

    // Récupérer le produit favoris
    public function product()
    {
        return Product::where('id', $this->product_id)->first();
    }
}
