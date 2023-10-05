@extends('layouts.frontend')

@section('content-template')
    <div id="profile-page">
        <div class="container mx-auto">
            <div class="arianne my-4">
                <p><a href="{{ route('front.home') }}"><i class="fa-solid fa-house mr-2"></i>Accueil</a> / Mon profil</p>
            </div>
            @if($me->professionnal === 1 && $me->verified != 1)
                <div class="px-3 py-2 mb-3 bg-amber-100 text-amber-600 rounded-lg">
                    Votre compte professionnel est en cours de vérification, une fois celui-ci vérifié, vous recevrez un e-mail de confirmation et vous pourrait profiter de tous les avantages liés aux professionnels.
                </div>
            @endif
            <div class="flex">
                <div class="flex-none entry-nav">
                    <ul>
                        <li><a href="{{ route('front.profile') }}" class="btn-sidebar @if($account_page == 'informations') btn-sidebar-active text-white hover:text-black @endif"><i class="fa-solid fa-user mr-3"></i>Mes informations</a></li>
                        <li><a href="{{ route('front.commands') }}" class="btn-sidebar mt-1 @if($account_page == 'commands') btn-sidebar-active text-white hover:text-black @endif"><i class="fa-solid fa-file-invoice mr-3"></i>Mes commandes & factures</a></li>
                        <li><a href="{{ route('front.profile.bikes') }}" class="btn-sidebar mt-1 @if($account_page == 'bikes') btn-sidebar-active text-white hover:text-black @endif"><i class="fa-solid fa-motorcycle mr-3"></i>Mes motos</a></li>
                        <li><a href="{{ route('front.profile.sav') }}" class="btn-sidebar mt-1 @if($account_page == 'sav') btn-sidebar-active  text-white hover:text-black @endif"><i class="fa-solid fa-comments mr-3"></i>Mes demande SAV</a></li>
                    </ul>
                </div>
                <div class="flex-1 entry-content pl-4">
                    @yield('profile_template')
                </div>
            </div>
        </div>
    </div>
@endsection
