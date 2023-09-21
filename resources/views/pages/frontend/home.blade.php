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
            <p class="mt-5">
                Lorem ipsum dolor sit amet consectetur. Viverra mauris tortor lobortis integer tincidunt pellentesque
                convallis nisl vitae. In sit amet pellentesque non lectus dignissim quis. Et sed sed nulla vitae vestibulum.
                Eleifend habitasse ullamcorper blandit vel amet.
            </p>
        </div>
        <div class="grid grid-cols-4 gap-10 items-center mt-10">
            @foreach ($brands as $brand)
                <div class="force-center">
                    <img src="{{ asset('storage/images/brands/' . $brand->picture) }}" width="200px" />
                </div>
            @endforeach
        </div>
    </div>
@endsection
