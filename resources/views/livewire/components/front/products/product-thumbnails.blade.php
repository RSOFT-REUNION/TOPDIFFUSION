<div class="relative bg-slate-100 rounded-xl border overflow-hidden group hover:drop-shadow-2xl hover:scale-105 duration-300 hover:bg-white" role="button" data-href="{{ route('front.product', ['slug' => $product->slug]) }}">
    <div class="flex flex-col h-full">
        <div class="flex-1 p-2">
            <div class="flex">
                <div class="flex-none">
                    <div class="absolute top-5 left-0 group-hover:left-5 duration-300">
                        @if($product_stock == 0)
                            <p class="my-1 bg-red-400 font-bold py-2 px-5 rounded-r-full duration-300 group-hover:bg-white group-hover:border group-hover:border-red-400 group-hover:rounded-l-full group-hover:text-red-400">Rupture de stock</p>
                        @elseif($product_stock < 3 && $product_stock > 0)
                            <p class="my-1 bg-orange-400 font-bold py-2 px-5 rounded-r-full duration-300 group-hover:bg-white group-hover:border group-hover:border-orange-400 group-hover:rounded-l-full group-hover:text-orange-400">Plus que {{ $product_stock }} en stock</p>
                        @endif
                        @if ($promotion)
                            <p class="my-1 bg-amber-400 font-bold py-2 px-5 rounded-r-full duration-300 group-hover:bg-white group-hover:border group-hover:border-amber-400 group-hover:rounded-l-full group-hover:text-amber-400">Remise de {{ $this->promotion->discount }} %</p>
                        @endif
                    </div>
                </div>
                {{-- <div class="flex-grow"></div> --}}
                <div class="flex-none absolute right-5 top-10">
                    @if($isFavorite)
                        <a class="py-[14px] px-[16px] rounded-full duration-300 bg-[#ff253a20] hover:bg-gray-200 hover:text-black text-red-500" wire:click.stop="deleteFavorite({{ $product->id }})  "><i class="fa-solid fa-heart"></i></a>
                    @else
                        <a class="py-[14px] px-[16px] rounded-full duration-300  bg-gray-200 hover:text-red-500 hover:bg-[#ff253a20]" wire:click.stop="addProductToFavorite({{ $product->id }}) "><i class="fa-solid fa-heart"></i></a>
                    @endif
                </div>
            </div>
            <div class="force-center w-full">
                <img class="rounded-lg w-full" src="{{ asset('storage/images/products/'. $product->cover) }}">
            </div>
        </div>
        <div class="flex-none p-5 relative">
            <h2 class="font-bold text-xl text-slate-500">{{ $product->title }}</h2>
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
                        <h3 class="text-[30px] font-semibold">{{ number_format($product->getPriceWithDiscount(), '2', ',', ' ') }} €</h3>
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
                        <h3 class="text-[30px] font-semibold">{{ number_format($product->getPriceTTC(), '2', ',', ' ') }} €</h3>
                        <p class="text-sm text-gray-400 ml-2">TTC</p>
                    @endif
                @endif
            </div>
            <div class="absolute right-10 bottom-10 invisible group-hover:visible">
                <i class="fa-solid fa-arrow-right fa-2x text-slate-300"></i>
            </div>
        </div>
        @if(!auth()->guest() && auth()->user()->professionnal === 1 && auth()->user()->verified === 1 && $setting->prices_type === 1 && $my_setting->professionnal_prices === 1)
            <div class="flex-none border-t bg-amber-100 p-5">

                <div class="public-price">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <p class="text-amber-600">Prix public conseillé</p>
                        </div>
                        <div class="flex-none">
                            <h3 class="font-bold text-lg">{{ number_format($product->getPriceTTC(), '2', ',', ' ') }} € <span class="opacity-20">(TTC)</span></h3>
                        </div>
                    </div>
                </div>

            </div>
        @endif
    </div>
</div>
