<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingPoint extends Model
{
    use HasFactory;

    public function getFullAddress()
    {
        return $this->address . ', ' . $this->zip_code . ' - ' . $this->city;
    }
}
