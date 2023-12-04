<?php

namespace App\Http\Livewire\Popups;

use LivewireUI\Modal\ModalComponent;

class RelayPoint extends ModalComponent
{

    public $selectedRelay = null;

    public function render()
    {
        return view('livewire.popups.relay-point');
    }
}
