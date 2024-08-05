<?php

namespace App\Livewire\Frontend\Popups\Users;

use LivewireUI\Modal\ModalComponent;

class ForgotPassword extends ModalComponent
{
    public function render()
    {
        return view('livewire.frontend.popups.users.forgot-password');
    }
}
