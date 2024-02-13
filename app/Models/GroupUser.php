<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    use HasFactory;

    // Avoir la liste des utilisateurs
    public function getUserList()
    {
        return User::where('group_user', $this->id)->get();
    }
}
