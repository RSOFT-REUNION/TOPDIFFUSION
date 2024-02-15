@extends('layouts.frontend')

@section('content-template')
    <div class="container mx-auto my-5">
        <h1 class="text-4xl font-bold">Réinitialisation de votre mot de passe</h1>
        <p class="text-slate-400 mt-3">Vous êtes sur le point de modifier votre mot de passe.</p>
        <form method="POST" class="w-1/2 mx-auto mt-10 border-2 border-slate-100 rounded-xl p-5">
            @csrf
            <input type="hidden" name="user" value="{{ $user->id }}">
            <div class="textfield">
                <label for="password">Entrez votre nouveau mot de passe</label>
                <input type="password" id="password" name="password" placeholder="Entrez un nouveau mot de passe">
            </div>
            <div class="textfield mt-2">
                <label for="password_confirmation">Entrez votre nouveau mot de passe (confirmation)</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Entrez un nouveau mot de passe (confirmation)">
            </div>
            @if($errors->has('password'))
                <p class="text-red-500 bg-red-100 py-1 px-3 rounded-md mt-3">{{ $errors->first('password') }}</p>
            @endif
            <div class="mt-5 text-center">
                <button type="submit" class="btn-secondary">Modifier mon mot de passe</button>
            </div>
        </form>
    </div>
@endsection
