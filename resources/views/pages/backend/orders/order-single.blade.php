@extends('layouts.backend')

@section('content-template')
    <div id="back_page_content">
        <div id="entry-header" class="flex items-center">
            <div class="inline-flex items-center flex-1">
                <button type="button" onclick="window.location.href='{{ route('back.orders.orders') }}'"
                    class="mr-3 btn-secondary"><i class="fa-solid fa-arrow-left"></i></button>
                <h1>Commande <span
                        class="border py-0.5 px-1 border-gray-100 rounded-md text-gray-600">{{ $order->document_number }}</span>
                </h1>
            </div>
            <div class="inline-flex items-center flex-none">
                {!! $order->getStateBadgeGestion() !!}
            </div>
        </div>
        <div id="entry-content" class="mt-5">
            <div class="grid grid-cols-4 gap-5">
                <div class="text-blue-700 grid-item-button">
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
                <div class="text-green-500 grid-item-button">
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
                            <div
                                class="py-2 text-center duration-300 bg-gray-100 rounded-md cursor-pointer hover:bg-secondary">
                                <p>Changer le status</p>
                            </div>
                            <div
                                class="py-2 text-center duration-300 bg-gray-100 rounded-md cursor-pointer hover:bg-secondary">
                                <p>Voir la facture</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <h2 class="text-xl font-bold">Produits dans la commande</h2>
                        <div class="mt-3">
                            <ul>
                                @foreach ($order_items as $item)
                                    <li>
                                        <div role="button" data-href="{{ route('back.product.list') }}"
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
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="flex-none w-2/5 ml-2">
                    <div class="bg-gray-100 rounded-lg">
                        <div class="inline-flex items-center w-full px-4 py-2 border-b border-white">
                            <i class="mr-2 fa-solid fa-user"></i>
                            <h2 class="pr-2 mr-2 border-r border-gray-200">CLIENT</h2>
                            <a href="{{ route('back.user.single', ['user' => $order->User()->customer_code]) }}"
                                class="text-sm border py-0.5 px-2 rounded-md border-gray-300 hover:bg-blue-200 hover:text-blue-500 hover:border-blue-500">{{ $order->User()->lastname }}
                                {{ $order->User()->firstname }}</a>
                        </div>
                        <div class="px-4 py-2">
                            <div class="text-input-white">
                                <label>Adresse e-mail</label>
                                <p class="">{{ $order->User()->email }}</p>
                            </div>
                            @if ($order->User()->phone != null)
                                <div class="mt-2 text-input-white">
                                    <label>Numéro de téléphone</label>
                                    <p class="">{{ $order->User()->phone }}</p>
                                </div>
                            @endif
                            <div class="mt-2 text-input-white">
                                <label>Compte créé</label>
                                <p class="">{{ $order->User()->getCreatedAt() }}</p>
                            </div>
                            <div class="mt-2 text-input-white">
                                <label>Type de client</label>
                                <p class="">{!! $order->User()->getCustomerType() !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 bg-gray-100 rounded-lg">
                        <div class="inline-flex items-center w-full px-4 py-2 border-b border-white">
                            <i class="mr-2 fa-solid fa-truck"></i>
                            <h2>ADRESSE DE LIVRAISON</h2>
                        </div>
                        <div class="px-4 py-2 text-center">
                            <p>{{ $order->Address()->address }},</p>
                            <p>{{ $order->Address()->postal_code }}, {{ $order->Address()->city }} -
                                {{ $order->Address()->country }}</p>
                        </div>
                    </div>
                </div>
            </div>

            @if ($order->relaisPoint)
            <div class="flex flex-col {{ $order->relaisPoint->available ? 'bg-secondary border-primary text-primary' : 'bg-primary border-secondary text-secondary' }} w-full rounded-[8px] mt-4 p-2 duration-500">
                <div class="flex flex-row items-center p-3 border-b border-white">
                    <i class="fa-solid pr-3 fa-location-dot text-[20px]"></i>
                    <h2 class="text-xl font-bold">Point Relais Choisi</h2>
                    <div class="ml-auto text-{{ $order->relaisPoint->available ? 'green' : 'red' }}-700 flex flex-row items-center justify-end bg-white rounded-[5px] py-3 px-4">
                        <h4>{{ $order->relaisPoint->available ? 'Disponible' : 'Pas disponible' }}</h4>
                    </div>
                </div>
                <div class="flex items-center">
                    <!-- Horaires d'ouverture -->
                    <div class="flex flex-row items-center w-full ml-3">
                        <div class="flex items-center pt-3">
                            <i class="fa-solid pr-2 fa-clock"></i>
                            <h4 class="text-xl">Horaires d'ouverture</h4>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col ml-10 duration-500 opacity-100 gap-y-3 max-h-96" id="selected">
                    <div class="flex items-center">
                        <div class="w-1/4 border-r border-primary">
                            <!-- Horaires d'ouverture pour Lundi, Mardi, Mercredi -->
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
                            <!-- Horaires d'ouverture pour Jeudi, Vendredi, Samedi -->
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
                        <!-- Informations supplémentaires à droite des horaires -->
                        <div class=" w-1/3 ml-auto">
                            <!-- Adresse, numéro de téléphone et e-mail en ligne -->
                            <div class="flex mt-2">
                                <strong>Nom du point de relais :&nbsp;</strong> {{ $order->relaisPoint->name }}
                            </div>
                            <div class="flex mt-2">
                                <strong>Adresse :&nbsp;</strong> {{ $order->relaisPoint->address }}
                            </div>

                            <div class="flex mt-2">
                                <strong>Numéro de téléphone :&nbsp;</strong> {{ $order->relaisPoint->contact_phone }}
                            </div>
                            <div class="flex mt-2">
                                <strong>E-mail :&nbsp;</strong> {{ $order->relaisPoint->contact_email }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @else
                <p>Aucun point relais choisi pour cette commande.</p>
            @endif

        </div>
    </div>
@endsection
