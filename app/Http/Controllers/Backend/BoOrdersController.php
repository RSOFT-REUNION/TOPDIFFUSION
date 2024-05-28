<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BoOrdersController extends Controller
{
    // Affichage de la pages des messages
    public function showOrders()
    {
        $data = [
            'group_page' => 'backend',
            'page' => 'orders',
        ];
        return view('pages.backend.orders.orders', $data);
    }
}
