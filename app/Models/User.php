<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'lastname',
        'firstname',
        'email',
        'password',
        'phone',
        'group_id',
        'code',
        'admin',
        'type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Avoir les informations sur le groupe
    public function group()
    {
        return UserGroup::where('id', $this->group_id)->first();
    }

    // Avoir les informations sur l'entreprise de l'utilisateur
    public function company()
    {
        return UserCompany::where('user_id', $this->id)->first();
    }

    // Récuperer les réglages lié à l'utilisateur
    public function settings()
    {
        return UserSetting::where('user_id', $this->id)->first();
    }
}
