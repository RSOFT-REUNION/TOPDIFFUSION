<?php

namespace App\Livewire\Frontend\Pages\Profile;

use App\Models\UserAddress;
use Livewire\Component;

class EditProfile extends Component
{
    public $lastname, $firstname, $email, $phone;

    public function mount()
    {
        $this->lastname = auth()->user()->lastname;
        $this->firstname = auth()->user()->firstname;
        $this->email = auth()->user()->email;
        $this->phone = auth()->user()->phone;
    }

    public function editProfile()
    {
        $this->validate([
            'lastname' => 'required|string',
            'firstname' => 'required|string',
            'phone' => 'required|string',
        ]);
        if($this->email != auth()->user()->email){
            $this->validate([
                'email' => 'required|email|unique:users,email',
            ]);
        }

        $user = auth()->user();
        $user->lastname = $this->lastname;
        $user->firstname = $this->firstname;
        if($this->email != auth()->user()->email){
            $user->email = $this->email;
        }
        $user->phone = $this->phone;
        $user->update();

        return to_route('fo.profile.edit')->with('success', 'Votre profil a été modifié avec succès.');
    }

    public function deleteAddress($id)
    {
        $address = UserAddress::find($id);
        $address->delete();
        return to_route('fo.profile.edit')->with('success', 'L\'adresse a bien été supprimée');
    }

    public function render()
    {
        $data = [];
        $data['userAddresses'] = UserAddress::where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.pages.profile.edit-profile', $data);
    }
}
