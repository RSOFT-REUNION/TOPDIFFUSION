<?php

namespace App\Http\Livewire\Pages\Back\Users;

use App\Models\GroupUser;
use Livewire\Component;

class UserGroups extends Component
{
    public function render()
    {
        $data = [];
        $data['groups'] = GroupUser::all();
        return view('livewire.pages.back.users.user-groups', $data);
    }
}
