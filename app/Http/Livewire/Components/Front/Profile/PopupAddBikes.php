<?php

namespace App\Http\Livewire\Components\Front\Profile;

use App\Models\bike;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class PopupAddBikes extends ModalComponent
{
    public $user;

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function render()
    {
        $data = [];
        $data['bikes'] = bike::orderBy('marque', 'asc')->get();
        return view('livewire.components.front.profile.popup-add-bikes', $data);
    }
}
