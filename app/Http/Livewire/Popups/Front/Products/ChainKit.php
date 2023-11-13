<?php

namespace App\Http\Livewire\Popups\Front\Products;

use App\Models\bike;
use LivewireUI\Modal\ModalComponent;

class ChainKit extends ModalComponent
{
    public $bike;

    // passer la taille de la modal en 6xl
    public static function modalMaxWidth(): string
    {
        return '6xl';
    }

    public function mount($bike)
    {
        $this->bike = bike::where('id', $bike)->first();
    }

    public function render()
    {
        return view('livewire.popups.front.products.chain-kit');
    }
}
