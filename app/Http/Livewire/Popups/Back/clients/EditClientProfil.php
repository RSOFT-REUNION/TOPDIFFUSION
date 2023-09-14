<?php

namespace App\Http\Livewire\Popups\Back\clients;

use App\Models\User;
use App\Models\UserData;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class EditClientProfil extends ModalComponent
{
    public $user;
    public $user_id;
    public $userData;
    public $lastname, $firstname, $email, $phone, $company_com_name;

    public function mount($user_id)
    {
        // dd($user_id);
        $this->user_id = $user_id;
        $this->user = User::where('id', $user_id)->first();
        $this->userData = UserData::where('user_id', $user_id)->first();
        $this->lastname = $this->user->lastname;
        $this->firstname = $this->user->firstname;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone;
        $this->company_com_name = $this->userData->company_com_name;
    }

    public function edit()
    {
        $us = $this->user;
        $us->lastname = strtoupper($this->lastname);
        $us->firstname = $this->firstname;
        $us->email = $this->email;
        $us->phone = $this->phone;
        if ($us->update()) {
            $usd = $this->userData;
            $usd->company_com_name = $this->company_com_name;
            $usd->update();

            return redirect()->route('back.user.list');
        }
    }


    public function render()
    {
        $data = [];
        $data['user'] = $this->user;
        $data['userData'] = $this->userData;
        return view('livewire.popups.back.clients.edit-client-profil', $data);
    }
}
