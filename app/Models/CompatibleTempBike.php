<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompatibleTempBike extends Model
{
    use HasFactory;

    protected $table = 'compatible_temp_bikes';

    public function getBike()
    {
        return bike::where('id', $this->bike_id)->first();
    }
}
