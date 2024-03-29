<div>
    @if(auth()->user())
        @if($carts->count() > 0)
            <ul>
                @foreach($carts as $cart)
                    <li>
                        <div class="flex items-center">
                            <div class="flex-1 inline-flex items-center">
                                <img src="{{ asset('storage/images/products/'. $cart->getProduct()->cover) }}" width="100px">
                                <div class="ml-2">
                                    <h2 class="font-bold">{{ $cart->getProduct()->title }}</h2>
                                    <p class="text-sm text-gray-500">Référence: @if($cart->getProduct()->type == 1) {{ $cart->getSwatches()->ugs }} @else {{ $cart->getSwatches()->ugs.'-'.$cart->getSwatches()->ugs_swatch }} @endif</p>
                                    @if($cart->getProduct()->type != 1)
                                        <p class="text-sm">{{ $cart->getGroupSwatch()->title }} : {{ $cart->getTagSwatch()->title }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex-none inline-flex items-center">
                                <p class="border-r border-gray-200 pr-2 mr-2 text-xl"><span class="text-sm text-gray-500">QTE.</span> {{ $cart->quantity }}</p>
                                @if(!auth()->guest() && auth()->user()->professionnal === 1 && auth()->user()->verified === 1)
                                    <h2 class="font-bold text-xl">{{ $cart->getTotalPriceLine() }} €</h2>
                                @else
                                    <h2 class="font-bold text-xl">{{ $cart->getTotalPriceLine() }} €</h2>
                                @endif
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p>Vous n'avez aucun article dans votre panier</p>
        @endif
    @endif
</div>
