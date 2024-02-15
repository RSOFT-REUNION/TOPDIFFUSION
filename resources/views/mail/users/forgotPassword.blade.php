<x-mail::message>
# Bonjour, {{ $user->firstname }}

Vous avez effectué une demande de réinitialisation de votre mot de passe. Pour cela, veuillez cliquer sur le bouton ci-dessous.

<x-mail::button :url="route('fo.forgotPassword', ['token' => $token])">
    Reinitialiser mon mot de passe
</x-mail::button>

Si vous n'êtes pas à l'origine de cette demande, veuillez ignorer cet e-mail.

Cordialement,<br>
L'équipe TOPDIFFUSION,
</x-mail::message>
