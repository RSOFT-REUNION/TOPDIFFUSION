<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyProduct extends Model
{
    use HasFactory;

    protected $fillable = ['promotion', 'promotion_group'];

    public function getBrand()
    {
        return ProductBrand::where('id', $this->brand_id)->first();
    }
    public function getCategory()
    {
        return ProductCategory::where('id', $this->category_id)->first();
    }

    public function multipleSwatch()
    {
        $values = MyProductSwatch::where('product_id', $this->id)->get();
        if($values->count() > 1) {
            return 1;
        } else {
            return 0;
        }
    }

    public function getUgs()
    {
        $values =  MyProductSwatch::where('product_id', $this->id)->pluck('ugs')->toArray();
        foreach ($values as $value)
        {
            return $value;
            break;
        }

    }
    public function getPriceCustomer()
    {
        $values =  MyProductSwatch::where('product_id', $this->id)->pluck('customer_price')->toArray();
        foreach ($values as $value)
        {
            return $value;
            break;
        }
    }
    public function getPriceProfessionnal()
    {
        $values =  MyProductSwatch::where('product_id', $this->id)->pluck('professionnal_price')->toArray();
        foreach ($values as $value)
        {
            return $value;
            break;
        }
    }
    public function getPricePourcentage()
    {
        $values =  MyProductSwatch::where('product_id', $this->id)->pluck('pourcentage_price')->toArray();
        foreach ($values as $value)
        {
            return $value;
            break;
        }
    }

    public function promotions()
    {
        return $this->belongsToMany(MyProductPromotion::class, 'my_product_promotion_items', 'product_id', 'group_id');
    }
    public function getDiscount()
    {
        // On récupère la remise du produit en fonction de la promotion actuelle
        $currentPromotion = $this->promotions->first();

        if ($currentPromotion) {
            return $currentPromotion->discount;
        }

        return 0; // Si aucune promotion n'est associée au produit, retournez 0 ou la valeur par défaut souhaitée.
    }


}
