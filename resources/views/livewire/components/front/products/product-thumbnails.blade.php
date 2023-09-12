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
                                @if ($category)
                                    <p class="tags bg-[#fbbc34] text-black">{{ $category->delivery }} %</p>
                                @endif
                            </div>
                        </div>
                        <div class="flex-grow"></div>
                        <div class="flex-none">
                            <a href="" class="py-[14px] px-[16px] rounded-full duration-300 @if($favoriteLike) bg-[#ff253a20] hover:bg-gray-200 hover:text-black text-red-500 @else bg-gray-200 hover:text-red-500 hover:bg-[#ff253a20] @endif" wire:click.stop="@if($favoriteLike) deleteFavorite({{ $product->id }}) @else addProductToFavorite({{ $product->id }}) @endif "><i class="fa-solid fa-heart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="force-center mb-5">
                <img src="{{ asset('storage/images/products/'. $product->cover) }}">
            </div>
        </div>
        <div class="flex-none">
            <div class="inline-flex">
                <h4 class="marque-tag">{{ $product->getBrand()->title }}</h4>
                @if($product->type == 1)
                    <h4 class="ml-1 other-tag">UGS: {{ $product->getUgs() }}</h4>
                @endif
            </div>
            <h2 class="mt-2">{{ $product->title }}</h2>
            <div class="inline-flex prices">
                @if(!auth()->guest() && auth()->user()->professionnal === 1 && auth()->user()->verified === 1 && $my_setting->professionnal_prices === 1)
                    <h3 class="items-center inline-flex">{{ number_format($product->getPriceProfessionnal(), '2', ',', ' ') }} € @if($product->multipleSwatch() == 1) <i class="fa-solid fa-circle-plus ml-3 text-amber-500 text-sm"></i> @endif</h3>
                @else
                    <h3>{{ number_format($product->getPriceCustomer(), '2', ',', ' ') }} €</h3>
                @endif
            </div>
            @if(!auth()->guest() && auth()->user()->professionnal === 1 && auth()->user()->verified === 1 && $setting->prices_type === 1 && $my_setting->professionnal_prices === 1)
                <div class="public-price">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <p>Prix public conseillé</p>
                        </div>
                        <div class="flex-none">
                            <h3>{{ number_format($product->getPriceCustomer(), '2', ',', ' ') }} €</h3>
                        </div>
                    </div>
                </div>
            @endif
            <div class="mt-3">
                <a href="" class="btn-secondary block text-center">Ajouter au panier</a>
            </div>
        </div>
    </div>
</div>
