<?php

namespace App\Http\Livewire;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class PopupTest extends ModalComponent
{
    public function render()
    {
        return view('livewire.popup-test');
    }
}
