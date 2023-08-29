@extends('errors.template_error')

@section('title', 'Top diffusion - Maintenance')
@section('code', '503')
@section('message')
    <div class="bg-auto error bg-no-repeat w-full h-full grid grid-rows-1 grid-cols-3">
        <div class="flex flex-col h-full justify-center ml-24">
            <span class="text-3xl font-medium">Site en cours de</span>
            <span class="font-bold text-7xl">Maintenance</span>
        </div>
        <div class="flex flex-col justify-center items-center h-full col-span-2">
            <img src="{{ asset('img/logos/Blue.svg') }}" width="650px">
            <p class="mb-5">Désolés, nous sommes actuellement en cours de maintenance revenez plus tard.</p>
            <div class="flex flex-row items-center">
                <div class="mr-5">
                    <button class="btn-secondary">Connexion</button>
                </div>
            </div>
        </div>
    </div>
@endsection