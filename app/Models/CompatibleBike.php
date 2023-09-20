<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompatibleBike extends Model
{
    use HasFactory;

    protected $table = 'compatible_bikes';

    public function bike()
    {
        return $this->belongsTo(bike::class, 'bike_id');
    }
}
