@extends('layouts.frontend')

@section('content-template')
    <div class="container mx-auto">
        <div class="entry-header mt-5">
            <div class="flex items-center">
                <div class="flex-1">
                    <h1 class="font-bold text-3xl">Résultat de votre recherche</h1>
                    <p class="text-slate-400 text-sm capitalize">{{ $bike->marque }} {{ $bike->cylindree }} {{ $bike->modele }} {{ $bike->annee }}</p>
                </div>
                <div class="flex-none inline-flex items-center">
                    @if(count($bikesInfos) > 0)
                        {{-- <a class="btn-secondary cursor-pointer"><i class="fa-solid fa-filter mr-3"></i>Filtrer</a> --}}
                        <p class="text-tag-count mx-2">{{ count($bikesInfos) }}</p>
                    @endif

                </div>
            </div>
            <hr class="mt-5 text-gray-200">
        </div>
        <div class="content pb-10">
            {{-- Ajout du block pour la création d'un Kit Chaine --}}
            <div class="mt-2 h-[300px] relative rounded-xl bg-no-repeat bg-cover overflow-hidden" style="background-image: url('{{ asset('img/background/Pignons Motorbikes.jpg') }}')">
                <div class="flex items-center h-full">
                    <div class="flex-1 text-white w-1/2 pl-20 pr-10 py-10 h-full bg-gradient-to-r from-black">
                        <h2 class="font-bold text-3xl drop-shadow">Configurer votre kit chaine</h2>
                        <p class="drop-shadow">Vous pouvez configurer votre propre kit chaîne pour la moto ({{ $bike->marque }} {{ $bike->cylindree }} {{ $bike->modele }} {{ $bike->annee }}) directement depuis notre configurateur.</p>
                    </div>
                    <div class="flex-1"></div>
                    <div class="absolute bottom-5 right-5">
                        <button onclick="Livewire.emit('openModal', 'popups.front.products.chain-kit', {{ json_encode(['bike' => $bike->id]) }})" class="bg-white text-primary rounded-md px-5 py-2 font-bold duration-300 hover:bg-secondary hover:text-white"><i class="fa-solid fa-motorcycle mr-2"></i>Séléctionner votre Kit chaine AFAM</button>
                    </div>
                </div>
            </div>


            @if(count($bikesInfos) > 0)
                <div class="grid grid-cols-3 gap-10 mx-auto mt-10">
                    @foreach($bikesInfos as $bike)
                        @livewire('components.front.products.product-thumbnails', ['product_id' => $bike['id']])
                    @endforeach
                </div>
                <div class="mt-5">
                    {{-- {{ $products->links() }} --}}
                </div>
            @else
                <div class="flex items-center">
                    <div class="flex-1">
                        <div class="force-center">
                            <object data="{{ asset('img/icons/Empty-amico.svg') }}" width="400px"></object>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h2 class="subtitle">Cette catégorie semble vide...</h2>
                        <p class="text-gray-500 mt-3">N'hésitez pas à nous contacter si vous souhaitez plus d'informations ou à parcourir nos autres catégories</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
