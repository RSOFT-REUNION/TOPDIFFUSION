<?php

namespace App\Http\Livewire\Popups\Back\Clients;

use App\Models\CustomerGroup;
use LivewireUI\Modal\ModalComponent;

class AddGroupUserPopUp extends ModalComponent
{
    // Variables pour créer les groupes_users
    public $name, $discount_percentage, $isDefault;

    public function createGroupUser()
    {
        $groupUser = new CustomerGroup();
        $groupUser->name = $this->name;
        $groupUser->discount_percentage = $this->discount_percentage;
        if ($this->isDefault) {
            $groupUser->is_default = 1;
        } else {
            $groupUser->is_default = 0;
        }
        if ($groupUser->save()) {
            dd('créer');
        } else {
            dd('erreur');
        }
    }

    public function render()
    {
        return view('livewire.popups.back.clients.add-group-user-pop-up');
    }
}
