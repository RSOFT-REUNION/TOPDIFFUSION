<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\UserCart;
use App\Models\UserCartItem;
use Illuminate\Http\Request;

class BackendController extends Controller
{
    // Affichage de la page de connexion au backend
    public function showLoginBackend()
    {
        return view('pages.backend.login');
    }

    // Fonction de la page de connexion au backend
    public function postLoginBackend()
    {
        $result = auth()->attempt([
            'email' => request('email'),
            'password' => request('password')
        ]);

        if($result) {
            return redirect()->route('bo.dashboard');
        } else {
            return redirect()->back()->with('error', 'Email ou mot de passe incorrect');
        }
    }

    private function getAmountPrice()
    {
        $total = 0.0;
        $cartItems = UserCartItem::all();
        foreach($cartItems as $item) {
            $total += $item->productData()->price_unit * $item->quantity;
        }
        return $total;
    }

    // Affichage du tableau de bord
    public function showDashboard()
    {
        $data = [
            'group_page' => 'backend',
            'page' => 'dashboard',
        ];
        $data['products_cart'] = UserCartItem::all();
        $data['cart_amount'] = $this->getAmountPrice();
        $data['stock_rupture'] = ProductStock::where('quantity', 0)->get();
        $data['stock_low'] = ProductStock::where('quantity', '<=',3)->where('quantity', '>', 0)->get();
        return view('pages.backend.dashboard', $data);
    }

    // Affichage de la pages des messages
    public function showMessages()
    {
        $data = [
            'group_page' => 'backend',
            'page' => 'messages',
        ];
        return view('pages.backend.messages', $data);
    }
}
