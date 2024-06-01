<?php

namespace App\Livewire\Frontend\Pages\Profile;

use App\Models\Bikes;
use App\Models\UserBike;
use App\Models\UserFavoriteProduct;
use App\Models\UserOrder;
use Livewire\Component;

class Profile extends Component
{
    public function searchProducts($id)
    {
        return to_route('fo.product.list.bikes', $id);
    }

    public function deleteBike($id)
    {
        UserBike::where('id', $id)->delete();
    }

    public function render()
    {
        $data = [];
        $data['user'] = auth()->user();
        $data['favorites'] = UserFavoriteProduct::where('user_id', auth()->user()->id)->count();
        $data['bikes'] = UserBike::where('user_id', auth()->user()->id)->get();
        $data['order_pending'] = UserOrder::where('user_id', auth()->user()->id)->where('state', '<>',2)->count();
        $data['order_terminate'] = UserOrder::where('user_id', auth()->user()->id)->where('state',2)->count();
        return view('livewire.frontend.pages.profile.profile', $data);
    }
}
