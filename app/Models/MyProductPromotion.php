<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyProductPromotion extends Model
{
    use HasFactory;

    public function promotionItems(){
        return $this->hasMany(MyProductPromotionItems::class, 'product_id'); // Note: je suppose que la clé étrangère est 'promotion_id'. Ajustez selon votre base de données.
    }


}
