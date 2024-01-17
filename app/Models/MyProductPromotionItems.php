<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyProductPromotionItems extends Model
{
    use HasFactory;

    public function product(){
        return $this->belongsTo(MyProduct::class, 'product_id');
    }

    public function promotion()
    {
        return $this->belongsTo(MyProductPromotion::class, 'group_id');
    }

}
