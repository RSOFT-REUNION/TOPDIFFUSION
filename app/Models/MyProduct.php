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

    public function swatches()
    {
        return $this->hasMany(MyProductSwatch::class, 'product_id');
    }

    public function getCategory()
    {
        return ProductCategory::where('id', $this->category_id)->first();
    }

    // Avoir le type du produit sous forme de badge
    public function getTypeBadge()
    {
        $type = [
            '',
            '<span class="text-sm border border-gray-300 px-2 py-1 rounded-md">Produit simple</span>',
            '<span class="text-sm border bg-yellow-100 text-yellow-500 border-yellow-300 px-2 py-1 rounded-md">Produit décliné</span>',
            '<span class="text-sm border bg-purple-100 text-purple-500 border-purple-300 px-2 py-1 rounded-md">Kit chaine</span>',
            '<span class="text-sm border bg-blue-100 text-blue-500 border-blue-300 px-2 py-1 rounded-md">Pneus</span>',
        ];

        return isset($type[$this->type]) ? $type[$this->type] : null;
    }

    // Avoir le type du produit sous forme de texte
    public function getType()
    {
        $type = [
            '',
            'Produit simple',
            'Produit décliné',
            'Kit chaine',
            'Pneus',
        ];

        return isset($type[$this->type]) ? $type[$this->type] : null;
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

    // Récupérer les swatches
    public function getSwatches()
    {
        $values = MyProductSwatch::where('product_id', $this->id)->get();
        if($values->count() > 1) {
            return $values;
        } else {
            return null;
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

    // Récupérer le prix HT du produit
    public function getPriceHT()
    {
        $values = MyProductSwatch::where('product_id', $this->id)->pluck('price_ht')->toArray();
        foreach ($values as $value)
        {
            return $value;
            break;
        }
    }

    // Récupérer le prix TTC du produit
    public function getPriceTTC()
    {
        $values = MyProductSwatch::where('product_id', $this->id)->pluck('price_ttc')->toArray();
        foreach ($values as $value)
        {
            return $value;
            break;
        }
    }

    // Récupérer la promotion
    public function promotion()
    {
        return $this->belongsToMany(MyProductPromotion::class, 'my_product_promotion_items', 'product_id', 'group_id');
    }

    // Récupérer le prix Pro avec les remises
    public function getPriceWithDiscount()
    {
        $price = $this->getPriceHT();
        $user = auth()->user();
        $discountCategory = ProductCategoriesDiscount::where('group_id', $user->group_user)->where('category_id', $this->category_id)->first()->discount;
        return $price*(1-$discountCategory/100);
    }

    // Récupérer le % de remise du client
    public function getCustomerDiscount()
    {
        $price = $this->getPriceHT();
        $user = auth()->user();
        $discountCategory = ProductCategoriesDiscount::where('group_id', $user->group_user)->where('category_id', $this->category_id)->first()->discount;
        return $discountCategory;
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
