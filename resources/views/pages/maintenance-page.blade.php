@extends('layouts.app')

@section('content-app')
    <div class="flex flex-rows w-screen h-screen">
        <div class="w-full h-full grid grid-rows-1 grid-cols-3">
            <div class="flex flex-col h-full justify-center items-center bg-secondary">
                <div class="flex flex-col">
                    <span class="text-3xl font-medium">Site en cours de</span>
                    <span class="font-bold text-7xl">Maintenance</span>
                </div>
            </div>
            <div class="flex flex-col justify-center items-center h-full col-span-2">
                <img src="{{ asset('img/logos/Blue.svg') }}" width="650px">
                <p class="mb-5">Désolés, nous sommes actuellement en cours de maintenance revenez plus tard.</p>
                <div class="flex flex-row items-center">
                    @livewire('components.maintenance.btn-login')
                </div>
            </div>
        </div>
    </div>
@endsection
