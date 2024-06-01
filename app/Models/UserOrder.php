<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    use HasFactory;

    // Avoir le nombre de produits dans la commande
    public function getProductCount()
    {
        return UserOrderItem::where('user_order_id', $this->id)->sum('quantity');
    }

    // Récupérer le nom et prénom de l'utilisateur
    public function getUserName()
    {
        $user = User::where('id', $this->user_id)->first();
        return $user->lastname . ' ' . $user->firstname;
    }

    // Récupérer l'id de l'utilisateur
    public function getUserId()
    {
        return User::where('id', $this->user_id)->first()->id;
    }

    // Récupérer les informations de l'utilisateur
    public function getUser()
    {
        return User::where('id', $this->user_id)->first();
    }

    // Récupérer la liste des méthodes de paiement
    public function getPaymentMethod()
    {
        $data = [
            'card' => 'Carte bancaire',
            'virement' => 'Virement à la livraison',
            'later' => 'Payer à la livraison'
        ];

        return isset($data[$this->payment_method]) ? $data[$this->payment_method] : 'Non défini';
    }

    // Récupérer la liste des méthodes de paiement
    public function getState()
    {
        $data = [
            '0' => '<span class="text-sm bg-amber-100 border border-amber-200 text-amber-500 py-1 px-2 rounded-full">A payer</span>',
            '1' => '<span class="text-sm bg-green-100 border border-green-200 text-green-500 py-1 px-2 rounded-full">Payée</span>',
            '2' => '<span class="text-sm bg-green-100 border border-green-200 text-green-500 py-1 px-2 rounded-full">Payée</span>',
            '3' => '<span class="text-sm bg-purple-100 border border-purple-200 text-purple-500 py-1 px-2 rounded-full">Livrée</span>',
            '4' => '<span class="text-sm bg-slate-100 border border-slate-200 text-slate-500 py-1 px-2 rounded-full">Terminé</span>',
        ];

        return isset($data[$this->state]) ? $data[$this->state] : 'Non défini';
    }

    // Récupérer la liste des méthodes de paiement
    public function getStateText()
    {
        $data = [
            '0' => '<span class="text-amber-500">A payer</span>',
            '1' => '<span class="text-green-500">Payée</span>',
            '1' => '<span class="text-green-500">Non payée</span>',
            '3' => '<span class="text-purple-500">Livrée</span>',
            '4' => '<span class="text-slate-500">Terminé</span>',
        ];

        return isset($data[$this->state]) ? $data[$this->state] : 'Non défini';
    }
}
