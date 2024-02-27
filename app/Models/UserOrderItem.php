<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOrderItem extends Model
{
    use HasFactory;

    // Récupération des informations du produit
    public function Product()
    {
        return MyProduct::where('id', $this->product_id)->first();
    }

    // Récupération des informations du produit
    public function Swatch()
    {
        return MyProductSwatch::where('id', $this->product_swatch_id)->first();
    }

    // Avoir le prix total de la ligne
    public function getTotalLinePrice()
    {
        $unit_price = intval($this->product_price);
        $quantity = $this->quantity;
        $result = $unit_price * $quantity;
        return number_format($result, '2', ',', ' ');
    }

    public function ProductItem()
    {
        return $this->belongsTo(MyProduct::class, 'product_id');
    }
}
