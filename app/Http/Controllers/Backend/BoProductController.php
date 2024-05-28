<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Bikes;
use Illuminate\Http\Request;

class BoProductController extends Controller
{
    // Affichage de la liste des produits
    public function showProductList()
    {
        $data = [
            'group_page' => 'products',
            'page' => 'products'
        ];
        return view('pages.backend.products.product_list', $data);
    }

    // Affichage de la page de création d'un produit
    public function showProductAdd($type)
    {
        $data = [
            'group_page' => 'products',
            'page' => 'products',
            'type' => $type
        ];
        return view('pages.backend.products.product_add', $data);
    }

    // Affichage de la liste des catégories de produits
    public function showCategoriesList()
    {
        $data = [
            'group_page' => 'products',
            'page' => 'categories'
        ];
        return view('pages.backend.products.product_categories', $data);
    }

    // Affichage de la liste des marques de produits
    public function showBrandsList()
    {
        $data = [
            'group_page' => 'products',
            'page' => 'brands'
        ];
        return view('pages.backend.products.product_brands', $data);
    }

    // Affichage de la liste des marques de produits
    public function showStockList()
    {
        $data = [
            'group_page' => 'products',
            'page' => 'stocks'
        ];
        return view('pages.backend.products.product_stocks', $data);
    }

    // Affichage de la liste des catégories de produits
    public function showBikesList()
    {
        $data = [
            'group_page' => 'products',
            'page' => 'bikes',
        ];
        return view('pages.backend.products.product_bikes', $data);
    }

    // Affichage de la liste des catégories de produits
    public function showAttributeList()
    {
        $data = [
            'group_page' => 'products',
            'page' => 'attributes',
        ];
        return view('pages.backend.products.product_attribute', $data);
    }

    // Affichage d'un produit simple
    public function showSingleProduct($product_id)
    {
        $data = [
            'group_page' => 'products',
            'page' => 'products',
            'product_id' => $product_id
        ];
        return view('pages.backend.products.product_single', $data);
    }
}
