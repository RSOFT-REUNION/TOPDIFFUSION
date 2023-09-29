<?php

namespace App\Http\Livewire\Pages\Front\Sav;

use App\Models\MessagesGroups;
use Illuminate\Support\Str;
use LivewireUI\Modal\ModalComponent;

class OpenTicketSav extends ModalComponent
{

    public $suject, $ticketSav, $message, $description, $num_command, $my_suject;
    public $user, $command;

    protected $rules = [
        'message' => 'required|min:1',
    ];
    protected $messages = [
        'message.required' => 'Ce champs est obligatoire.',
        'message.min' => 'Ce champs doit comporter au moins :min caractères.',
    ];

    public function updated($message)
    {
        $this->validateOnly($message);
    }

    public function mount($user, $command)
    {
        $this->user = $user;
        $this->command = $command;
    }

    public function create()
    {
        $savNumber = Str::random(5);

        $ticket = new MessagesGroups;
        $ticket->sav_number = 'SAV_' . $savNumber;
        $ticket->subject = $this->suject;
        $ticket->user_id = auth()->user()->id;
        $ticket->created_by = auth()->user()->id;
        $ticket->command_number = $this->command;
        $ticket->subject_other = $this->my_suject;
        $ticket->message = $this->message;
        $ticket->closed = 0;
        if ($ticket->save()) {
            // FIXME : Les Sessions flash ne fonctionnent pas sur les pages LIVEWIRE
            return back()->with('message', 'Demande envoyé au SAV.');

        } else {
            return back()->with('error', 'Soucis lors de l\'envoie.');
        }
    }
    public function render()
    {

        $this->user;
        $this->command;
        return view('livewire.pages.front.sav.open-ticket-sav');
    }
}
