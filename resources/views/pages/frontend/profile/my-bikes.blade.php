@extends('pages.frontend.profile.my-account-template')

@section('profile_template')
    <div id="profile-page">
        <div class="entry-header">
            <div class="flex items-center">
                <div class="flex-1">
                    <h1>Mes motos</h1>
                </div>
                <div class="flex-none">
                    <a onclick="Livewire.emit('openModal', 'popups.front.profile.add-user-bikes')" class="btn-secondary block cursor-pointer">Sélectionner une moto</a>
                </div>
            </div>
        </div>
        <div class="entry-content">
            @if($bikes->count() > 0)
                <div class="grid grid-cols-3 gap-10 mt-3">
                    @foreach($bikes as $bike)
                        <div class="grid-item-profile">
                            <h3><span class="text-gray-500">{{ $bike->getBike()->marque }}</span> {{ $bike->getBike()->modele }}</h3>
                            <div class="mt-3">
                                <span class="other-tag inline-flex items-center"><b>Cylindrée: </b> {{ $bike->getBike()->cylindree }}</span>
                                <span class="other-tag ml-2 inline-flex items-center"><b>Année: </b> {{ $bike->getBike()->annee }}</span>
                            </div>
                            <div class="mt-3">
                                <div class="inline-flex items-center">
                                    <a href="{{ route('front.profile.delete.bikes', ['id' => $bike->id]) }}" class="hover:text-amber-500"><i class="fa-solid fa-trash"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="empty-text mt-3">Vous n'avez pas encore ajouté de moto</p>
            @endif
        </div>
    </div>
@endsection
