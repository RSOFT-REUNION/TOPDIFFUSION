<?php

namespace App\Http\Livewire\Components\Front;

use App\Models\UserCart;
use App\Models\UserSetting;
use Livewire\Component;

class CartResume extends Component
{
    protected $listeners = ['refreshLines' => '$refresh'];
    public function render()
    {
        $data = [];
        if(auth()->user()) {
            $data['carts'] = UserCart::where('user_id', auth()->user()->id)->get();
            $data['my_setting'] = UserSetting::where('user_id', auth()->user()->id)->first();
        }
        return view('livewire.components.front.cart-resume', $data);
    }
}
