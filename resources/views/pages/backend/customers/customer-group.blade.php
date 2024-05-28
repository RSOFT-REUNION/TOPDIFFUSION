@extends('layouts.backend')

@section('content')
    <div class="inline-flex items-center justify-between w-full">
        <h1 class="font-title font-bold text-2xl">Groupe de client</h1>
        <button onclick="Livewire.dispatch('openModal', {component: 'backend.popups.users.add-user-group'})" class="btn-primary"><i class="fa-solid fa-plus mr-3"></i>Ajouter un nouveau groupe</button>
    </div>
    <div class="mt-5">
        <div class="inline-flex items-center gap-5 p-5 bg-slate-100 w-full rounded-xl border">
            <i class="fa-solid fa-circle-info fa-xl text-slate-400"></i>
            <p class="text-slate-400">
                Les groupes de clients vous permettent de regrouper vos clients en fonction de leurs caractéristiques
                communes. Vous pouvez ensuite utiliser ces groupes pour envoyer des e-mails, des promotions ou des
                notifications spécifiques à un groupe de clients. Par défaut, vos clients se retrouvent dans le groupe
                "Particulier".
            </p>
        </div>
        <div class="mt-10 grid grid-cols-4 gap-5">
            @foreach($groups as $group)
                <div class="bg-slate-100 border rounded-xl flex flex-col group cursor-pointer duration-300 hover:scale-105 hover:bg-white hover:drop-shadow-2xl">
                    <div class="p-5 flex-1">
                        <h2 class="font-title font-bold text-xl">{{ $group->name }}</h2>
                        <p class="text-sm text-slate-400">{{ $group->description }}</p>
                    </div>
                    <div class="flex-none p-5 border-t">
                        @if($group->discount == 0.0)
                        <p class="">Aucune remise par défaut</p>
                        @else
                            <div class="inline-flex items-center justify-between w-full">
                                <p class="text-slate-400">Remise par défaut</p>
                                <p class="font-title font-bold font-lg bg-slate-200 group-hover:bg-primary duration-300 py-1 px-2 rounded-full">{{ $group->discount }} %</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-10">
            <h2 class="font-title font-bold text-xl">Configuration des groupes</h2>
            @livewire('backend.pages.customers.partials.form-customers-group-otions')
        </div>
    </div>
@endsection
