@extends('pages.frontend.profile.my-account-template')

@section('profile_template')
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h1>Mes demande SAV</h1>
            </div>
        </div>
    </div>
    {{-- @livewire('components.front.profile.profil-sav') --}}
    <div class="entry-content mt-5">
        <div class="flex flex-col gap-y-3 w-full">
            <div class="flex flex-row items-center px-[30px] py-[20px] bg-gray-100 justify-between rounded-lg hover:shadow-lg hover:scale-102 duration-500 cursor-pointer">
                <i class="fa-solid fa-boxes-stacked text-xl"></i>
                <h2>Commande</h2>
                <h3>Numéro de la commande</h3>
                <h4>25 Janvier 2023</h4>
                <div class="flex flex-row items-center">
                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                    <h5>Status</h5>
                </div>
                <h6>152.52 €</h6>
            </div>
        </div>
    </div>
@endsection
