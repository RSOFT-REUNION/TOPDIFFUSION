<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    use HasFactory;

    // Spécifiez la table associée à ce modèle
    protected $table = 'user_groups';
    protected $fillable = [
        'key',
        'name',
        'description',
        'discount'
    ];
}
