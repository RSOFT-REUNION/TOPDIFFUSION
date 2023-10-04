<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyProductPromotion extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->belongsToMany(MyProduct::class, 'my_product_promotion_items', 'group_id', 'product_id');
    }

}
