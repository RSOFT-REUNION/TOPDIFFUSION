@extends('pages.frontend.profile.my-account-template')

@section('profile_template')
    <div>
        <div id="entry-header" class="flex items-center">
            <div class="flex flex-row w-full">
                <button type="button" onclick="window.history.back()" class="mr-3 btn-secondary"><i
                        class="fa-solid fa-arrow-left"></i></button>
                <div class="inline-flex items-center justify-between flex-1 w-full border-b">
                    <h1 class="text-xl font-bold">Commande <span class=" text-secondary">{{ $order->document_number }}</span>
                    </h1>
                    <div class="inline-flex items-center flex-none">
                        {!! $order->getStateBadgeGestion() !!}
                    </div>
                </div>
            </div>
        </div>

        <div id="entry-content" class="mt-5">
            <div class="flex flex-row gap-x-4">
                <div class="flex flex-col w-2/3 gap-y-4">
                    <div class="w-full bg-gray-100 rounded-lg">
                        <div class="flex flex-row items-center p-4 border-b border-white">
                            <i class="mr-2 fa-solid fa-truck"></i>
                            <h2 class="text-xl font-bold">Adresse de livraison</h2>
                        </div>
                        <div class="flex flex-row items-center pl-12 h-28">
                            <p>{{ $order->Address()->address }}, {{ $order->Address()->postal_code }},
                                {{ $order->Address()->city }} - {{ $order->Address()->country }}</p>
                        </div>
                    </div>
                    <div class="flex flex-row w-full gap-x-4">
                        <div class="flex justify-center w-full py-3 duration-300 rounded-lg cursor-pointer bg-secondary hover:bg-primary hover:text-white" onclick="Livewire.emit('openModal', 'pages.front.sav.open-ticket-sav', {{ json_encode(['user' => $order->User()->id, 'command' => $order->document_number])}})">
                            <h2>Demande SAV</h2>
                        </div>
                        <div class="flex justify-center w-full py-3 bg-gray-100 rounded-lg cursor-pointer hover:bg-primary hover:text-white">
                            <h2>Voir la facture</h2>
                        </div>
                    </div>
                    <div class="w-full bg-gray-100 rounded-lg">
                        <div class="flex flex-row items-center p-4 border-b border-white">
                            <i class="mr-2 fa-solid fa-cart-flatbed"></i>
                            <h2 class="text-xl font-bold">Produits dans la commande</h2>
                        </div>
                        <div class="flex flex-col items-center h-full gap-y-4">
                            @foreach ($order_items as $item)
                                <div role="button"
                                    data-href="{{ route('front.product', ['slug' => $item->ProductItem->slug]) }}"
                                    class="px-3 py-2 duration-300 bg-gray-100 border border-transparent rounded-md cursor-pointer hover:border-gray-200 hover:scale-105 hover:drop-shadow-xl">
                                    <div class="flex items-center">
                                        <div class="flex-none">
                                            <img src="{{ asset('storage/images/products/' . $item->Product()->cover) }}"
                                                width="100px" class="rounded-sm">
                                        </div>
                                        <div class="flex-1 ml-4">
                                            <div class="grid items-center grid-cols-4 gap-4">
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

                <div class="flex flex-col w-1/3 gap-y-4">
                    <div class="w-full bg-gray-100 rounded-lg">
                        <div class="flex flex-row items-center p-4 border-b border-white">
                            <i class="mr-2 fa-solid fa-circle-info"></i>
                            <h2 class="text-xl font-bold">Information de la commande</h2>
                        </div>
                        <div class="flex flex-row items-center pl-12 h-28 text-primary">
                            <i class="fa-solid fa-calendar fa-2x"></i>
                            <div class="flex-1 ml-10">
                                <h3 class="text-2xl font-bold">{{ $order->getCreatedDate() }}</h3>
                                <p>Date</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-full text-green-600 bg-gray-100 rounded-lg">
                        <div class="flex flex-row items-center pl-12 h-28">
                            <i class="fa-solid fa-money-check fa-2x"></i>
                            <div class="flex-1 ml-10">
                                <h3 class="text-2xl font-bold">{{ $order->total_amount }} €</h3>
                                <p>Total</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-full text-blue-600 bg-gray-100 rounded-lg">
                        <div class="flex flex-row items-center pl-12 h-28">
                            <i class="fa-solid fa-boxes-stacked fa-2x"></i>
                            <div class="flex-1 ml-10">
                                <h3 class="text-2xl font-bold">{{ $order->total_product }}</h3>
                                <p>Produits</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <h2 class="text-xl font-bold">Point Relais Choisi</h2>
            @if ($order->relaisPoint)
                <div
                    class="flex flex-col {{ $order->relaisPoint->available ? 'bg-secondary border-primary text-primary' : 'bg-primary border-secondary text-secondary' }} w-full rounded-[8px] p-4 duration-500">
                    <div class="flex items-center">
                        <div class="flex flex-row items-center pr-4 my-3 border-r border-white">
                            <i class="fa-solid fa-location-dot text-[20px]"></i>
                        </div>
                        <div class="flex flex-row items-center justify-between w-full ml-4">
                            <div class="flex items-center gap-x-3">
                                <label class="select-none">{{ $order->relaisPoint->name }},
                                    {{ $order->relaisPoint->address }}</label>
                            </div>
                            <div
                                class="text-{{ $order->relaisPoint->available ? 'green' : 'red' }}-700 flex flex-row items-center justify-center bg-white rounded-[5px] py-3 px-4">
                                <h4>{{ $order->relaisPoint->available ? 'Disponible' : 'Pas disponible' }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col ml-10 duration-500 opacity-100 gap-y-3 max-h-96" id="selected">
                        <div class="flex">
                            <div class="w-1/2 border-r border-primary">
                                @foreach (['Lundi', 'Mardi', 'Mercredi'] as $day)
                                    <div class="flex flex-row items-center gap-x-3">
                                        <span>{{ $day }}</span>
                                        <i class="fa-solid fa-arrow-right-long"></i>
                                        @if (isset($formattedOpeningHours[$day]))
                                            <span>{{ $formattedOpeningHours[$day] }}</span>
                                        @else
                                            <span>Aucune information</span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <div class="pl-5">
                                @foreach (['Jeudi', 'Vendredi', 'Samedi'] as $day)
                                    <div class="flex flex-row items-center gap-x-3">
                                        <span>{{ $day }}</span>
                                        <i class="fa-solid fa-arrow-right-long"></i>
                                        @if (isset($formattedOpeningHours[$day]))
                                            <span>{{ $formattedOpeningHours[$day] }}</span>
                                        @else
                                            <span>Aucune information</span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <p>Aucun point relais choisi pour cette commande.</p>
            @endif

    </div>
@endsection
