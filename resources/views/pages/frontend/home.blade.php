@extends('layouts.frontend')

@section('title')
    | Accueil
@endsection

@section('meta-description')
    Découvrez notre sélection d'accessoires et de pièces détachées conçus spécialement pour les passionnés de moto.
    Nous vous proposons une gamme diversifiée de produits de qualité pour répondre à tous vos besoins en matière
    d'équipement et d'entretien de votre moto. Que vous soyez un motard chevronné ou un amateur débutant, notre collection
    comprend tout ce dont vous avez besoin pour personnaliser, entretenir et optimiser votre monture. Parcourez notre
    catalogue et trouvez les accessoires parfaits pour rendre chaque trajet plus sûr, plus confortable et plus stylé.
@endsection

@section('content')
    {{-- Hero Banner --}}
    @livewire('frontend.components.hero-banner')

    {{-- Nos nouveautés --}}
    <div class="container mx-auto mt-[70px]">
        <div class="flex items-center justify-between">
            <h2 class="title-section"><img src="{{ asset('img/icons/motor.svg') }}" width="50px" class="mr-3">Nos nouveaux produits</h2>
        </div>
        <div class="grid grid-cols-4 gap-5 mt-5">
            @foreach($products as $product)
                @livewire('frontend.components.products.thumbnails', ['product' => $product])
            @endforeach
        </div>
    </div>

    {{-- Nos marques --}}
    <div class="container mx-auto my-[70px]">
        <div class="flex items-center gap-[50px]">
            <div class="flex-none">
                <h2 class="title-section"><img src="{{ asset('img/icons/partenaires.svg') }}" width="50px" class="mr-3">Nos marques partenaires</h2>
            </div>
            <div class="flex-1">
                <p class="text-slate-400">
                    Nous collaborons avec des marques partenaires renommées dans l'industrie de la moto, soigneusement sélectionnées pour leur réputation de qualité et de fiabilité.
                </p>
            </div>
        </div>
        <div class="inline-flex items-center gap-20 mt-10 justify-center w-full">
            @foreach($brands as $brand)
                <img src="{{ asset('storage/products/brands/'. $brand->logo) }}" width="200px">
            @endforeach
        </div>
    </div>

    {{-- Nos catégories phare --}}
    {{--<div class="container mx-auto mt-[70px]">
        <div class="flex items-center justify-between">
            <h2 class="title-section"><img src="{{ asset('img/icons/success.svg') }}" width="50px" class="mr-3">Nos produits phare</h2>
        </div>
    </div>--}}
@endsection
