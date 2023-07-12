@extends('layouts.frontend')

@section('content-template')
    <div id="sign-page" class="flex">
        <div class="container mx-auto">
            <div class="arianne my-4">
                <p><a href="{{ route('front.home') }}"><i class="fa-solid fa-house mr-2"></i>Accueil</a> / Connexion</p>
            </div>
            <div class="title-page">
                <h1 class="title">Connexion</h1>
            </div>
            @if($errors->has('error_input'))
                <p class="box-error mt-3"><i class="fa-solid fa-circle-exclamation mr-3"></i>{{ $errors->first('error_input') }}</p>
            @endif
            <div class="container-box mt-5">
                <div class="container-box-content m-auto width-500">
                    <form method="POST">
                        @csrf

                        <div class="textfield">
                            <label for="email">Adresse e-mail</label>
                            <input type="email" id="email" placeholder="Entrez votre adresse e-mail" name="email" value="{{ old('email') }}">
                        </div>
                        <div class="textfield mt-2">
                            <label for="password">Mot de passe</label>
                            <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" class="@if($errors->has('password')) input-error @endif">
                            @if($errors->has('password'))
                                <p class="text-error">{{ $errors->first('password') }}</p>
                            @endif
                        </div>
                        <div class="mt-3 mx-5 flex items-center">
                            <div class="flex-1">
                                <div class="textfield-checkbox">
                                    <input type="checkbox" id="remember" name="remember">
                                    <label for="remember">Se souvenir de moi</label>
                                </div>
                            </div>
                            <div class="flex-none">
                                <a href="" class="">Mot de passe oublié ?</a>
                            </div>
                        </div>

                        <div class="flex mt-10">
                            <div class="mx-auto width-500">
                                <button type="submit" class="btn-secondary block w-full"><i class="fa-solid fa-arrow-right-to-bracket mr-2"></i>Se connecter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
