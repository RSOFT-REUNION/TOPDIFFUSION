<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTemp extends Model
{
    use HasFactory;

    // Récupérer les informations des marques.
    public function getBrand()
    {
        return ProductBrand::where('id', $this->brand_id)->first();
    }

    // Récupérer les informations des categories.
    public function getCategory()
    {
        return ProductCategory::where('id', $this->category_id)->first();
    }
}
