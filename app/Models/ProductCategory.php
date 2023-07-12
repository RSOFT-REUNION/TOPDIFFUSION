<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    public function hasSubCategory()
    {
        return ProductCategory::where('parent_id', $this->id)->get();
    }

    public function getParentCategory()
    {
        return ProductCategory::where('id', $this->parent_id)->first();
    }

    public function getProductsCount()
    {
        return MyProduct::where('category_id', $this->id)->get()->count();
    }

}
