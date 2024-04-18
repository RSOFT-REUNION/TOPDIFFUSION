@extends('layouts.frontend')

@section('content-template')
    <!-- HERO BANNER -->
    @if ($carrousel)
        <div class="flex flex-col">
            <div class="flex-none">
                @livewire('components.front.hero-banner')
            </div>
        </div>
    @endif

    <div class="container mx-auto">
        {{-- Ajout du block pour la création d'un Kit Chaine --}}
        {{-- <div class="mt-2 h-[300px] relative rounded-xl bg-no-repeat bg-cover overflow-hidden" style="background-image: url('{{ asset('img/background/Pignons Motorbikes.jpg') }}')">
            <div class="flex items-center h-full">
                <div class="flex-1 text-white w-1/2 pl-20 pr-10 py-10 h-full bg-gradient-to-r from-black">
                    <h2 class="font-bold text-3xl drop-shadow">Configurer votre kit chaine</h2>
                    <p class="drop-shadow">Vous pouvez configurer votre propre kit chaine pour votre moto directement depuis notre configurateur.</p>
                    <p class="text-white mt-5 text-lg font-bold">Pour cela, vous devez filtrer votre moto au travers des filtres présent juste en haut</p>
                </div>
            </div>

        </div>
    </div> --}}

    {{-- <div class="hero-banner" style="background-image: url({{ asset('img/medias/slide-1-hero.jpg') }})">
        <div class="container m-auto">
            <img src="{{ asset('img/logos/White.svg') }}" width="200px" class="ml-5">
            <h2>Votre magasin spécialisé !</h2>
        </div>
    </div> --}}

    <!-- OUR NEWS -->
    <div class="container-our-news">
        <div class="container mx-auto">
            <div class="flex items-center">
                <div class="flex-1">
                    <h2 class="title inline-flex items-center"><object data="{{ asset('img/icons/032-engine-1.svg') }}"
                            width="50px" class="mr-3"></object>Nos Nouveautés</h2>
                </div>
                <div class="flex-none">
                    <a href="{{ route('front.product-all') }}" class="btn-outline">Voir tout</a>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-10 mt-10">
                @foreach ($products as $product)
                    @livewire('components.front.products.product-thumbnails', ['product_id' => $product->id])
                @endforeach
            </div>
        </div>
    </div>
    <!-- OUR BRANDS -->
    <div class="container-our-brands">
        <div class="container mx-auto">
            <h2 class="title text-center">Nos marques partenaires</h2>
            {{-- <p class="mt-5">
                Lorem ipsum dolor sit amet consectetur. Viverra mauris tortor lobortis integer tincidunt pellentesque
                convallis nisl vitae. In sit amet pellentesque non lectus dignissim quis. Et sed sed nulla vitae vestibulum.
                Eleifend habitasse ullamcorper blandit vel amet.
            </p> --}}
        </div>
        <div class="container mx-auto grid grid-cols-4 gap-10 items-center mt-10">
            @foreach ($brands as $brand)
                <div class="force-center">
                    <a href="{{ $brand->url }}"><img src="{{ asset('storage/images/brands/' . $brand->picture) }}" width="200px" /></a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
