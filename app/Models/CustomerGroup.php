<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerGroup extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'discount_percentage', 'is_default'];


    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function productCategories()
    {
        return $this->belongsToMany(ProductCategory::class, 'category_customer_group')
            ->withPivot('discount_percentage');
    }
}
