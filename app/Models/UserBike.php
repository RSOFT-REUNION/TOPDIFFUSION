<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBike extends Model
{
    use HasFactory;

    // Récupérer les informations de la moto
    public function name()
    {
        $bike = Bikes::where('id', $this->bike_id)->first();
        return $bike->brand . ' ' . $bike->model . ' (' . $bike->cylinder . ') - ' . $bike->year;
    }
}
