@extends('layouts.backend')

@section('content-template')
    <div id="back_page_content">
        <div id="entry-header" class="flex items-center">
            <div class="flex-1 inline-flex items-center">
                <button type="button" onclick="window.location.href='{{ route('back.orders.orders') }}'" class="btn-secondary mr-3"><i class="fa-solid fa-arrow-left"></i></button>
                <h1>Commande <span class="border py-0.5 px-1 border-gray-100 rounded-md text-gray-600">{{ $order->document_number }}</span></h1>
            </div>
            <div class="flex-none inline-flex items-center">
                {!! $order->getStateBadgeGestion() !!}
            </div>
        </div>
        <div id="entry-content" class="mt-5">
            <div class="grid grid-cols-4 gap-5">
                <div class="grid-item-button text-blue-700">
                    <div class="flex items-center">
                        <div class="flex-none mr-4">
                            <i class="fa-solid fa-boxes-stacked fa-2x"></i>
                        </div>
                        <div class="flex-1 ml-4">
                            <h3>{{ $order->total_product }}</h3>
                            <p>Produits</p>
                        </div>
                    </div>
                </div>
                <div class="grid-item-button text-green-500">
                    <div class="flex items-center">
                        <div class="flex-none mr-4">
                            <i class="fa-solid fa-money-check fa-2x"></i>
                        </div>
                        <div class="flex-1 ml-4">
                            <h3>{{ $order->total_amount }} €</h3>
                            <p>Total</p>
                        </div>
                    </div>
                </div>
                <div class="grid-item-button">
                    <div class="flex items-center">
                        <div class="flex-none mr-4">
                            <i class="fa-solid fa-calendar fa-2x"></i>
                        </div>
                        <div class="flex-1 ml-4">
                            <h3>{{ $order->getCreatedDate() }}</h3>
                            <p>Date</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex mt-10">
                <div class="flex-1 mr-2">
                    <div class="">
                        <h2 class="text-xl font-bold">Information de la commande</h2>
                        <div class="grid grid-cols-2 gap-4 mt-3">
                            <div class="bg-gray-100 text-center py-2 rounded-md duration-300 hover:bg-secondary cursor-pointer">
                                <p>Changer le status</p>
                            </div>
                            <div class="bg-gray-100 text-center py-2 rounded-md duration-300 hover:bg-secondary cursor-pointer">
                                <p>Voir la facture</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <h2 class="text-xl font-bold">Produits dans la commande</h2>
                        <div class="mt-3">
                            <ul>
                                @foreach($order_items as $item)
                                    <li>
                                        <div role="button" data-href="{{ route('back.product.list') }}" class="bg-gray-100 py-2 px-3 rounded-md duration-300 border border-transparent hover:border-gray-200 hover:scale-105 hover:drop-shadow-xl cursor-pointer">
                                            <div class="flex items-center">
                                                <div class="flex-none">
                                                    <img src="{{ asset('storage/images/products/'. $item->Product()->cover) }}" width="100px" class="rounded-sm">
                                                </div>
                                                <div class="flex-1 ml-4">
                                                    <div class="grid grid-cols-4 gap-4 items-center">
                                                        <div class="border-r border-gray-300">
                                                            <p class="text-xl font-bold truncate">{{ $item->Product()->title }}</p>
                                                            <p class="text-sm text-gray-500">{{ $item->Swatch()->ugs }}</p>
                                                        </div>
                                                        <div class="border-r border-gray-300">
                                                            <p class="text-sm text-gray-500">Prix unit.</p>
                                                            <p class="text-xl font-bold">{{ number_format($item->product_price, '2', ',', ' ') }} €</p>
                                                        </div>
                                                        <div class="border-r border-gray-300 ">
                                                            <p class="text-sm text-gray-500">Qte.</p>
                                                            <p class="text-xl font-bold">{{ $item->quantity }}</p>
                                                        </div>
                                                        <div>
                                                            <p class="text-sm text-gray-500">Total</p>
                                                            <p class="text-xl font-bold">{{ $item->getTotalLinePrice() }} €</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="flex-none ml-2 w-2/5">
                    <div class="bg-gray-100 rounded-lg">
                        <div class="inline-flex items-center py-2 px-4 border-b border-white w-full">
                            <i class="fa-solid fa-user mr-2"></i>
                            <h2 class="border-r pr-2 mr-2 border-gray-200">CLIENT</h2>
                            <a href="{{ route('back.user.single', ['user' => $order->User()->customer_code]) }}" class="text-sm border py-0.5 px-2 rounded-md border-gray-300 hover:bg-blue-200 hover:text-blue-500 hover:border-blue-500">{{ $order->User()->lastname }} {{ $order->User()->firstname }}</a>
                        </div>
                        <div class="py-2 px-4">
                            <div class="text-input-white">
                                <label>Adresse e-mail</label>
                                <p class="">{{ $order->User()->email }}</p>
                            </div>
                            @if($order->User()->phone != null)
                                <div class="text-input-white mt-2">
                                    <label>Numéro de téléphone</label>
                                    <p class="">{{ $order->User()->phone }}</p>
                                </div>
                            @endif
                            <div class="text-input-white mt-2">
                                <label>Compte créé</label>
                                <p class="">{{ $order->User()->getCreatedAt() }}</p>
                            </div>
                            <div class="text-input-white mt-2">
                                <label>Type de client</label>
                                <p class="">{!! $order->User()->getCustomerType() !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-100 rounded-lg mt-2">
                        <div class="inline-flex items-center py-2 px-4 border-b border-white w-full">
                            <i class="fa-solid fa-truck mr-2"></i>
                            <h2>ADRESSE DE LIVRAISON</h2>
                        </div>
                        <div class="py-2 px-4 text-center">
                            <p>{{ $order->Address()->address }},</p>
                            <p>{{ $order->Address()->postal_code }}, {{ $order->Address()->city }} - {{ $order->Address()->country }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
