<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Bikes;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Livewire\Livewire;

class FrontendController extends Controller
{
    // Affichage de la page d'accueil
    public function showHomePage()
    {
        $data = [];
        $data['products'] = Product::orderBy('created_at', 'desc')->get()->take('8');
        $data['brands'] = ProductBrand::orderBy('created_at', 'desc')->get()->take('4');
        return view('pages.frontend.home', $data);
    }

    // Affichage de la page des d'inscription
    public function showRegisterPage()
    {
        if(auth()->check())
        {
            return to_route('fo.home')->with('info', 'Vous êtes déjà connecté');
        } else {
            return view('pages.frontend.register');
        }
    }

    /*
     * Gestion des produits
     */

    // Affichage d'un produit simple
    public function showSingleProduct($slug)
    {
        $data = [];
        $data['product'] = Product::where('slug', $slug)->first();
        return view('pages.frontend.products.product_single', $data);
    }

    // Affichage du panier de produit
    public function showCart()
    {
        $data = [];
        return view('pages.frontend.products.cart', $data);
    }

    // Affichage des motos par filtres
    public function showBikesByFilters($id)
    {
        $data = [];
        $data['bike'] = Bikes::where('id', $id)->first();
        return view('pages.frontend.products.product_list_bikes', $data);
    }

    // Affichage des produits par categories
    public function showProductByCategory($slug)
    {
        $category = ProductCategory::where('slug', $slug)->first();
        $data = [];
        $data['category'] = $category;
        $data['products'] = Product::where('category_id', $category->id)->get();
        return view('pages.frontend.products.product_category', $data);
    }


    /*
     * Gestion du profil
     */

    // Affichage de la page de profil
    public function showProfile()
    {
        $data = [];
        return view('pages.frontend.profile.profile');
    }
}
