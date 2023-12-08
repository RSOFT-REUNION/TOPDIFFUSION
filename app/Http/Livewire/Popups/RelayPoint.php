<?php

namespace App\Http\Livewire\Popups;

use App\Models\RelaisPoint;
use LivewireUI\Modal\ModalComponent;

class RelayPoint extends ModalComponent
{

    public function chooseRelay()
    {
        $this->emit('relayChosen', $this->selectedRelay);
        $this->emit('closeModal');
    }

    public $selectedRelay = null;

    public function render()
    {
        $data = [];
        $data['relays_points'] = RelaisPoint::all();

        $data['formattedOpeningHours'] = $this->selectedRelay
            ? RelaisPoint::find($this->selectedRelay)->getFormattedOpeningHours()
            : null;

        return view('livewire.popups.relay-point', $data);
    }
}
