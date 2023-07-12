@extends('pages.frontend.profile.my-account-template')

@section('profile_template')
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h1>Mes informations</h1>
            </div>
            <div class="flex-none">
                <a onclick="Livewire.emit('openModal', 'popups.front.profile.edit-profile', {{ json_encode(['user_id' => $me->id]) }})" class="btn-secondary cursor-pointer">Modifier mes informations</a>
            </div>
        </div>
    </div>
    <div class="entry-content mt-5">
        <div class="flex">
            <div class="flex-1 mr-2">
                <div class="text-input">
                    <label for="name">Nom & prénom</label>
                    <p><b>{{ $me->lastname }}</b> {{ $me->firstname }}</p>
                </div>
                <div class="text-input mt-2">
                    <label for="name">Adresse e-mail</label>
                    <p>{{ $me->email }}</p>
                </div>
            </div>
            <div class="flex-1 ml-2">
                <div class="text-input">
                    <label for="name">Code client</label>
                    <p>{{ $me->customer_code }}</p>
                </div>
                <div class="text-input mt-2">
                    <label for="name">Numéro de téléphone</label>
                    <p>@if($me->phone) {{ $me->phone }} @else <span class="text-blue-500">Aucun numéro de renseigné</span> @endif</p>
                </div>
            </div>
        </div>
        <div class="mt-3 grid grid-cols-3 gap-4">
            <div class="grid-item-profile">
                <h3>{{ $me->getCustomerTypeText() }}</h3>
                <p>Type de compte</p>
            </div>
            <div class="grid-item-profile">
                <h3>@if($me->verified_at) {{ $me->getVerifiedAt() }} @else Pas encore vérifié @endif</h3>
                <p>Compte validé le</p>
            </div>
            <div class="grid-item-profile">
                <h3>{{ $me->getCreatedAt() }}</h3>
                <p>Date d'inscription</p>
            </div>
        </div>
        <hr class="my-3">
        <div class="flex items-center mx-4">
            <div class="flex-1">
                <h2 class="subtitle">Mon entreprise</h2>
            </div>
        </div>
        <div class="flex mt-3">
            <div class="flex-1 mr-2">
                <div class="text-input">
                    <label for="name">Raison sociale</label>
                    <p>{{ $meData->company_name }}</p>
                </div>
                <div class="text-input mt-2">
                    <label for="name">Numéro RCS</label>
                    <p>{{ $meData->company_rcs }}</p>
                </div>
            </div>
            <div class="flex-1 ml-2">
                <div class="text-input">
                    <label for="name">Nom commercial</label>
                    <p>@if($meData->company_com_name) {{ $meData->company_com_name }} @else <span class="text-blue-500">Aucun nom commercial renseigné</span> @endif</p>
                </div>
                <div class="text-input mt-2">
                    <label for="name">Numéro de TVA</label>
                    <p>{{ $meData->company_tva }}</p>
                </div>
            </div>
        </div>
        <hr class="my-3">
        <div class="flex items-center mx-4">
            <div class="flex-1">
                <h2 class="subtitle">Mes adresses</h2>
            </div>
            <div class="flex-none">
                <a onclick="Livewire.emit('openModal', 'popups.front.profile.add-user-addresses', {{ json_encode(['user_id', $me->id]) }})" class="btn-secondary cursor-pointer">Ajouter une adresse</a>
            </div>
        </div>
        <div class="mt-3">
            @if($addresses->count() > 0)
                <div class="mt-4 grid grid-cols-3 gap-4">
                    @foreach($addresses as $address)
                        <div class="grid-item-profile">
                            <h3>{{ $address->address }}</h3>
                            <h4>{{ $address->address_bis }}</h4>
                            <h4>{{ $address->city }} | {{ $address->postal_code }}</h4>
                            <h4>{{ $address->country }}</h4>
                            <p class="mt-3">{{ $address->title }}</p>
                            <div class="inline-flex items-center mt-3 border-t border-gray-200 pt-2">
                                <a href="{{ route('front.profile.delete.address', ['id' => $address->id]) }}" class="mr-3 hover:text-red-500"><i class="fa-solid fa-trash"></i></a>
                                <a onclick="Livewire.emit('openModal', 'popups.front.profile.edit-address', {{ json_encode(['address_id' => $address->id]) }})" class="ml-3 hover:text-amber-500 cursor-pointer"><i class="fa-solid fa-edit"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="empty-text">Vous n'avez pas encore ajouté d'adresses.</p>
            @endif
        </div>
    </div>
@endsection
