<?php

namespace App\Http\Livewire\Pages\Back\Users;

use App\Models\CustomerGroup;
use App\Models\User;
use Livewire\Component;

class GroupeUser extends Component
{

    public $name, $discount_percentage, $isDefault;
    public $selectedUsers = [];

    public function createGroupUser()
    {
        // Créez d'abord le groupe de clients
        $groupUser = new CustomerGroup();
        $groupUser->name = $this->name;
        $groupUser->discount_percentage = $this->discount_percentage;
        if ($this->isDefault) {
            $groupUser->is_default = 1;
        } else {
            $groupUser->is_default = 0;
        }

        if ($groupUser->save()) {
            // Une fois que le groupe est créé, attribuez les utilisateurs sélectionnés
            $groupUser->users()->sync($this->selectedUsers);
            foreach ($this->selectedUsers as $userId) {
                $user = User::find($userId);
                if ($user) {
                    $user->customer_group_id = $groupUser->id;
                    $user->save();
                }
            }

            // Redirigez l'utilisateur vers la liste des groupes ou effectuez une autre action nécessaire
            return redirect()->route('back.user.userGroup')->with('success', 'Le groupe a été créé avec succès.');
        } else {
            return back()->with('error', 'Une erreur est survenue lors de la création du groupe.');
        }
    }

    public function render()
    {
        $data = [];
        $data['usersList'] = User::where('team', '0')->get();
        return view('livewire.pages.back.users.group-users', $data);
    }
}
