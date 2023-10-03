<?php

namespace App\Http\Livewire\Popups\Front\Profile;

use App\Models\UserOrder;
use LivewireUI\Modal\ModalComponent;
use App\Models\MessagesGroups;

class ChatSavProfile extends ModalComponent
{
    public static function modalMaxWidth(): string
    {
        return '7xl';
    }

    public $order, $command, $messageGroup;
    public $newOrder;

    public function mount()
    {
        $this->newOrder = MessagesGroups::where('id', $this->order['id'])->first();
    }

    public function btn()
    {
        dd($this->test);
    }

    public function render()
    {
        return view('livewire.popups.front.profile.chat-sav-profile');
    }
}
