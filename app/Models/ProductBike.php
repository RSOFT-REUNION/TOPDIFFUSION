<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBike extends Model
{
    use HasFactory;

    // Avoir les informations de la moto
    public function getBike()
    {
        return Bikes::where('id', $this->bike_id)->first();
    }
}
