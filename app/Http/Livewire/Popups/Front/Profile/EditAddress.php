<?php

namespace App\Http\Livewire\Popups\Front\Profile;

use App\Models\UserAddress;
use LivewireUI\Modal\ModalComponent;

class EditAddress extends ModalComponent
{
    public $address;
    public $title, $add, $address_bis, $postal, $city, $country, $main;

    public function mount($address_id)
    {
        $this->address = UserAddress::where('id', $address_id)->first();
        $this->title = $this->address->title;
        $this->add = $this->address->address;
        $this->address_bis = $this->address->address_bis;
        $this->postal = $this->address->postal_code;
        $this->city = $this->address->city;
        $this->country = $this->address->country;
        $this->main = $this->address->default;
    }

    public function edit()
    {
        $myAddress = $this->address;
        $myAddress->title = $this->title;
        $myAddress->address = strtoupper($this->add);
        $myAddress->address_bis = strtoupper($this->address_bis);
        $myAddress->city = strtoupper($this->city);
        $myAddress->country = strtoupper($this->country);
        $myAddress->postal_code = $this->postal;
        if($this->main) {
            $myAddress->default = 1;
        } else {
            $myAddress->default = 0;
        }
        if($myAddress->update())
        {
            return redirect()->route('front.profile');
        }
    }

    public function render()
    {
        return view('livewire.popups.front.profile.edit-address');
    }
}
