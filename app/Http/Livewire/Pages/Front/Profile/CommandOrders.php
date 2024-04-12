<?php

namespace App\Http\Livewire\Pages\Front\Profile;

use App\Models\UserOrder;
use Livewire\Component;

class CommandOrders extends Component
{
    public function render()
    {
        $data = [];
        $data['orders'] = UserOrder::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
        return view('livewire.pages.front.profile.command-orders', $data);
    }
}
