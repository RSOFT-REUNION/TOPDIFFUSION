<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\SettingGeneral;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Affichage de la page de Panier
    public function showCart()
    {
        $data = [];
        $data['page'] = 'cart';
        $data['setting'] = SettingGeneral::where('id', 1)->first();
        return view('pages.frontend.cart.cart', $data);
    }
}
