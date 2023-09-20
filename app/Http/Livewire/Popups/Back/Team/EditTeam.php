<?php

namespace App\Http\Livewire\Popups\Back\Team;

use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class EditTeam extends ModalComponent
{
    public $users;
    public $user;
    public $lastname, $firstname, $email, $phone;

    public function mount()
    {
        $this->users = User::where('id', $this->user)->first();
        $this->lastname = $this->users->lastname;
        $this->firstname = $this->users->firstname;
        $this->email = $this->users->email;
        $this->phone = $this->users->phone;
    }

    public function edit()
    {
        $us = $this->users;
        $us->lastname = strtoupper($this->lastname);
        $us->firstname = $this->firstname;
        $us->email = $this->email;
        $us->phone = $this->phone;
        if($us->update()) {
            return redirect()->route('back.team');
        }
    }


    public function render()
    {
        $data = [];
        $data['user'] = $this->user;
        return view('livewire.popups.back.team.edit-team', $data);
    }
}
