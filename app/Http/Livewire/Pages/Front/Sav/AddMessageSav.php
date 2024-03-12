<?php

namespace App\Http\Livewire\Pages\Front\Sav;

use App\Models\Messages;
use Livewire\Component;

class AddMessageSav extends Component
{

    public $user, $command, $message;
    public $userId;


    protected $rules = [
        'message' => 'required|min:1',
    ];

    protected $messages = [
        'message.required' => 'Ce champs est obligatoire.',
        'message.min' => 'Ce champs doit comporter au moins :min caractères.',
    ];

    public function mount($user, $command)
    {
        $this->user = $user;
        $this->command = $command;
    }


    public function openModal($userId)
    {
        $this->userId = $userId;
        $this->emit('openModal', 'pages.front.sav.add-message-sav');
    }


    public function updated($message)
    {
        $this->validateOnly($message);
    }

    public function createSavMessage()
    {
        $this->validate();

        $mess = new Messages;
        $mess->ticket_id = $this->ticket;
        $mess->user_id = auth()->user()->id;
        $mess->message = $this->message;
        $mess->state = '1';
        $mess->closed = 0;

        if ($mess->save()) {
            return session()->flash('success', 'Demande de SAV envoyée.');
        } else {
            return session()->flash('error', 'Soucis lors de l\'envoi. Veuillez réessayer');
        }
    }

    public function render()
    {
        return view('livewire.pages.front.sav.add-message-sav');
    }
}
