@extends('layouts.frontend')

@section('title')
    | Inscription
@endsection

@section('content')
    <div class="container mx-auto my-5 px-5 lg:px-0 lg:my-10">
        {{-- Breadcumbs --}}
        <nav class="" aria-label="breadcumbs">
            <ol class="inline-flex items-center gap-3">
                <li><a href="{{ route('fo.home') }}" class="text-slate-400 hover:text-primary"><i class="fa-solid fa-house mr-2"></i>Accueil</a></li>
                <li><i class="fa-solid fa-caret-right"></i></li>
                <li><a href="{{ route('fo.register') }}" class="hover:text-primary">Inscription</a></li>
            </ol>
        </nav>
    </div>
    <div class="container mx-auto my-10">
        <div class="flex flex-col md:flex-row px-5 items-start gap-[50px]">
            <div class="flex-1">
                <h1 class="font-bold font-title text-2xl">Créer un compte TopDiffusion</h1>
                <p class="text-slate-400 mt-5">Les champs comportant (*) sont obligatoire</p>
                @livewire('frontend.components.forms.register-form')
            </div>
            <div class="flex-1 hidden md:flex">
                <div class="bg-cover min-h-[600px] h-full w-full max-h-[700px] rounded-xl bg-center relative" style="background-image: url('{{ asset('img/Background/background_register.jpg') }}')">
                    <div class="absolute bottom-10 left-10 right-10 text-white *:drop-shadow bg-white/30 p-5 rounded-lg backdrop-blur-md">
                        <p>Ouvrez votre compte maintenant et profitez de:</p>
                        <ul class="list-disc ml-3 mt-2">
                            <li>Des <b>remises professionnelles, programmes de vente</b> et <b>offres spéciales</b>.</li>
                            <li>Livraison de vos commandes dans des <b>délais records</b>.</li>
                            <li>Une <b>solution numérique complète</b>: trouver des produits, passer et suivre les commandes, télécharger les factures, gérer les garanties, contacter nos équipes et bien plus.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
