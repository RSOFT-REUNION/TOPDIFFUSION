<?php

namespace App\Livewire\Frontend\Popups\Profile;

use App\Models\UserAddress;
use Livewire\Attributes\Rule;
use LivewireUI\Modal\ModalComponent;

class AddAddress extends ModalComponent
{
    public $address, $city, $zip_code, $address_bis;
    public $is_default = false;

    #[Rule([
        'address' => 'required|string',
        'city' => 'required|string',
        'zip_code' => 'required|string',
        'address_bis' => 'nullable|string',
    ], message: [
        'address.required' => 'L\'adresse est obligatoire',
        'city.required' => 'La ville est obligatoire',
        'zip_code.required' => 'Le code postal est obligatoire',
    ])]

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        // TODO: Ajouter une vérification du défaut (pour ne pas avoir plusieurs adresses par défaut)

        $this->validate();

        $address = new UserAddress;
        $address->user_id = auth()->id();
        $address->address = $this->address;
        $address->address_bis = $this->address_bis;
        $address->zip_code = $this->zip_code;
        $address->city = $this->city;
        $address->is_default = $this->is_default;
        $address->save();

        return to_route('fo.profile.edit')->with('success', 'L\'adresse a bien été ajoutée');
    }

    public function render()
    {
        return view('livewire.frontend.popups.profile.add-address');
    }
}
