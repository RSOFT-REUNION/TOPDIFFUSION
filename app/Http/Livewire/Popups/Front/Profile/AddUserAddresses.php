<?php

namespace App\Http\Livewire\Popups\Front\Profile;

use App\Models\UserAddress;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class AddUserAddresses extends ModalComponent
{
    public $user_id;
    public $title, $address, $address_bis, $city, $postal, $country, $main;

    protected $rules = [
        'title' => 'required|string',
        'address' => 'required|string',
        'address_bis' => 'nullable|string',
        'city' => 'required|string',
        'postal' => 'required|digits:5',
        'country' => 'required|string'
    ];

    protected $messages = [
        'title.required' => "Le nom est obligatoire.",
        'title.string' => "Le nom est n'est pas conforme.",
        'address.required' => "L'adresse est obligatoire.",
        'address.string' => "L'adresse n'est pas conforme.",
        'address_bis.string' => "L'adresse (complément) n'est pas conforme.",
        'city.required' => "La ville est obligatoire.",
        'city.string' => "La ville n'est pas conforme.",
        'postal.required' => "Le code postal est obligatoire.",
        'postal.digits' => "Le code postal n'est pas conforme.",
        'country.required' => "Le pays est obligatoire.",
        'country.string' => "Le pays n'est pas conforme.",
    ];

    public function mount($user_id)
    {
        $this->user_id = $user_id;
    }

    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function create()
    {
        $user = auth()->user();
        $this->validate();

        $address = new UserAddress;
        $address->user_id = $user->id;
        $address->title = $this->title;
        $address->address = strtoupper($this->address);
        $address->address_bis = strtoupper($this->address_bis);
        $address->city = strtoupper($this->city);
        $address->country = strtoupper($this->country);
        $address->postal_code = $this->postal;
        if($this->main) {
            $address->default = 1;
        } else {
            $address->default = 0;
        }
        if($address->save())
        {
            return redirect()->route('front.profile');
        }

    }

    public function render()
    {
        return view('livewire.popups.front.profile.add-user-addresses');
    }
}
