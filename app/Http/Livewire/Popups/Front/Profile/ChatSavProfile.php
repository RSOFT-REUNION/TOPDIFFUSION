<?php

namespace App\Http\Livewire\Popups\Front\Profile;

use App\Models\UserOrder;
use LivewireUI\Modal\ModalComponent;

class ChatSavProfile extends ModalComponent
{
    public static function modalMaxWidth(): string
    {
        return '7xl';
    }

    public $order, $command, $messageGroup;

    public function btn()
    {
        dd($this->messageGroup);
    }

    public function render()
    {
        return view('livewire.popups.front.profile.chat-sav-profile');
    }
}
