<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    use HasFactory;

    public function getProduct()
    {
        return Product::where('id', $this->product_id)->first();
    }

    public function getProductVariant()
    {
        return ProductData::where('id', $this->variant_id)->first();
    }

}
