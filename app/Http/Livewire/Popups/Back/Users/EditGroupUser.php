<?php

namespace App\Http\Livewire\Popups\Back\Users;

use App\Models\GroupUser;
use App\Models\User;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class EditGroupUser extends ModalComponent
{
    public $group;
    public $description, $discount;

    public function mount($group_id)
    {
        $this->group = GroupUser::where('id', $group_id)->first();
        $this->description = $this->group->description;
        $this->discount = $this->group->discount;
    }

    public function render()
    {
        $data = [];
        $data['users'] = User::where('group_user', $this->group->id)->get();
        return view('livewire.popups.back.users.edit-group-user', $data);
    }
}
