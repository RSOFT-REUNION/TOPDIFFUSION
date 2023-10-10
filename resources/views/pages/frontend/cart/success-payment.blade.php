@extends('layouts.app')

@section('content-app')
    <div class="flex h-screen">
        <div class="m-auto">
            <div class="border border-gray-100 bg-white p-10 drop-shadow-2xl rounded-lg text-center">
                <img src="{{ asset('img/logos/Blue.svg') }}" width="200px">
                <p class="mt-5 bg-red-100 border border-red-200 rounded-md px-2 py-1">
                    {{ $response_payment }}
                </p>
                <a href="{{ route('front.home') }}" class="mt-3 bg-secondary border border-secondary px-4 py-2 rounded-md block w-full hover:bg-opacity-30 ">Retourner à l'accueil</a>
            </div>
        </div>
    </div>
@endsection
