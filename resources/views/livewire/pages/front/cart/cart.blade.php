<main role="main" class="container mx-auto my-10">
    <div class="flex">
        <div class="flex-1 mr-2">
            <h1 class="text-4xl font-bold">Mon panier</h1>
            <div class="mt-5">
                <table class="w-full">
                    <thead>
                    <tr>
                        <th class="py-4 text-left">Produit</th>
                        <th>Prix unitaire (HT)</th>
                        <th>Quantité</th>
                        <th>Dispo.</th>
                        <th>Prix total (TTC)</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($my_cart as $cart)
                        <tr class="border-t border-gray-200">
                            <td class="py-3">
                                <div class="inline-flex items-center">
                                    <img src="{{ asset('storage/images/products/'. $cart->getProduct()->cover) }}" width="100px" class="rounded-lg">
                                    <div class="ml-3">
                                        <h3 class="text-xl font-bold">{{ $cart->getProduct()->title }}</h3>
                                        <p class="text-sm text-gray-500">UGS: {{ $cart->getSwatches()->ugs }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="text-xl text-center">{{ $cart->getUnitPrice() }} €</td>
                            <td class="text-center">
                                <div class="inline-flex items-center">
                                    @if($cart->quantity > 1)
                                        <a wire:click="minusQuantity({{ $cart->id }})" class="text-gray-400 cursor-pointer hover:text-amber-400"><i class="fa-solid fa-minus-circle"></i></a>
                                    @endif
                                    <p class="px-4 text-xl font-bold">{{ $cart->quantity }}</p>
                                    @if($cart->getProductStock()->quantity > $cart->quantity)
                                        <a wire:click="addQuantity({{ $cart->id }})" class="text-gray-400 cursor-pointer hover:text-amber-400"><i class="fa-solid fa-plus-circle"></i></a>
                                    @endif
                                </div>
                            </td>
                            <td class="text-center">{{ $cart->getProductStock()->quantity }} en stock</td>
                            <td class="text-xl font-bold text-center">{{ $cart->getTotalPriceLine() }} €</td>
                            <td><a wire:click="deleteProduct({{ $cart->id }})" class="cursor-pointer hover:text-amber-400"><i class="fa-solid fa-xmark"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex-none ml-2 width-300">
            <div class="px-3 py-2 bg-gray-100 rounded-lg">
                <h2 class="text-2xl font-bold">Résumé</h2>
            </div>
            <div class="px-3 py-2 mt-2 bg-gray-100 rounded-lg">
                <div class="">
                    <ul>
                        <li >
                            <div class="flex items-center">
                                <div class="flex-1">
                                    <h3 class="text-sm">Nb. produits</h3>
                                </div>
                                <div class="flex-none">
                                    <p class="text-xl font-bold">{{ $total_quantity }}</p>
                                </div>
                            </div>
                        </li>
                        <li class="mt-3">
                            <div class="flex items-center">
                                <div class="flex-1">
                                    <h3 class="text-sm">Livraison</h3>
                                </div>
                                <div class="flex-none">
                                    @if(auth()->user()->professionnal == 1 && auth()->user()->verified == 1)
                                        <p class="bg-green-500 text-white px-2 py-0.5 rounded-md">Offert</p>
                                    @else
                                        {!! $shipping !!}
                                    @endif
                                </div>
                            </div>
                        </li>
                        @foreach ($my_cart as $items_cart)
                            <li class="mt-3 border-t border-b border-gray-300">
                                <div class="flex lfex-row items-center justify-between">
                                    <div>
                                        <h3>Produit</h3>
                                    </div>
                                    <div>
                                        <p>10.20 €</p> 
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        <li class="mt-3">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-sm">Total des taxes</h3>
                                </div>
                                <div>
                                    <p class="text-xl font-bold text-red-500">{{ number_format($total_tax, 2, ',', ' ') }} €</p>
                                </div>
                                {{-- Ajoutez ici d'autres détails du résumé si nécessaire --}}
                            </div>
                        </li>
                        <li class="pt-1 mt-3 border-t border-dashed border-gray-300">
                            <div class="flex items-center">
                                <div class="flex-1">
                                    <h3 class="text-sm">Total TTC</h3>
                                </div>
                                <div class="flex-none">
                                    <p class="text-xl font-bold">{{ number_format($total_price, '2', ',', ' ') }} €</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            @if($user_address->count() > 0)
                @if(auth()->user()->professionnal === 1 && auth()->user()->verified === 1)
                    <button wire:click="initOrderCheck" class="block w-full py-3 mt-2 font-bold duration-300 bg-gray-100 border border-transparent rounded-lg hover:bg-secondary/30 hover:border-secondary">Chèque à la livraison</button>
                    <button wire:click="initOrderBilling" class="block w-full py-3 mt-2 font-bold duration-300 bg-gray-100 border border-transparent rounded-lg hover:bg-secondary/30 hover:border-secondary">Virement à la livraison</button>
                @endif
                <hr class="my-2 border-gray-100">
                <button wire:click="$emit('openModal', 'popups.relay-point')" class="block w-full py-3 mt-2 font-bold text-black duration-300 border border-transparent rounded-lg bg-secondary hover:bg-secondary/30 hover:border-secondary hover:text-secondary">Choisir un point relais</button>
                <button wire:click="initOrder" class="block w-full py-3 mt-2 font-bold text-white duration-300 border border-transparent rounded-lg bg-primary hover:bg-primary/30 hover:border-primary hover:text-primary">Payer directement par carte</button>
            @else
                <p class="px-3 py-1 mt-2 text-sm text-gray-500 bg-gray-100 border border-gray-200 rounded-md">
                    Vous n'avez pas encore configuré d'adresse de livraison, afin de continuer, merci d'en renseigné une.
                </p>
                <button type="button" onclick="window.location.href='{{ route('front.profile') }}'" class="block w-full py-3 mt-2 font-bold rounded-lg bg-secondary">Renseigner une adresse</button>
            @endif
        </div>
    </div>
</main>
