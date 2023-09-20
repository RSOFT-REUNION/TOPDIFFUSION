<main role="main" class="container mx-auto my-10">
    <div class="flex">
        <div class="flex-1 mr-2">
            <h1 class="text-4xl font-bold">Mon panier</h1>
            <div class="mt-5">
                <table class="w-full">
                    <thead>
                    <tr>
                        <th class="text-left py-4">Produit</th>
                        <th>Prix unitaire</th>
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
                                        <p class="text-gray-500 text-sm">UGS: {{ $cart->getSwatches()->ugs }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center text-xl">{{ $cart->getUnitPrice() }} €</td>
                            <td class="text-center">
                                <div class="inline-flex items-center">
                                    @if($cart->quantity > 1)
                                        <a wire:click="minusQuantity({{ $cart->id }})" class="text-gray-400 hover:text-amber-400 cursor-pointer"><i class="fa-solid fa-minus-circle"></i></a>
                                    @endif
                                    <p class="px-4 font-bold text-xl">{{ $cart->quantity }}</p>
                                    @if($cart->getProductStock()->quantity > $cart->quantity)
                                        <a wire:click="addQuantity({{ $cart->id }})" class="text-gray-400 hover:text-amber-400 cursor-pointer"><i class="fa-solid fa-plus-circle"></i></a>
                                    @endif
                                </div>
                            </td>
                            <td class="text-center">{{ $cart->getProductStock()->quantity }} en stock</td>
                            <td class="text-center text-xl font-bold">{{ $cart->getTotalPriceLine() }} €</td>
                            <td><a wire:click="deleteProduct({{ $cart->id }})" class="cursor-pointer hover:text-amber-400"><i class="fa-solid fa-xmark"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex-none width-300 ml-2">
            <div class="bg-gray-100 rounded-lg px-3 py-2">
                <h2 class="text-2xl font-bold">Résumer</h2>
            </div>
            <div class="bg-gray-100 rounded-lg px-3 py-2 mt-2">
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
                                    <p class="text-xl font-bold">0,00 €</p>
                                </div>
                            </div>
                        </li>
                        <li class="border-t border-gray-300 mt-1 pt-1">
                            <div class="flex items-center">
                                <div class="flex-1">
                                    <h3 class="text-sm">Total TTC</h3>
                                </div>
                                <div class="flex-none">
                                    <p class="text-xl font-bold">{{ $total_price }} €</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            @if($user_address->count() > 0)
                <button wire:click="initOrder" class="bg-secondary mt-2 block w-full py-3 rounded-lg font-bold">Procéder au paiement</button>
            @else
                <p class="mt-2 bg-gray-100 border border-gray-200 rounded-md text-gray-500 text-sm px-3 py-1">
                    Vous n'avez pas encore configuré d'adresse de livraison, afin de continuer, merci d'en renseigné une.
                </p>
                <button type="button" onclick="window.location.href='{{ route('front.profile') }}'" class="bg-secondary mt-2 block w-full py-3 rounded-lg font-bold">Renseigner une adresse</button>
            @endif

        </div>
    </div>
</main>
