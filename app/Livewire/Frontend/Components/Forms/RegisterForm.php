<?php

namespace App\Livewire\Frontend\Components\Forms;

use App\Models\ActivityLog;
use App\Models\User;
use App\Models\UserCompany;
use App\Models\UserSetting;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\Component;

class RegisterForm extends Component
{
    public $lastname, $firstname, $email, $password, $password_confirmation, $phone, $company_name, $company_commercial, $company_siret, $company_rcs, $company_tva;
    public $professionnal = false;
    public $consent = false;

    #[Rule([
        'lastname' => 'required|string|min:2|max:255',
        'firstname' => 'required|string|min:2|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
        'phone' => 'nullable|string|min:10|max:10',
        'company_name' => 'nullable|string|min:2|max:255',
        'company_commercial' => 'nullable|string|min:2|max:255',
        'company_siret' => 'nullable|string|min:14|max:14',
        'company_rcs' => 'nullable|string|min:9|max:9',
        'company_tva' => 'nullable|string|min:13|max:13',
        'professionnal' => 'nullable|boolean',
        'consent' => 'required|boolean'
    ], message: [
        'lastname.required' => 'Le nom est obligatoire',
        'lastname.string' => 'Le nom doit être une chaîne de caractères',
        'lastname.min' => 'Le nom doit contenir au moins :min caractères',
        'lastname.max' => 'Le nom doit contenir au plus :max caractères',
        'firstname.required' => 'Le prénom est obligatoire',
        'firstname.string' => 'Le prénom doit être une chaîne de caractères',
        'firstname.min' => 'Le prénom doit contenir au moins :min caractères',
        'firstname.max' => 'Le prénom doit contenir au plus :max caractères',
        'email.required' => 'L\'adresse email est obligatoire',
        'email.email' => 'L\'adresse email doit être valide',
        'email.unique' => 'L\'adresse email est déjà utilisée',
        'password.required' => 'Le mot de passe est obligatoire',
        'password.string' => 'Le mot de passe doit être une chaîne de caractères',
        'password.min' => 'Le mot de passe doit contenir au moins :min caractères',
        'password.confirmed' => 'Les mots de passe ne correspondent pas',
        'password.regex' => 'Le mot de passe doit contenir au moins une lettre majuscule, une lettre minuscule et un chiffre',
        'phone.string' => 'Le numéro de téléphone doit être une chaîne de caractères',
        'phone.min' => 'Le numéro de téléphone doit contenir :min caractères',
        'phone.max' => 'Le numéro de téléphone doit contenir :max caractères',
        'company_name.string' => 'Le nom de l\'entreprise doit être une chaîne de caractères',
        'company_name.min' => 'Le nom de l\'entreprise doit contenir au moins :min caractères',
        'company_name.max' => 'Le nom de l\'entreprise doit contenir au plus :max caractères',
        'company_commercial.string' => 'Le nom commercial de l\'entreprise doit être une chaîne de caractères',
        'company_commercial.min' => 'Le nom commercial de l\'entreprise doit contenir au moins :min caractères',
        'company_commercial.max' => 'Le nom commercial de l\'entreprise doit contenir au plus :max caractères',
        'company_siret.string' => 'Le numéro SIRET de l\'entreprise doit être une chaîne de caractères',
        'company_siret.min' => 'Le numéro SIRET de l\'entreprise doit contenir :min caractères',
        'company_siret.max' => 'Le numéro SIRET de l\'entreprise doit contenir :max caractères',
        'company_rcs.string' => 'Le numéro RCS de l\'entreprise doit être une chaîne de caractères',
        'company_rcs.min' => 'Le numéro RCS de l\'entreprise doit contenir :min caractères',
        'company_rcs.max' => 'Le numéro RCS de l\'entreprise doit contenir :max caractères',
        'company_tva.string' => 'Le numéro TVA de l\'entreprise doit être une chaîne de caractères',
        'company_tva.min' => 'Le numéro TVA de l\'entreprise doit contenir :min caractères',
        'company_tva.max' => 'Le numéro TVA de l\'entreprise doit contenir :max caractères',
        'professionnal.boolean' => 'Le statut professionnel doit être un booléen',
        'consent.required' => 'Vous devez accepter les conditions d\'utilisation',
        'consent.boolean' => 'Vous devez accepter les conditions d\'utilisation'
    ])]

    public function updated($lastname)
    {
        $this->validateOnly($lastname);
    }

    public function createUser()
    {
        $this->validate();

        $customer_identifier = $this->professionnal ? 'P' : 'C'; // Défini s'il s'agit d'un professionnel ou d'un particulier
        // Génère un code client unique
        $customer_code = $customer_identifier . strtoupper(substr($this->lastname, 0, 1) . substr($this->firstname, 0, 1) . Str::random(5));

        // Met en forme le numéro de téléphone
        if($this->phone) {
            $phone_number_indicator = substr($this->phone, 0, 4);
            $phone_number_without_indicator = substr($this->phone, 4);
            $phone_number = str_split($phone_number_without_indicator, 2);
            $phone_format = $phone_number_indicator ." ". implode(" ", $phone_number);
        } else {
            $phone_format = null;
        }

        // Création de l'utilisateur
        try {
            $user = new User;
            $user->lastname = strtoupper($this->lastname);
            $user->firstname = $this->firstname;
            $user->email = $this->email;
            $user->password = bcrypt($this->password);
            if($this->phone)
                $user->phone = $phone_format;
            $user->code = $customer_code;
            $user->group_id = 1;
            if($this->professionnal) {
                $user->type = 1;
            }
            if($user->save())
            {
                // Création de l'entreprise si l'utilisateur est un professionnel
                if($this->professionnal) {
                    $company = new UserCompany;
                    $company->user_id = $user->id;
                    $company->name = $this->company_name;
                    $company->commercial_name = $this->company_commercial;
                    $company->siret = strtoupper($this->company_siret);
                    $company->rcs = $this->company_rcs;
                    $company->tva = $this->company_tva;
                    $company->save();
                }

                // Création des réglages de l'utilisateur
                $setting = new UserSetting;
                $setting->user_id = $user->id;
                $setting->save();

                // ajout des informations dans les logs
                $log = new ActivityLog;
                $log->type = 'success';
                $log->key = 'user.create';
                $log->title = 'Création d\'un compte';
                $log->description = 'Un compte a été créé avec succès par '. $this->firstname . ' ' . $this->lastname;
                $log->notified = 1;
                $log->save();

                return to_route('fo.home')->with('success', 'Votre compte a bien été créé.');
            }
        } catch (\Exception $e) {

            // ajout des informations dans les logs
            $log = new ActivityLog;
            $log->type = 'error';
            $log->key = 'user.create';
            $log->title = 'Erreur lors de la création d\'un compte';
            $log->description = 'Une erreur s\'est produite lors de la création d\'un compte par '. $this->firstname . ' ' . $this->lastname;
            $log->error = $e->getMessage();
            $log->notified = 1;
            $log->support_notified = 1;
            $log->save();

            return back()->with('error', 'Une erreur s\'est produite lors de la création de votre compte.');
        }
    }

    public function render()
    {
        return view('livewire.frontend.components.forms.register-form');
    }
}
