@extends('layouts.frontend')

@section('content-template')

    <div class="flex flex-col">
        <div class="w-full bg-primary">
            <div class="py-10 px-24  flex flex-row justify-between items-center">
                <div class="text-white gap-y-2 flex flex-col">
                    <h1 class="text-4xl font-bold">Mes Favoris</h1>
                </div>
                <div class="text-white text-9xl">
                    <i class="fa-solid fa-heart"></i>
                </div>
            </div>
        </div>

        <div class="px-24 my-20">
            <div class="w-full border-b border-black flex justify-between flex-row ">
                <div class="flex flex-row gap-x-2 items-center">
                    <a
                        class="font-semibold flex items-center gap-x-2 justify-center"
                        href="{{
                            request()->route('sort') === 'desc'
                            ? route('front.favorite', ['sort' => 'asc'])
                            : route('front.favorite', ['sort' => 'desc'])
                        }}"
                    >
                        {{
                            request()->route('sort') === 'desc'
                            ? "Favoris dans l'ordre de date décroissant"
                            : "Favoris dans l'ordre de date croissant"
                        }}
                        <i class="fa-solid {{ request()->route('sort') === 'desc' ? 'fa-arrow-trend-down' : 'fa-arrow-trend-up' }}"></i>
                    </a>
                </div>
                <div>
                    <p class="font-semibold">{{ $totalFavorites }} favoris</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-10 mx-24 mb-20">
            @foreach ($product as $products)
                @livewire('components.front.products.product-thumbnails', ['product_id' => $products->id])
            @endforeach
        </div>
    </div>

@endsection
