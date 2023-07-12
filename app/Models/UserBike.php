<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBike extends Model
{
    use HasFactory;

    /*
     * Retrieve good bike
     */
    public function getBike()
    {
        return bike::where('id', $this->bike_id)->first();
    }
}
