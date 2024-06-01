<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingTaxe extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'max_price'];
}
