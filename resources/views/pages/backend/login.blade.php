@extends('layouts.app')

@section('content-app')
    <div class="flex h-screen bg-cover" style="background-image: url('{{ asset('img/Background/hero-banner.jpg') }}')">
        <div class="m-auto">
            <div class="bg-white max-w-[500px] p-5 rounded-xl">
                <h1 class="font-title font-bold text-xl text-center">Connexion à votre<br>espace d'administration</h1>
                <p class="mt-5 text-slate-400 text-center">
                    Cet espace est réservé aux administrateurs du site. Si vous n'avez pas de compte, veuillez contacter le support.
                </p>
                <form method="POST" class="my-5">
                    @csrf
                    <x-elements.inputs.textfield label="Adresse e-mail" name="email" type="email" placeholder="Votre adresse e-mail" class="" require="" livewire=""/>
                    <x-elements.inputs.textfield label="Mot de passe" name="password" type="password" placeholder="Votre mot de passe" class="mt-3" require="" livewire=""/>
                    <x-elements.buttons.btn-submit class="mt-5 w-full" label="Se connecter" icon=""/>
                </form>
                <div class="border-t text-center">
                    <a href="{{ route('fo.home') }}" class="hover:text-blue-500 py-2 block">Retourner au site</a>
                </div>
            </div>
        </div>
    </div>
@endsection
