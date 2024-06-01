<?php

namespace App\Livewire\Backend\Popups\Users;

use App\Models\User;
use App\Models\UserGroup;
use LivewireUI\Modal\ModalComponent;

class ShowUser extends ModalComponent
{
    public $user;
    public $group;
    public $groups;

    public function mount($user_id)
    {
        $this->user = User::find($user_id);
        $this->groups = UserGroup::all();
    }

    public function editGroup() {

        $user = User::where('id', $this->user->id)->first();
        $user->group_id = $this->group;
        $user->update();

        return to_route('bo.customers')->with('success', 'Le groupe de l\'utilisateur a été modifié avec succès !');
    }

    public function render()
    {
        return view('livewire.backend.popups.users.show-user');
    }
}
