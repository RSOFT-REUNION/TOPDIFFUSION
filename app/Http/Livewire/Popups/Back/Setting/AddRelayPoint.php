<?php

namespace App\Http\Livewire\Popups\Back\Setting;

use App\Models\RelaisPoint;
use App\Models\SettingGeneral;
use LivewireUI\Modal\ModalComponent;

class AddRelayPoint extends ModalComponent
{
    public $setting;
    public $shipping_price, $shipping_limit;

    // Varaible pour le point relais
    public $nameRelayPoint;
    public $adressRelayPoint;
    public $openingHours = "Lundi : 09h00 - 10h00\nMardi : 09h00 - 17h00\nMercredi : 09h00 - 17h00\nJeudi : 09h00 - 17h00\nVendredi : 09h00 - 17h00\nSamedi : 09h00 - 12h00";
    public $availableRelayPoint;
    public $conctactPhone;
    public $conctactEmail;

    protected $listeners = ['refreshLines' => '$refresh'];

    public function mount()
    {
        $this->setting = SettingGeneral::where('id', 1)->first();
        $this->shipping_price = SettingGeneral::where('id', 1)->first()->shipping_price;
        $this->shipping_limit = SettingGeneral::where('id', 1)->first()->shipping_limit;
    }

    // Permet de mettre à jour le prix de livraison
    public function updateShippingPrice()
    {
        $setting = $this->setting;
        $setting->shipping_price = $this->shipping_price;
        if ($setting->update()) {
            $this->emit('refreshLines');
        }
    }

    // Permet de mettre à jour le montant total pour que la livraison soit gratuite
    public function updateShippingLimit()
    {
        $setting = $this->setting;
        $setting->shipping_limit = $this->shipping_limit;
        if ($setting->update()) {
            $this->emit('refreshLines');
        }
    }

    // Permet d'ajouter un point relais
    public function addRelayPoint()
    {
        $newRelayPoint = new RelaisPoint;

        // Définir les propriétés avec les valeurs des champs du formulaire
        $newRelayPoint->name = $this->nameRelayPoint;
        $newRelayPoint->address = $this->adressRelayPoint;
        $newRelayPoint->opening_hours = $this->openingHours;
        $newRelayPoint->available = $this->availableRelayPoint || 0;
        $newRelayPoint->contact_phone = $this->conctactPhone;
        $newRelayPoint->contact_email = $this->conctactEmail;

        // Sauvegarder le nouveau point relais dans la base de données
        if ($newRelayPoint->save()) {
            // Réinitialiser uniquement les champs concernant l'ajout d'un point relais
            $this->reset(['nameRelayPoint', 'adressRelayPoint', 'openingHours', 'availableRelayPoint', 'conctactPhone', 'conctactEmail']);
            // Envoyer un message de confirmation dans la session
            session()->flash('message', 'Le point relais a été ajouté avec succès.');
        };
    }

    public function render()
    {
        $data = [];
        $data['relays_points'] = RelaisPoint::all();
        $data['setting'] = $this->setting;
        return view('livewire.popups.back.setting.add-relay-point', $data);
    }
}
