<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\UserOrder;
use App\Models\UserOrderItem;

class BoOrderController extends Controller
{
    // Affichage de la liste des commandes
    public function showOrders()
    {
        $data = [];
        $data['group'] = 'orders';
        $data['page'] = 'orders';
        return view('pages.backend.orders.order-list', $data);
    }

    // Affichage d'une commande seule
    public function showSingleOrder($order)
    {
        $my_order = UserOrder::where('document_number', $order)->first();

        $data = [];
        $data['group'] = 'orders';
        $data['page'] = 'orders';
        $data['order'] = $my_order;
        $data['order_items'] = UserOrderItem::where('order_id', $my_order->id)->get();
        return view('pages.backend.orders.order-single', $data);
    }

    // Affichage de la facture
    public function showInvoiceFile()
    {
        return view('pages.backend.orders.view-invoice');
    }
}
