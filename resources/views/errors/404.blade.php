@extends('errors::minimal')

@section('title','Top diffusion - Page Introuvable')
@section('code', '404')
@section('message')
    <div class="bg-auto error bg-no-repeat w-full h-full grid grid-rows-1 grid-cols-3">
        <div class="flex flex-col h-full justify-center ml-32">
            <span class="text-9xl font-bold">404</span>
            <span class="font-medium text-5xl">Page introuvable</span>
        </div>
        <div class="flex flex-col justify-center items-center h-full col-span-2">
            <img src="{{ asset('img/logos/Blue.svg') }}" width="650px">
            <p class="mb-5">Désolé, nous n'avons pas trouvé la page que vous recherchez.</p>
            <div class="flex flex-row items-center">
                <div class="mr-5">
                    <button class="btn-secondary">Retour a l'accueil</button>
                </div>
                <div>
                    <button class="font-semibold">contactez le support</button>
                </div>
            </div>
        </div>
    </div>
@endsection
