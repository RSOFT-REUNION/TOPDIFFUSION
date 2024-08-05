<?php

namespace App\Livewire\Frontend\Popups\Profile;

use Livewire\Attributes\Rule;
use LivewireUI\Modal\ModalComponent;

class EditPassword extends ModalComponent
{
    public $password, $password_confirmation;

    #[Rule([
        'password' => 'required|min:8|confirmed|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[^a-zA-Z0-9]/',
        'password_confirmation' => 'required',

    ], message: [
        'password.required' => 'Le mot de passe est obligatoire',
        'password.min' => 'Le mot de passe doit contenir au moins 8 caractères',
        'password.confirmed' => 'Les mots de passe ne correspondent pas',
        'password.regex' => 'Le mot de passe doit contenir au moins une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial',
        'password_confirmation.required' => 'La confirmation du mot de passe est obligatoire',
    ])]

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->validate();

        $user = auth()->user();
        $user->password = bcrypt($this->password);
        $user->update();

        return to_route('fo.profile.edit')->with('success', 'Votre mot de passe a été modifié avec succès.');
    }

    public function render()
    {
        return view('livewire.frontend.popups.profile.edit-password');
    }
}
