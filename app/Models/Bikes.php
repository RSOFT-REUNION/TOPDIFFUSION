<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bikes extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand', 'model', 'cylinder', 'year'
    ];

    // Récupérer le nombre de produit associé à une moto
    public function getProductCount()
    {
        $count = ProductBike::where('bike_id', $this->id)->count();
        if($count > 0) {
            return $count;
        } else {
            return '--';
        }
    }
}
