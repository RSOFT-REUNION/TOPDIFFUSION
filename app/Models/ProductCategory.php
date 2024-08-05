<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'icon', 'parent_id', 'parent_id_2'];

    // Fonction afin de récupérer les nombres de produit présent dans une catégorie
    public function getCountProducts()
    {
        return Product::where('category_id', $this->id)->count();
    }
}
