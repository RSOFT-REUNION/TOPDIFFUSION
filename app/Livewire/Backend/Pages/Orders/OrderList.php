<?php

namespace App\Livewire\Backend\Pages\Orders;

use App\Models\UserOrder;
use Livewire\Component;

class OrderList extends Component
{
    public $orders; // Liste des commandes

    public function mount()
    {
        $this->orders = UserOrder::orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        $data = [];
        $data['orders_count'] = UserOrder::all()->count();
        $data['orders_pending'] = UserOrder::where('state', '<', 2)->get();
        $data['orders_terminate'] = UserOrder::where('state', '>', 2)->get();
        return view('livewire.backend.pages.orders.order-list', $data);
    }
}
