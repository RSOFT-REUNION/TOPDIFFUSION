@extends('pages.frontend.profile.my-account-template')

@section('profile_template')
    <div>
        <div id="entry-header" class="flex items-center">
            <div class="flex flex-row w-full">
                <button type="button" onclick="window.history.back()" class="btn-secondary mr-3"><i
                        class="fa-solid fa-arrow-left"></i></button>
                <div class="flex-1 inline-flex justify-between w-full items-center border-b">
                    <h1 class="font-bold text-xl">Commande <span class=" text-secondary">{{ $order->document_number }}</span>
                    </h1>
                    <div class="flex-none inline-flex items-center">
                        {!! $order->getStateBadgeGestion() !!}
                    </div>
                </div>
            </div>
        </div>

        <div id="entry-content" class="mt-5">
            <div class="flex flex-row gap-x-4">
                <div class="flex flex-col w-2/3 gap-y-4">
                    <div class="w-full bg-gray-100 rounded-lg">
                        <div class="flex flex-row items-center border-b p-4 border-white">
                            <i class="fa-solid fa-truck mr-2"></i>
                            <h2 class="font-bold text-xl">Adresse de livraison</h2>
                        </div>
                        <div class="flex flex-row items-center h-28 pl-12">
                            <p>{{ $order->Address()->address }}, {{ $order->Address()->postal_code }},
                                {{ $order->Address()->city }} - {{ $order->Address()->country }}</p>
                        </div>
                    </div>
                    <div class="flex flex-row w-full gap-x-4">
                        <div class="bg-secondary hover:bg-primary hover:text-white duration-300 w-full flex justify-center py-3 rounded-lg cursor-pointer" onclick="Livewire.emit('openModal', 'pages.front.sav.open-ticket-sav', {{ json_encode(['user' => $order->User()->id, 'command' => $order->document_number])}})">
                            <h2>Demande SAV</h2>
                        </div>
                        <div class="bg-gray-100 hover:bg-primary hover:text-white w-full flex justify-center py-3 rounded-lg cursor-pointer">
                            <h2>Voir la facture</h2>
                        </div>
                    </div>
                    <div class="w-full bg-gray-100 rounded-lg">
                        <div class="flex flex-row items-center border-b p-4 border-white">
                            <i class="fa-solid fa-cart-flatbed mr-2"></i>
                            <h2 class="font-bold text-xl">Produits dans la commande</h2>
                        </div>
                        <div class="flex flex-col items-center h-full gap-y-4">
                            @foreach ($order_items as $item)
                                <div role="button"
                                    data-href="{{ route('front.product', ['slug' => $item->ProductItem->slug]) }}"
                                    class="bg-gray-100 py-2 px-3 rounded-md duration-300 border border-transparent hover:border-gray-200 hover:scale-105 hover:drop-shadow-xl cursor-pointer">
                                    <div class="flex items-center">
                                        <div class="flex-none">
                                            <img src="{{ asset('storage/images/products/' . $item->Product()->cover) }}"
                                                width="100px" class="rounded-sm">
                                        </div>
                                        <div class="flex-1 ml-4">
                                            <div class="grid grid-cols-4 gap-4 items-center">
                                                <div class="border-r border-gray-300">
                                                    <p class="text-xl font-bold truncate">
                                                        {{ $item->Product()->title }}</p>
                                                    <p class="text-sm text-gray-500">{{ $item->Swatch()->ugs }}</p>
                                                </div>
                                                <div class="border-r border-gray-300">
                                                    <p class="text-sm text-gray-500">Prix unit.</p>
                                                    <p class="text-xl font-bold">
                                                        {{ number_format($item->product_price, '2', ',', ' ') }} €
                                                    </p>
                                                </div>
                                                <div class="border-r border-gray-300 ">
                                                    <p class="text-sm text-gray-500">Qte.</p>
                                                    <p class="text-xl font-bold">{{ $item->quantity }}</p>
                                                </div>
                                                <div>
                                                    <p class="text-sm text-gray-500">Total</p>
                                                    <p class="text-xl font-bold">{{ $item->getTotalLinePrice() }} €
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-y-4 w-1/3">
                    <div class="w-full bg-gray-100 rounded-lg">
                        <div class="flex flex-row items-center border-b p-4 border-white">
                            <i class="fa-solid fa-circle-info mr-2"></i>
                            <h2 class="font-bold text-xl">Information de la commande</h2>
                        </div>
                        <div class="flex flex-row items-center pl-12 h-28 text-primary">
                            <i class="fa-solid fa-calendar fa-2x"></i>
                            <div class="flex-1 ml-10">
                                <h3 class="font-bold text-2xl">{{ $order->getCreatedDate() }}</h3>
                                <p>Date</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-full bg-gray-100 rounded-lg text-green-600">
                        <div class="flex flex-row items-center pl-12 h-28">
                            <i class="fa-solid fa-money-check fa-2x"></i>
                            <div class="flex-1 ml-10">
                                <h3 class="font-bold text-2xl">{{ $order->total_amount }} €</h3>
                                <p>Total</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-full bg-gray-100 rounded-lg text-blue-600">
                        <div class="flex flex-row items-center pl-12 h-28">
                            <i class="fa-solid fa-boxes-stacked fa-2x"></i>
                            <div class="flex-1 ml-10">
                                <h3 class="font-bold text-2xl">{{ $order->total_product }}</h3>
                                <p>Produits</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
