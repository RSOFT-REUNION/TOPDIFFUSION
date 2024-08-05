@extends('layouts.frontend')

@section('content')
    <div class="container mx-auto flex h-full">
        <div class="m-auto my-20">
            @if($paymentData['result']['code'] == '01208')
                <div class="force-center">
                    <img src="{{ asset('img/Illustrations/card_lost.svg') }}" class="w-[500px]">
                </div>
                <div class="text-center w-[600px]">
                    <h1 class="font-bold text-3xl">Votre carte a été déclaré perdu ou volé</h1>
                    <p class="text-slate-400 mt-2 mb-10">
                        Nous sommes dans le regret de vous informer que votre paiement n'a pas pu être effectué car
                        votre carte a été déclaré perdu ou volé.
                    </p>
                    <a href="{{ route('fo.home') }}" class="bg-primary py-3 px-5 rounded-lg hover:bg-secondary hover:text-white duration-300 hover:ring ring-slate-200">Retourner à l'accueil</a>
                </div>
            @elseif($paymentData['result']['code'] == '00000')
                <div class="force-center">
                    <img src="{{ asset('img/Illustrations/card_accept.svg') }}" class="w-[500px]">
                </div>
                <div class="text-center w-[600px]">
                    <h1 class="font-bold text-3xl">Paiement réussi !</h1>
                    <p class="text-slate-400 mt-2 mb-10">
                        Nous vous remerçions pour votre paiement, vous allez recevoir un email de confirmation
                    </p>
                    <a href="{{ route('fo.home') }}" class="bg-primary py-3 px-5 rounded-lg hover:bg-secondary hover:text-white duration-300 hover:ring ring-slate-200">Retourner à l'accueil</a>
                </div>
            @elseif($paymentData['result']['code'] == '03022')
                <div class="force-center mb-5">
                    <img src="{{ asset('img/Illustrations/card_refuse.svg') }}" class="w-[500px]">
                </div>
                <div class="text-center w-[600px]">
                    <h1 class="font-bold text-3xl text-red-400">Paiement échoué !</h1>
                    <p class="text-slate-400 mt-2 mb-10">
                        Nous sommes dans le regret de vous informer que votre paiement n'a pas pu être effectué.
                    </p>
                    <a href="{{ route('fo.home') }}" class="bg-primary py-3 px-5 rounded-lg hover:bg-secondary hover:text-white duration-300 hover:ring ring-slate-200">Retourner à l'accueil</a>
                </div>
            @endif
        </div>
    </div>
@endsection
