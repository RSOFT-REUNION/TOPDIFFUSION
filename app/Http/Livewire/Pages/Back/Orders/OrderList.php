<?php

namespace App\Http\Livewire\Pages\Back\Orders;

use App\Models\UserOrder;
use Livewire\Component;

class OrderList extends Component
{
    public function render()
    {
        $data= [];
        $data['orders'] = UserOrder::orderBy('created_at', 'desc')->get();
        return view('livewire.pages.back.orders.order-list', $data);
    }
}
