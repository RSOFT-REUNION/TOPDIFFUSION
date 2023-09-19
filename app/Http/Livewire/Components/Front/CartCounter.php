<?php

namespace App\Http\Livewire\Components\Front;

use App\Models\UserCart;
use Livewire\Component;

class CartCounter extends Component
{
    // Récupère l'instruction en temps réel
    protected $listeners = ['refreshLines' => '$refresh'];
    public function render()
    {
        $data = [];
        $data['counter'] = UserCart::where('user_id', auth()->user()->id)->sum('quantity');
        return view('livewire.components.front.cart-counter', $data);
    }
}
