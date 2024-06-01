<?php

namespace App\Livewire\Backend\Pages\Orders;

use App\Models\ShippingPoint;
use App\Models\UserOrder;
use App\Models\UserOrderItem;
use Livewire\Component;

class OrderSingle extends Component
{
    public $order;
    public $orderItems;
    public $shipping_point;

    public function mount($order_id)
    {
        $this->order = UserOrder::where('id', $order_id)->first();
        $this->orderItems = UserOrderItem::where('user_order_id', $order_id)->get();
        if($this->order->shipping_point_id){
            $this->shipping_point = ShippingPoint::where('id', $this->order->shipping_point_id)->first();
        }
    }

    public function changeState($state)
    {
        if($state == 'ship') {
            $good_state = 3;
        } else {
            $good_state = 4;
        }
        $this->order->state = $good_state;
        $this->order->update();
    }

    public function render()
    {
        return view('livewire.backend.pages.orders.order-single');
    }
}
