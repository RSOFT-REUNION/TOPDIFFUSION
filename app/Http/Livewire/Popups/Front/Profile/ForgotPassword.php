<?php

namespace App\Http\Livewire\Popups\Front\Profile;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use LivewireUI\Modal\ModalComponent;

class ForgotPassword extends ModalComponent
{
    public $user;
    public $email;

    protected $rules = [
        'email' => 'required|email'
    ];

    protected $messages = [
        'email.required' => "Une adresse e-mail est requise.",
        'email.email' => "L'adresse e-mail n'est pas valide."
    ];

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function updated()
    {
        $this->validateOnly('email');
    }

    // Fonction pour envoyer un email de reinitialisation aux clients.
    public function sendEmail()
    {
        $user = User::where('email', $this->email)->first();
        $token = Str::random(60);
        if($user) {
            // Si un utilisateur existe vraiment avec cette adresse email
            $user->remember_token = $token;
            if($user->update())
            {
                Mail::to($this->email)->send(new \App\Mail\Users\ForgotPassword($user, $token));

                // Ajout de l'information dans les activités
                $activity = new ActivityLog;
                $activity->user_id = $user->id;
                $activity->activity_type = 'PASSWORD_FORGOT';
                $activity->activity_description = 'Demande de réinitialisation de mot de passe pour l\'utilisateur ' . $user->lastname . ' ' . $user->firstname;
                $activity->save();

                return redirect()->route('front.login')->with(
                    'success', 'Un email de réinitialisation de mot de passe vous a été envoyé'
                );
            } else {
                // Retourner une erreur visible pour l'utilisateur
                return redirect()->route('front.login')->with('error', 'Cet adresse e-mail n\'est pas inscrit chez nous !');
            }
        }
    }

    public function render()
    {
        return view('livewire.popups.front.profile.forgot-password');
    }
}
