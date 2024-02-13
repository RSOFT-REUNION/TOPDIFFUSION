<?php

namespace App\Http\Livewire\Components\Back\Users;

use App\Models\GroupUser;
use Livewire\Component;

class GroupUserInProfile extends Component
{
    public $group, $user;
    public $newGroup;

    public function mount($group, $user)
    {
        $this->group = $group;
        $this->user = $user;
    }

    public function updateGroupUser()
    {
        // Définition des variables
        $user = $this->user;

        // Mise à jour du groupe de l'utilisateur
        $user->group_user = $this->newGroup;
        if($user->update())
        {
            return redirect()->route('back.user.single', ['user' => $user->customer_code])->with('success', 'Le profil du client a bien été mis à jour');
        }
    }

    public function render()
    {
        $data = [];
        $data['allGroups'] = GroupUser::all();
        return view('livewire.components.back.users.group-user-in-profile', $data);
    }
}
