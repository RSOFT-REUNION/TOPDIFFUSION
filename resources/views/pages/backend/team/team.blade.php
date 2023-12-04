@extends('layouts.backend')

@section('content-template')
    <div id="back_page_content">
        <div id="entry-header" class="border-b border-gray-100">
            <div class="flex items-center">
                <div class="flex-1">
                    <h1>Equipes</h1>
                </div>
                <div class="flex-none">
                    <a onclick="Livewire.emit('openModal', 'popups.back.team.add-team')" class="btn-secondary cursor-pointer"><i class="fa-solid fa-plus mr-3"></i>Ajouter</a>
                </div>
            </div>
        </div>
        <div class="w-full flex flex-row gap-1 mt-12 flex-wrap">
            @foreach ($userAdmin as $users)
                    <div class="p-4 rounded-xl shadow-lg ring-black/5 border-solid border border-gray-950 bg-white hover:bg-slate-100 w-[33.1%]">
                        <div class="text-sm leading-6 text-slate-900 dark:text-white font-semibold select-none list-none">
                            <div class="flex items-center gap-x-6">
                                <i class="fa-solid fa-circle-user text-7xl text-black"></i>
                                <div>
                                    <h3 class="text-base font-semibold leading-7 tracking-tight text-gray-900">{{ $users->firstname }} {{ $users->lastname }}</h3>
                                    <p class="text-sm font-semibold leading-6 text-secondary">Administrateur</p>
                                </div>
                                <div class="ml-auto">
                                    <a class="px-2 text-lg hover:bg-gray-300 rounded-md"  onclick="Livewire.emit('openModal', 'popups.back.team.edit-team', {{ json_encode(['user' => $users->id]) }})"><i class="fa-solid fa-pen text-black"></i></a>
                                    <a class="px-2 text-lg hover:bg-gray-300 rounded-md"  onclick=""><i class="fa-solid fa-comment text-black"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
    </div>
@endsection
