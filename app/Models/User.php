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

    // Avoir l'adresse complète de l'utilisateur
    public function getFullAddress()
    {
        // TODO: Ajouter l'adresse bis
        $address = UserAddress::where('user_id', $this->id)->where('is_default', true)->first();
        return $address->address . ', ' . $address->zip_code . ' - ' . $address->city;
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

    // Récupérer les informations sur la remise du client
    public function getDiscount()
    {
        return UserGroup::where('id', $this->group_id)->first()->discount;
    }

    // Récuperer les informations sur le type de client
    public function getTypeBadge()
    {
        $data = [
            '0' => '',
            '1' => '',
            '2' => '<span class="text-yellow-500">Administrateur</span>',
            '3' => '<span class="text-red-500">Support Rsoft</span>',
            '4' => '<span class="text-orange-500">Support Hivedrops</span>',
        ];

        return isset($data[$this->type]) ? $data[$this->type] : '';
    }
}
