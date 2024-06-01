@extends('layouts.backend')

@section('content')
    <h1 class="font-title font-bold text-xl">Tableau de bord</h1>
    <div class="mt-5">
        <div class="grid grid-cols-4 gap-5">
            <div class="border rounded-xl group overflow-hidden">
                <div class="inline-flex items-center justify-center gap-5 w-full p-5 bg-white">
                    <p class="text-xl font-title">{{ $products_cart->count() == 0 ? 'Aucun' : $products_cart->count() }}</p>
                </div>
                <div class="border-t bg-slate-100 p-3 text-center">
                    <p class="text-slate-400 text-sm">Nb. produit dans un panier</p>
                </div>
            </div>
            <div class="border rounded-xl group overflow-hidden">
                <div class="inline-flex items-center justify-center gap-5 w-full p-5 bg-white">
                    <p class="text-xl font-title">{{ $cart_amount > 0 ? number_format($cart_amount, 2, ',', ' '). ' €' : 'Aucun' }}</p>
                </div>
                <div class="border-t bg-slate-100 p-3 text-center">
                    <p class="text-slate-400 text-sm">Montant totale des paniers</p>
                </div>
            </div>
            <div class="border rounded-xl group overflow-hidden">
                <div class="inline-flex items-center justify-center gap-5 w-full p-5 bg-white">
                    <p class="text-xl font-title">{{ $stock_low->count() > 0 ? $stock_low->count() : 'Aucun' }}</p>
                </div>
                <div class="border-t bg-amber-100 p-3 text-center">
                    <p class="text-amber-600 text-sm">Nb. produit avec un stock faible</p>
                </div>
            </div>
            <div class="border rounded-xl group overflow-hidden">
                <div class="inline-flex items-center justify-center gap-5 w-full p-5 bg-white">
                    <p class="text-xl font-title">{{ $stock_rupture->count() > 0 ? $stock_rupture->count() : 'Aucun' }}</p>
                </div>
                <div class="border-t bg-red-100 p-3 text-center">
                    <p class="text-red-400 text-sm">Nb. produit en rupture de stock</p>
                </div>
            </div>
        </div>
        <div class="mt-5 text-center">
            <p class="text-slate-400">Votre tableau de bord évoluera au fil du temps</p>
        </div>
    </div>
@endsection
