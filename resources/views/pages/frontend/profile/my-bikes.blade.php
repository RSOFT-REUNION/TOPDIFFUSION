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
                        {{-- <div class="grid-item-profile">
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
                        </div> --}}
                        <div class="flex flex-col bg-gray-100 rounded-lg">
                            <div class="flex flex-row justify-between items-center py-3 px-5 w-full border-b border-white">
                                <div class="flex flex-row gap-x-3 items-center">
                                    <i class="fa-solid fa-motorcycle"></i>
                                    <h2 class="text-xl font-bold">{{ $bike->getBike()->marque }}</h2>
                                </div>
                                <i class="fa-solid fa-trash hover:text-red-700 cursor-pointer"></i>
                            </div>
                            <div class="flex flex-row flex-wrap px-5 gap-y-3 items-center h-full py-3">
                                <div class="bg-white w-full rounded-lg py-1.5 flex flex-row items-center justify-center">
                                    <h2>Modèle : {{ $bike->getBike()->modele }}</h2>
                                </div>
                                <div class="flex flex-row gap-x-2 w-full">
                                    <div class="bg-white rounded-lg py-1.5 w-full flex flex-row items-center justify-center">
                                        <h2>Cylindrée : {{ $bike->getBike()->cylindree }}</h2>
                                    </div>
                                    <div class="bg-white rounded-lg py-1.5 w-full flex flex-row items-center justify-center">
                                        <h2>Année : {{ $bike->getBike()->annee }}</h2>
                                    </div>
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
