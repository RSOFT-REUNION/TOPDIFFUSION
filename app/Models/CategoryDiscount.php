<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryDiscount extends Model
{
    use HasFactory;

    public function getGroupName()
    {
        return UserGroup::where('id', $this->user_group_id)->first()->name;
    }
}
