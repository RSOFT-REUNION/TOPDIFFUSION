@extends('errors::minimal')

@section('title','Top diffusion - Page Introuvable')
@section('code', '404')
@section('message')
    <div class="w-full h-full grid grid-rows-1 grid-cols-3">
        <div class="flex flex-col h-full justify-center items-center bg-secondary">
            <div class="flex flex-col">
                <span class="text-9xl font-bold">404</span>
                <span class="font-medium text-5xl">Page introuvable</span>
            </div>
        </div>
        <div class="flex flex-col justify-center items-center h-full col-span-2">
            <img src="{{ asset('img/logos/Blue.svg') }}" width="650px">
            <p class="mb-5">Désolé, nous n'avons pas trouvé la page que vous recherchez.</p>
            <div class="flex flex-row items-center">
                <div class="mr-5 mt-5">
                    <a href="{{ url('/') }}" class="btn-secondary">Retour a l'accueil</a>
                </div>
                {{-- <div>
                    <button class="font-semibold">contactez le support</button>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
