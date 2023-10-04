<?php

namespace App\Http\Livewire\Popups\Front\Profile;

use App\Models\Messages;
use App\Models\UserOrder;
use LivewireUI\Modal\ModalComponent;
use App\Models\MessagesGroups;

class ChatSavProfile extends ModalComponent
{
    public static function modalMaxWidth(): string
    {
        return '7xl';
    }

    public $order, $command, $messageGroup,$message_input;
    public $newOrder;

    public function mount()
    {
        $this->newOrder = MessagesGroups::where('id', $this->order['id'])->first();
        $this->emit('messageSent');
    }

    public function btn()
    {
        dd($this->messageGroup['id']);
    }

    public function messageInput()
    {
        $message = new Messages;
        $message->ticket_id = $this->messageGroup['id'];
        $message->user_id = auth()->user()->id;
        $message->message = $this->message_input;
        $message->state = '1';
        $message->closed = 0;
        if ($message->save()) {
            $this->message_input = '';
            $this->emit('messageSent');
        }
        // $messageGroup = MessagesGroups::where('id', $message->ticket_id)->first();

        // if ($message->save()) {
        //     if (auth()->user()->team) {
        //         $recipientUserId = $messageGroup->created_by;
        //          $recipientUser = User::find($recipientUserId);
        //          if ($recipientUser) {
        //              $recipientUser->notify(new NewMessage($message));
        //          }
        //         $this->getMessage($this->tick->id);
        //         $this->message_input = '';
        //         $this->emit('newMessage', $this->tick->id);
        //     }
        // }
    }

    public function render()
    {
        $data = [];
        $data['message'] = Messages::where('ticket_id', $this->messageGroup['id'])->orderBy('created_at', 'asc')->get();
        return view('livewire.popups.front.profile.chat-sav-profile', $data);
    }
}
