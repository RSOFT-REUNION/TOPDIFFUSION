@extends('pages.frontend.profile.profile-template')

@section('content')
    <div class="container mx-auto my-10">
        <a href="{{ route('fo.profile.orders') }}" class="btn-slate"><i class="fa-solid fa-arrow-left mr-3"></i>Retour à la liste</a>
        <div class="inline-flex items-center justify-between w-full">
            <h1 class="mt-4 font-bold font-title text-3xl">Commande n°{{ $order->id }} - Référence <span class="text-slate-400">{{ $order->code }}</span></h1>
            <h2 class="font-title text-3xl font-bold">{{ number_format($order->total, 2, ',', ' ') }} € <span class="text-slate-400 text-base">TTC</span></h2>
        </div>

        <div class="flex items-start gap-5 mt-10">
            <div class="flex-1">
                <div class="grid grid-cols-3 gap-5">
                    <div class="border rounded-xl hover:bg-slate-100 hover:scale-105 duration-300 group hover:drop-shadow-2xl cursor-pointer overflow-hidden">
                        <div class="inline-flex items-center justify-center gap-5 w-full p-5 bg-white">
                            <p class="text-xl font-title">{!! $order->getStateText() !!}</p>
                        </div>
                        <div class="border-t @if($order->state == 0) bg-amber-100 @elseif($order->state == 1) bg-green-100 @endif p-3 text-center">
                            <p class="@if($order->state == 0) text-amber-400 @elseif($order->state == 1) text-green-400 @endif text-sm">Status de la commande</p>
                        </div>
                    </div>
                    <div class="border col-span-2 rounded-xl hover:bg-slate-100 hover:scale-105 duration-300 group hover:drop-shadow-2xl cursor-pointer overflow-hidden">
                        <div class="inline-flex items-center justify-center gap-5 w-full p-5 bg-white">
                            <p class="text-xl font-title">{{ $order->getPaymentMethod() }}</p>
                        </div>
                        <div class="border-t bg-slate-100 p-3 text-center">
                            <p class="text-slate-400 text-sm">Mode de paiement</p>
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    <h2 class="font-bold font-title text-xl">Liste des produits</h2>
                    <div class="table-box-outline mt-5">
                        <table>
                            <thead>
                            <tr>
                                <th><i class="fa-solid fa-image"></i></th>
                                <th>Produit</th>
                                <th>Quantité</th>
                                <th>Prix unitaire (HT)</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orderItems as $item)
                                <tr>
                                    <td>
                                        <div class="force-center">
                                            @if($item->product()->cover)
                                                <img class="rounded-md" src="{{ asset('storage/products/covers/'. $item->product()->cover) }}" width="50px">
                                            @else
                                                <div class="w-[50px] aspect-square bg-slate-100 flex">
                                                    <div class="m-auto">
                                                        <i class="fa-solid fa-image-slash"></i>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="border-r">
                                        <div class="text-left">
                                            <p class="">{{ $item->product()->name }}</p>
                                            <p class="text-slate-400 text-sm">Aucune variante</p>
                                        </div>
                                    </td>
                                    <td class="font-title">{{ $item->quantity }}</td>
                                    <td class="font-title">{{ number_format($item->price_unit_ht, 2, ',', ' ') }} €</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="flex-none w-[400px]">
                <div class="border w-[400px] overflow-hidden rounded-xl">
                    <div class="p-5 border-b">
                        <h2 class="font-title font-bold text-xl">Client</h2>
                        <div class="inline-flex justify-between w-full mt-3">
                            <p class="text-slate-400">Remise client :</p>
                            <p class="font-title font-medium">{{ $order->getUser()->getDiscount() }} %</p>
                        </div>
                        <div class="inline-flex justify-between w-full mt-3">
                            <p class="text-slate-400">Compte créé le :</p>
                            <p class="font-title font-medium">{{ date('d/m/Y', strtotime($order->getUser()->created_at)) }}</p>
                        </div>
                    </div>
                    <div class="p-5">
                        <h2 class="font-title font-bold text-xl">Adresse de livraison</h2>
                        @if($shipping_point)
                            <div class="bg-slate-100 p-3 mt-3 rounded-lg">
                                <div class="inline-flex items-center gap-5">
                                    <i class="fa-solid fa-map-marker-alt"></i>
                                    <div>
                                        <p class="font-bold text-lg">{{ $shipping_point->name }}</p>
                                        <p class="text-sm text-slate-400">{{ $shipping_point->getFullAddress() }}</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="bg-slate-100 p-3 mt-3 rounded-lg">
                                <div class="inline-flex items-center gap-5">
                                    <i class="fa-solid fa-map-marker-alt"></i>
                                    <div>
                                        <p class="font-bold text-lg">Adresse du client</p>
                                        <p class="text-sm text-slate-400">{{ $order->getUser()->getFullAddress() }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
