<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductData extends Model
{
    use HasFactory;

    // Spécifiez la table associée à ce modèle
    protected $table = 'product_data';

    public function getStock()
    {
        return ProductStock::where('product_id', $this->product_id)->where('variant_id', $this->id)->first()->quantity;
    }
}
