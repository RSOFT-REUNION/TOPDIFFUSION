<?php

namespace App\Livewire\Backend\Popups\Settings;

use App\Models\ShippingPoint;
use Livewire\Attributes\Rule;
use LivewireUI\Modal\ModalComponent;

class AddShippingPoint extends ModalComponent
{
    public $name, $address, $address_bis, $city, $zip_code, $phone;

    #[Rule([
        'name' => 'required|string',
        'address' => 'required|string',
        'address_bis' => 'nullable|string',
        'city' => 'required|string',
        'zip_code' => 'required|string',
        'phone' => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/i|size:10'
    ], message: [
        'name.required' => 'Le nom est obligatoire',
        'name.string' => 'Le nom doit être une chaîne de caractères',
        'address.required' => 'L\'adresse est obligatoire',
        'address.string' => 'L\'adresse doit être une chaîne de caractères',
        'address_bis.string' => 'L\'adresse bis doit être une chaîne de caractères',
        'city.required' => 'La ville est obligatoire',
        'city.string' => 'La ville doit être une chaîne de caractères',
        'zip_code.required' => 'Le code postal est obligatoire',
        'zip_code.string' => 'Le code postal doit être une chaîne de caractères',
        'phone.required' => 'Le téléphone est obligatoire',
        'phone.string' => 'Le téléphone doit être une chaîne de caractères',
        'phone.regex' => 'Le téléphone n\'est pas valide',
        'phone.size' => 'Le téléphone doit être de 10 chiffres'
    ])]

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addShippingPoint()
    {
        $this->validate();

        $shippingPoint = new ShippingPoint;
        $shippingPoint->name = $this->name;
        $shippingPoint->address = $this->address;
        $shippingPoint->address_bis = $this->address_bis;
        $shippingPoint->city = $this->city;
        $shippingPoint->zip_code = $this->zip_code;
        $shippingPoint->phone = $this->phone;
        $shippingPoint->save();

        return to_route('bo.setting.shipping')->with('success', 'Le point de livraison a été ajouté avec succès');
    }

    public function render()
    {
        return view('livewire.backend.popups.settings.add-shipping-point');
    }
}
