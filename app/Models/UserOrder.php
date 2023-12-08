<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    use HasFactory;

    // Récupération des informations du client
    public function User()
    {
        return User::where('id', $this->user_id)->first();
    }

    // Récupération des informations sur l'adresse de livraison
    public function Address()
    {
        return UserAddress::where('user_id', $this->user_id)->first();
    }

    // Changement de format pour la date de création
    public function getCreatedDate()
    {
        return date('d/m/Y', strtotime($this->created_at));
    }

    // Liste des status pour la gestion dans le format complet
    public function getStateBadgeGestion()
    {
        $state = [
            '',
            '<span class="bg-green-200 text-green-700 border border-green-400 rounded-md px-2 py-0.5">Payé</span>'
        ];

        return isset($state[$this->state]) ? $state[$this->state] : null;
    }

    // Liste des status pour les clients dans le format complet
    public function getStateBadgeCustomer()
    {
        $state = [
            '',
            '<span class="bg-gray-200 text-gray-700 border border-gray-400 rounded-md px-2 py-0.5">En cours de traitement</span>'
        ];

        return isset($state[$this->state]) ? $state[$this->state] : null;
    }

    public function relaisPoint()
    {
        return $this->belongsTo(RelaisPoint::class, 'relais_point_id');
    }

    public function getRelaisPoint()
    {
        return RelaisPoint::find($this->relais_point_id);
    }
}
