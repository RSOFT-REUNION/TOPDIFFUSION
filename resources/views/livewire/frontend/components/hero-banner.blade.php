<div class="relative h-[600px]">
    <div class="bg-cover h-full z-0" style="background-image: url('{{ asset('img/Background/hero-banner.jpg') }}')"></div>

    {{-- Contenu --}}
    <div class="absolute top-20 w-full">
        <div class="container mx-auto">
            <h1 class="font-bold text-white text-5xl drop-shadow">Bienvenue sur <span class="text-secondary">TOP DIFFUSION</span></h1>
            <p class="w-[900px] mt-5 drop-shadow text-white">
                Découvrez notre sélection d'accessoires et de pièces détachées conçus spécialement pour les passionnés
                de moto. Nous vous proposons une gamme diversifiée de produits de qualité pour répondre à tous vos besoins
                en matière d'équipement et d'entretien de votre moto. Que vous soyez un motard chevronné ou un amateur
                débutant, notre collection comprend tout ce dont vous avez besoin pour personnaliser, entretenir et optimiser
                votre monture. Parcourez notre catalogue et trouvez les accessoires parfaits pour rendre chaque trajet plus sûr,
                plus confortable et plus stylé.
            </p>
        </div>
    </div>

    {{-- Kit chaine --}}
    <form wire:submit.prevent="submit">
        @csrf
        <div class="absolute bottom-10 w-full">
            <div class="container mx-auto">
                <p class="text-white text-lg font-bold">Configurer votre kit chaine ou rechercher des produits par moto</p>
                <div class="bg-white rounded-xl p-3">
                    <div class="inline-flex items-center w-full">
                        <p class="font-bold mx-5 inline-flex items-center"><img src="{{ asset('img/icons/chain.svg') }}" width="24px"/></p>
                        <div class="textfield-kit">
                            {{-- Marques --}}
                            <select wire:model.live="kit_brand">
                                <option value="">Marque</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand }}">{{ $brand }}</option>
                                @endforeach
                            </select>
                            {{-- Marques --}}
                            <select wire:model.live="kit_cylinder" class="border-l">
                                <option value="">Cylindrée</option>
                                @if($cylinders)
                                    @foreach($cylinders as $cylinder)
                                        <option value="{{ $cylinder }}">{{ $cylinder }}</option>
                                    @endforeach
                                @endif
                            </select>
                            {{-- Marques --}}
                            <select wire:model.live="kit_model" class="border-l">
                                <option value="">Modèle</option>
                                @if($models)
                                    @foreach($models as $model)
                                        <option value="{{ $model }}">{{ $model }}</option>
                                    @endforeach
                                @endif
                            </select>
                            {{-- Marques --}}
                            <select wire:model.live="kit_year" class="border-x">
                                <option value="">Année</option>
                                @if($years)
                                    @foreach($years as $year)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endforeach
                                @endif
                            </select>
                            {{-- Boutton d'envoi --}}
                            <button type="submit">Configurer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
