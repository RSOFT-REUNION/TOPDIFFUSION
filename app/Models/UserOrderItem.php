<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOrderItem extends Model
{
    use HasFactory;

    // Récupérer les informations du produit
    public function product()
    {
        return Product::where('id', $this->product_id)->first();
    }
}
