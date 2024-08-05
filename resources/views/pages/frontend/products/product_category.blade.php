@extends('layouts.frontend')

@section('content')
    {{-- TODO: Passer en livewire --}}
    <div class="container mx-auto my-10">
        <div class="inline-flex items-center justify-between w-full border-b pb-4">
            <div class="inline-flex items-center gap-5 ">
                <span class="border rounded-full py-1 px-2">{{ $products->count() }}</span>
                <div>
                    <h1 class="font-title font-bold text-xl">Produits associés</h1>
                    <h3 class="text-slate-400">{{ $category->name }}</h3>
                </div>
            </div>
        </div>
        @if($products->count() > 0)
            <div class="mt-5 grid grid-cols-4 gap-5">
                @foreach($products as $product)
                    @livewire('frontend.components.products.thumbnails', ['product' => $product])
                @endforeach
            </div>
        @else
            <p class="py-5 text-center text-slate-400">Aucun produit n'est référencé pour cette catégorie</p>
        @endif
    </div>

@endsection
