<?php

namespace App\Http\Livewire\Popups\Back\Team;

use App\Models\User;
use App\Models\UserData;
use App\Models\UserSetting;
use Carbon\Carbon;
use Illuminate\Support\Str;
use LivewireUI\Modal\ModalComponent;

class AddTeam extends ModalComponent
{

    public $lastname, $firstname, $email, $phone, $password;

    protected $rules = [
        'lastname' => 'required|string',
        'firstname' => 'required|string',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:5|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{5,}$/i',
    ];

    protected $messages = [
        'firstname.required' => "Le prénom est obligatoire.",
        'firstname.string' => "Il ne s'agit pas d'un prénom.",
        'lastname.required' => "Le nom de famille est obligatoire.",
        'lastname.string' => "Il ne s'agit pas d'un nom de famille.",
        'email.required' => "L'adresse e-mail est obligatoire.",
        'email.email' => "Il ne s'agit pas d'une adresse e-mail.",
        'email.unique' => "Cette adresse e-mail est déjà utilisé.",
        'password.required' => "Le mot de passe est obligatoire.",
        'password.min' => "Le mot de passe doit comporter au moins :min caractères.",
        'password.regex' => "Le mot de passe doit comporter au moins une majuscule, une minuscule et un chiffre.",
    ];

    public function updated($firstname)
    {
        $this->validateOnly($firstname);
    }

    public function create()
    {
        $this->validate();

        $code = Str::random(5);
        $customer_code = strtoupper($this->lastname).'-'. strtoupper($code);

        $user = new User;
        $user->lastname = strtoupper($this->lastname);
        $user->firstname = $this->firstname;
        $user->email = $this->email;
        $user->password = bcrypt($this->password);
        $user->phone = $this->phone;
        $user->customer_code = $customer_code;
        $user->team = 1;
        if($user->save()) {
            return redirect()->route('back.team');
        }
    }

    public function render()
    {
        return view('livewire.popups.back.team.add-team');
    }
}
