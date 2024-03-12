<?php

namespace App\Http\Livewire\Components\Sav;

use App\Models\MessagesGroups;
use Livewire\Component;

class BtnCloture extends Component
{
    public $ticket, $label, $icon, $wire, $class;

    protected $listeners = ['refreshComponent' => 'render'];

    public function mount($label, $icon, $wire, $class)
    {
        $this->label = $label;
        $this->icon = $icon;
        $this->wire = $wire;
        $this->class = $class;
    }

    public function reOpen()
    {
        $reopen = MessagesGroups::find($this->ticket->id);
        $reopen->closed = false;
        $reopen->state = 2;
        if ($reopen->save()) {
            session()->flash('success', 'Ticket Réouvert');
            return redirect()->route('back.sav');
        } else {
            session()->flash('error', 'Erreur. Veuillez réessayer');
            return redirect()->route('back.sav');
        };
    }

    public function reOpenAdmin()
    {
        $reopen = MessagesGroups::find($this->ticket->id);
        $reopen->closed = false;
        $reopen->state = 2;
        if ($reopen->save()) {
            session()->flash('success', 'Ticket Réouvert');
            return redirect()->route('back.sav');
        } else {
            session()->flash('error', 'Erreur. Veuillez réessayer');
            return redirect()->route('back.sav');
        };
    }

    public function cloture()
    {
        $cloture = MessagesGroups::find($this->ticket->id);
        $cloture->closed = true;
        $cloture->state = 4;
        if ($cloture->save()) {
            session()->flash('success', 'Ticket Clôturé');
            return redirect()->route('back.sav');
        } else {
            session()->flash('error', 'Erreur. Veuillez réessayer');
            return redirect()->route('back.sav');
        };
    }

    public function clotureAdmin()
    {
        $cloture = MessagesGroups::find($this->ticket->id);
        $cloture->closed = true;
        $cloture->state = 4;
        if ($cloture->save()) {
            session()->flash('success', 'Ticket Clôturé');
            return redirect()->route('back.sav');
        } else {
            session()->flash('error', 'Erreur. Veuillez réessayer');
            return redirect()->route('back.sav');
        };
    }

    public function inProgress()
    {
        $in_progress = MessagesGroups::find($this->ticket->id);
        $in_progress->state = 2;
        if ($in_progress->save()) {
            session()->flash('success', 'Ticket mis en progression');
            return redirect()->route('back.sav');
        } else {
            session()->flash('error', 'Erreur. Veuillez réessayer');
            return redirect()->route('back.sav');
        };
    }

    public function inProgressAdmin()
    {
        $in_progress = MessagesGroups::find($this->ticket->id);
        $in_progress->state = 2;
        if ($in_progress->save()) {
            session()->flash('success', 'Ticket mis en progression');
            return redirect()->route('back.sav');
        } else {
            session()->flash('error', 'Erreur. Veuillez réessayer');
            return redirect()->route('back.sav');
        };
    }


    public function render()
    {
        return view('livewire.components.sav.btn-cloture');
    }
}
