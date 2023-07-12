<?php

namespace App\Http\Livewire\Pages\Back\Users;

use App\Models\User;
use Livewire\Component;

class UsersList extends Component
{
    public function render()
    {
        $data = [];
        $data['users'] = User::where('team', 0)->orderBy('id', 'desc')->get();
        return view('livewire.pages.back.users.users-list', $data);
    }
}
