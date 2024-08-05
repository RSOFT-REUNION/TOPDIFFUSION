<?php

namespace App\Livewire\Backend\Popups\Settings;

use App\Models\User;
use App\Models\UserSetting;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use LivewireUI\Modal\ModalComponent;

class AddTeamUser extends ModalComponent
{
    public $lastname, $firstname, $email, $password, $type;

    #[Rule([
        'lastname' => 'required|string',
        'firstname' => 'required|string',
        'email' => 'required|email',
        'password' => 'required|string|min:8',
        'type' => 'required|string'
    ], message: [
        'lastname.required' => 'Le nom est obligatoire',
        'lastname.string' => 'Le nom doit être une chaîne de caractères',
        'firstname.required' => 'Le prénom est obligatoire',
        'firstname.string' => 'Le prénom doit être une chaîne de caractères',
        'email.required' => 'L\'email est obligatoire',
        'email.email' => 'L\'email doit être une adresse email valide',
        'password.required' => 'Le mot de passe est obligatoire',
        'password.string' => 'Le mot de passe doit être une chaîne de caractères',
        'password.min' => 'Le mot de passe doit contenir au moins 8 caractères',
        'type.required' => 'Le type est obligatoire',
        'type.string' => 'Le type doit être une chaîne de caractères'
    ])]

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addTeam()
    {
        $this->validate();

        $user = new User;
        $user->lastname = $this->lastname;
        $user->firstname = $this->firstname;
        $user->email = $this->email;
        $user->password = bcrypt($this->password);
        $user->type = $this->type;
        $user->admin = 1;
        $user->code = Str::random(5);
        if($user->save())
        {
            $userSetting = new UserSetting;
            $userSetting->user_id = $user->id;
            $userSetting->save();

            return to_route('bo.setting.team')->with('success', 'Utilisateur ajouté avec succès');
        }
    }

    public function render()
    {
        return view('livewire.backend.popups.settings.add-team-user');
    }
}
