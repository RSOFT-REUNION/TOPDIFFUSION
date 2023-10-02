<?php

namespace App\Http\Livewire\Front;

use App\Models\ActivityLog;
use App\Models\CustomerGroup;
use App\Models\User;
use App\Models\UserData;
use App\Models\UserSetting;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;

class RegisterInputs extends Component
{
    public $lastname, $firstname, $email, $phone, $password, $company_name, $company_com, $company_rcs, $company_tva;
    public $professionnal = false;
    public $conditions = false;

    protected $rules = [
        'lastname' => 'required|string',
        'firstname' => 'required|string',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:5|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{5,}$/i',
        'company_name' => 'required_if:professionnal,true|nullable|string',
        'company_com' => 'nullable|string',
        'company_rcs' => 'required_if:professionnal,true|nullable|string',
        'company_tva' => 'required_if:professionnal,true|nullable|min:11',
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
        'company_name.required_if' => "Le nom de la société est obligatoire quand vous êtes un professionnel.",
        'company_name.string' => "Le nom de la société n'est pas conforme.",
        'company_rcs.required_if' => "Le numéro RCS est obligatoire quand vous êtes un professionnel.",
        'company_rcs.string' => "Le numéro RCS n'est pas conforme.",
        'company_tva.required_if' => "Le numéro de TVA est obligatoire quand vous êtes un professionnel.",
        'company_tva.min' => "Le numéro de TVA n'est pas conforme.",
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
        if($this->professionnal) {
            $user->professionnal = 1;
            $user->verified = 0;
        } else {
            $user->professionnal = 0;
            $user->verified_at = Carbon::now();
        }
        if($user->save()) {

            // Create users data
            $data = new UserData;
            $data->user_id = $user->id;
            if($this->professionnal) {
                $data->company_name = $this->company_name;
                $data->company_com_name = $this->company_com;
                $data->company_rcs = $this->company_rcs;
                $data->company_tva = $this->company_tva;
            }
            if($data->save()) {
                // Create users settings
                $settings = new UserSetting;
                $settings->user_id = $user->id;
                if($settings->save()) {
                    // Enregistrez l'activité de création d'un nouveau compte
                    ActivityLog::logActivity($user->id, 'Inscription', $user->firstname . " " . $user->lastname . ' vient de s\'inscrire');
                    // Send email to support & customer
                    return redirect()->route('front.login');
                }
            }

        }
    }

    public function render()
    {
        $data = [];
        $data['pro'] = $this->professionnal;
        $data['cond'] = $this->conditions;
        return view('livewire.front.register-inputs', $data);
    }
}
