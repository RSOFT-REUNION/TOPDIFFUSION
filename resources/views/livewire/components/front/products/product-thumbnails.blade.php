<div class="item-thumbnail" role="button" data-href="{{ route('front.product', ['slug' => $product->slug]) }}">
    <div class="flex flex-col h-full">
        <div class="flex-1">
            <div class="thunbnail-icons">
                <div class="content-icons">
                    <div class="flex">
                        <div class="flex-none">
                            <div class="tags-group flex gap-x-3 ml-1">
                                @if($product_stock == 0)
                                    <p class="tags bg-red-500 text-white">Rupture de stock</p>
                                @elseif($product_stock < 3 && $product_stock > 0)
                                    <p class="tags bg-orange-500 text-white">Plus que {{ $product_stock }}</p>
                                @endif
                                @if ($promotion)
                                    <p class="tags bg-[#fbbc34] text-black">{{ $this->promotion->discount }} %</p>
                                @endif
                            </div>
                        </div>
                        {{-- <div class="flex-grow"></div> --}}
                        <div class="flex-none absolute right-0 top-3">
                            @if($isFavorite)
                                <a class="py-[14px] px-[16px] rounded-full duration-300 bg-[#ff253a20] hover:bg-gray-200 hover:text-black text-red-500" wire:click.stop="deleteFavorite({{ $product->id }})  "><i class="fa-solid fa-heart"></i></a>
                            @else
                                <a class="py-[14px] px-[16px] rounded-full duration-300  bg-gray-200 hover:text-red-500 hover:bg-[#ff253a20]" wire:click.stop="addProductToFavorite({{ $product->id }}) "><i class="fa-solid fa-heart"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="force-center mb-5 w-full">
                <img class="rounded-lg w-full" src="{{ asset('storage/images/products/'. $product->cover) }}">
            </div>
        </div>
        <div class="flex-none">
            <div class="inline-flex">
                {{-- <h4 class="marque-tag">{{ $product->getBrand()->title }}</h4> --}}
                @if($product->type == 1)
                    <h4 class="ml-1 other-tag">UGS: {{ $product->getUgs() }}</h4>
                @endif
            </div>
            <h2 class="mt-2">{{ $product->title }}</h2>
            <div class="inline-flex prices">
                @if(!auth()->guest() && auth()->user()->professionnal === 1 && auth()->user()->verified === 1 && $my_setting->professionnal_prices === 1)
                    {{-- Si le produit est en promotion et que l'option mes tarifs est activée --}}
                    @if($promotion)
                        @php
                            $discountAmountPro = $product->getPriceWithDiscount() * ($promotion->discount / 100);
                            $newPricePro = $product->getPriceWithDiscount() - $discountAmountPro;
                        @endphp
                        <div class="flex items-center gap-2">
                            <h3 class="text-[30px] font-semibold text-red-500">{{ number_format($newPricePro, 2, ',', ' ') }} €</h3>
                            <p class="text-sm text-gray-400 line-through">{{ number_format($product->getPriceWithDiscount(), 2, ',', ' ') }} €</p>
                        </div>
                    @else
                        <h3>{{ number_format($product->getPriceWithDiscount(), '2', ',', ' ') }} €</h3>
                        @if(number_format($product->getCustomerDiscount(), '0', ',', ' ') != 0)
                            <p class="text-sm text-gray-400">HT (-{{ number_format($product->getCustomerDiscount(), '0', ',', ' ') }} %)</p>
                        @endif
                    @endif
                @else
                    @if($promotion)
                        @php
                            $discountAmount = $product->getPriceTTC() * ($promotion->discount / 100);
                            $newPrice = $product->getPriceTTC() - $discountAmount;
                        @endphp

                        <div class="flex items-center gap-2">
                            <h3 class="text-[30px] font-semibold text-red-500">{{ number_format($newPrice, 2, ',', ' ') }} €</h3>
                            <p class="text-sm text-gray-400 line-through">{{ number_format($product->getPriceTTC(), 2, ',', ' ') }} €</p>
                        </div>
                        <p class="text-sm text-gray-400">TTC</p>
                    @else
                        <h3>{{ number_format($product->getPriceTTC(), '2', ',', ' ') }} €</h3>
                        <p class="text-sm text-gray-400">TTC</p>
                    @endif
                @endif
            </div>
            @if(!auth()->guest() && auth()->user()->professionnal === 1 && auth()->user()->verified === 1 && $setting->prices_type === 1 && $my_setting->professionnal_prices === 1)
                <div class="public-price">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <p>Prix public conseillé</p>
                        </div>
                        <div class="flex-none">
                            <h3>{{ number_format($product->getPriceTTC(), '2', ',', ' ') }} € (TTC)</h3>
                        </div>
                    </div>
                </div>
            @endif
            <div class="mt-3">
                <a href="{{ route('front.product', ['slug' => $product->slug]) }}" class="btn-secondary block text-center">En savoir plus</a>
            </div>
        </div>
    </div>
</div>
