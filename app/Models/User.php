<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getCreatedAt()
    {
        return date('d/m/y', strtotime($this->created_at));
    }

    public function getVerifiedAt()
    {
        return date('d/m/y', strtotime($this->verified_at));
    }

    public function getCustomerTypeText()
    {
        if ($this->professionnal) {
            return 'Professionnel';
        } else {
            return 'Particulier';
        }
    }

    public function getCustomerType()
    {
        if ($this->professionnal) {
            return '<span class="px-2 py-1 bg-amber-100 text-amber-500 rounded-lg">Professionnel</span>';
        } else {
            return '<span class="px-2 py-1 bg-gray-100 rounded-lg">Particulier</span>';
        }
    }

    public function customerGroups()
    {
        return $this->belongsToMany(CustomerGroup::class, 'customer_group_user', 'user_id', 'customer_group_id');
    }
}
