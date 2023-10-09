<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerGroupUser extends Model
{
    protected $table = 'customer_group_user';

    protected $fillable = ['user_id', 'customer_group_id'];
}
