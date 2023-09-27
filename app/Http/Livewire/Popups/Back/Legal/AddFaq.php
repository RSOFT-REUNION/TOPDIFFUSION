<?php

namespace App\Http\Livewire\Popups\Back\Legal;

use LivewireUI\Modal\ModalComponent;

class AddFaq extends ModalComponent
{
    public function render()
    {
        return view('livewire.popups.back.legal.add-faq');
    }
}
