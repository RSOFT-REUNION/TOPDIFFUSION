@extends('layouts.frontend')

@section('content-template')
    <div id="sign-page" class="flex">
        <div class="container mx-auto">
            <div class="arianne my-4">
                <p><a href="{{ route('front.home') }}"><i class="fa-solid fa-house mr-2"></i>Accueil</a> / Inscription</p>
            </div>
            <div class="title-page">
                <h1 class="title">Créer votre compte</h1>
            </div>
            <div class="container-box mt-5">
                <div class="container-box-content m-auto flex">
                    <div class="flex-1 mr-5">
                        <p class="mb-2"><b>Ouvrez votre compte maintenant et profitez de:</b></p>
                        <ul>
                            <li>Des <b>remises professionnelles</b>, <b>programmes de vente</b> et <b>offres spéciales</b>.</li>
                            <li>Livraison de vos commandes dans des <b>délais records</b></li>
                            <li>Une <b>solution numérique complète</b>: trouver des produits, passer et suivre les commandes, télécharger les factures, gérer les garanties, contacter nos équipes et bien plus.</li>
                        </ul>
                    </div>
                    <div class="flex-1 ml-5">
                        @livewire('front.register-inputs')
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
