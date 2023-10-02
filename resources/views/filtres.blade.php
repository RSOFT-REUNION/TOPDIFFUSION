@extends('layouts.frontend')

@section('content-template')
    <div class="container mx-auto">
        <div class="entry-header mt-5">
            <div class="flex items-center">
                <div class="flex-1">
                    <h1 class="font-bold text-3xl">Résultat de votre recherche</h1>
                </div>
                <div class="flex-none inline-flex items-center">
                    @if(count($bikesInfos) > 0)
                        {{-- <a class="btn-secondary cursor-pointer"><i class="fa-solid fa-filter mr-3"></i>Filtrer</a> --}}
                        <p class="text-tag-count ml-2">{{ count($bikesInfos) }}</p>
                    @endif
                </div>
            </div>
            <hr class="mt-5 text-gray-200">
        </div>
        <div class="content pb-10">
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
