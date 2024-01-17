<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyProductPromotion extends Model
{
    use HasFactory;

    public function promotionItems(){
        return $this->hasMany(MyProductPromotionItems::class, 'product_id'); // Note : je suppose que la clé étrangère est 'promotion_id'. Ajustez selon votre base de données.
    }

    public function products()
    {
        return $this->belongsToMany(MyProduct::class, 'my_product_promotion_items', 'group_id', 'product_id');
    }

    public function scopeActive($query)
    {
        return $query->where('active', true)
                     ->where('is_manually_activated', false)
                     ->where(function ($query) {
                         $query->where('start_date', '<=', now())
                               ->where('end_date', '>=', now());
                     });
    }

}
