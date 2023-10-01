<?php

namespace App\Http\Livewire\Pages\Back\Sav;

use App\Models\Messages;
use App\Models\MessagesGroups;
use App\Models\User;
use App\Notifications\NewMessage;
use Livewire\Component;

class Sav extends Component
{

    public $ticketInProgress, $history, $ticket_user, $user, $messages, $tick, $message_input;
    public $ticketClients;

    protected $listeners = ['newMessageReceived' => 'getMessage'];

    public $state = TRUE;
    public $state2 = FALSE;
    public $test;

    public function mount()
    {
        // Récupérez tous les tickets en cours (state 1, 2, ou 3) avec les informations de l'auteur
        $this->ticketInProgress = MessagesGroups::whereIn('state', [1, 2, 3])
            ->with('user') // Chargez les informations de l'auteur
            ->orderBy('created_at', 'desc')
            ->get();

        // Récupérez tous les codes clients des tickets en cours
        $this->ticketClients = $this->ticketInProgress->pluck('user.code_client');

        // Récupérez l'historique de tous les tickets (state 4) avec les informations de l'auteur
        $this->history = MessagesGroups::where('state', 4)
            ->with('user') // Chargez les informations de l'auteur
            ->get();
    }


    public function toggleState($stateName)
    {
        $this->$stateName = !$this->$stateName;
    }

    public function stateMenu($id)
    {
        if ($this->tick->id == $id) {
            if ($this->test == $this->tick->id) {
                $this->test = FALSE;
            } else {
                $this->test = $this->tick->id;
            }
        }
    }

    public function getCreatedAt()
    {
        return date('d/m/Y', strtotime($this->created_at));
    }

    public function messageInput()
    {
        $message = new Messages;
        $message->ticket_id = $this->tick->id;
        $message->user_id = auth()->user()->id;
        $message->message = $this->message_input;
        $message->state = '1';
        $message->closed = 0;
        $messageGroup = MessagesGroups::where('id', $message->ticket_id)->first();

        if ($message->save()) {
            if (auth()->user()->team) {
                $recipientUserId = $messageGroup->created_by;
                 $recipientUser = User::find($recipientUserId);
                 if ($recipientUser) {
                     $recipientUser->notify(new NewMessage($message));
                 }
                $this->getMessage($this->tick->id);
                $this->message_input = '';
                $this->emit('newMessageReceived', $this->tick->id);
            }
        };
    }

    public function getMessage($id)
    {
        $this->messages =  Messages::where('ticket_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();
        $this->tick = MessagesGroups::find($id);
        $this->test = false;
    }

    public function render()
    {
        return view('livewire.pages.back.sav.sav');
    }
}
