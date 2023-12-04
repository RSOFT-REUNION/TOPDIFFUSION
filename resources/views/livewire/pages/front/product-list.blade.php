<div class="container mx-auto" x-data="{ open: false }" @click.away="open = false">
    <div class="arianne my-4 inline-flex items-center">
        @livewire('components.breadcrumb', ['crumbs' => $crumbs])
    </div>
    <div class="entry-header mt-5" @click.away="open = false">
        <div class="flex items-center">
            <div class="flex-1">
                <h1>{{ $category->title }}</h1>
            </div>
            <div class="flex-none inline-flex items-center">
                @if($products->count() > 0)
                    <a @click.stop="open = !open" class="btn-secondary cursor-pointer">
                        <i class="fa-solid fa-filter mr-3"></i>Filtrer
                    </a>
                    <p class="text-tag-count ml-2">{{ $products->count() }}</p>
                @endif
            </div>
        </div>
    </div>
{{--    <div class="flex flex-col gap-y-3">--}}
{{--        @foreach($motor_brands as $brand)--}}
{{--            <div class="flex flex-row gap-x-4">--}}
{{--                    <input wire:model="selectedBrands" type="checkbox" name="brand_id" value="{{$brand->id}}" id="{{$brand->id}}"> {{$brand->title}}--}}
{{--            </div>--}}
{{--        @endforeach--}}
{{--    </div>--}}
    <div class="content pb-10 relative" @click.away="open = false">
        @if($products->count() > 0)
            <div class="grid grid-cols-3 gap-10 mt-10">
                @foreach($products as $product)
{{--                    @livewire('components.front.products.product-thumbnails', ['product_id' => $product->id, 'key' => now()])--}}
                    <div class="item-thumbnail" role="button" data-href="{{ route('front.product', ['slug' => $product->slug]) }}">
                        <div class="flex flex-col h-full">
                            <div class="flex-1">
                                <div class="thunbnail-icons">
                                    <div class="content-icons">
                                        <div class="flex">
                                            <div class="flex-none">
                                                <div class="tags-group flex gap-x-3 ml-1">
                                                    @if($product->stock == 0)
                                                        <p class="tags bg-red-500 text-white">Rupture de stock</p>
                                                    @elseif($product->stock < 3 && $product->stock > 0)
                                                        <p class="tags bg-orange-500 text-white">Plus que {{ $product->stock }}</p>
                                                    @endif
                                                    {{--@if ($category)
                                                        <p class="tags bg-[#fbbc34] text-black">{{ $category->delivery }} %</p>
                                                    @endif--}}
                                                </div>
                                            </div>
                                            <div class="flex-grow"></div>
                                            <div class="flex-none">
                                                @if($myFavoriteProducts[$product->id])
                                                    <a class="py-[14px] px-[16px] rounded-full duration-300 bg-[#ff253a20] hover:bg-gray-200 hover:text-black text-red-500" wire:click.stop="deleteFavorite({{ $product->id }})  "><i class="fa-solid fa-heart"></i></a>
                                                @else
                                                    <a class="py-[14px] px-[16px] rounded-full duration-300  bg-gray-200 hover:text-red-500 hover:bg-[#ff253a20]" wire:click.stop="addProductToFavorite({{ $product->id }}) "><i class="fa-solid fa-heart"></i></a>
                                                @endif
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
                                        <h3>{{ number_format($product->getPriceWithDiscount(), '2', ',', ' ') }} €</h3>
                                        <p class="text-sm text-gray-400">HT (-{{ number_format($product->getCustomerDiscount(), '0', ',', ' ') }} %)</p>
                                    @else
                                        <h3>{{ number_format($product->getPriceTTC(), '2', ',', ' ') }} €</h3>
                                        <p class="text-sm text-gray-400">TTC</p>
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
                @endforeach
            </div>
            <div class="mt-5">
                {{ $products->links() }}
            </div>
        @else
            <div class="flex items-center">
                <div class="flex-1">
                    <div class="force-center">
                        <object data="{{ asset('img/icons/Empty-amico.svg') }}" width="400px"></object>
                    </div>
                </div>
                <div class="flex-1">
                    <h2 class="subtitle">Cette catégorie semble vide...</h2>
                    <p class="text-gray-500 mt-3">N'hésitez pas à nous contacter si vous souhaitez plus d'informations ou à parcourir nos autres catégories</p>
                </div>
            </div>
        @endif
        <div x-show="open"
             @click.stop
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="transform opacity-0 -translate-x-full"
             x-transition:enter-end="transform opacity-100 translate-x-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="transform opacity-100 translate-x-0"
             x-transition:leave-end="transform opacity-0 -translate-x-full"
             class="rounded-md w-96 p-7 absolute top-0 left-[-29px]">

            <div class="bg-gray-100 rounded-md w-96 p-7 absolute top-0">
                <h2 class="font-bold text-2xl mb-7">Filtre</h2>
{{--                <div>--}}
{{--                    <div class="flex flex-row items-center justify-between">--}}
{{--                        <h3 class="font-medium">Categories</h3>--}}
{{--                        <i class="fa-solid fa-caret-down"></i>--}}
{{--                    </div>--}}
{{--                    <div class="border-l ml-1 pl-5 mt-5 py-2">--}}
{{--                        <div class="flex flex-col gap-y-6">--}}
{{--                            <a class="flex justify-between cursor-pointer">Categories<span>41</span></a>--}}
{{--                            <a class="flex justify-between cursor-pointer">Categories<span>41</span></a>--}}
{{--                            <a class="flex justify-between cursor-pointer">Categories<span>41</span></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="mt-7">--}}
{{--                    <div class="flex flex-row items-center justify-between">--}}
{{--                        <h3 class="font-medium">Couleurs</h3>--}}
{{--                        <i class="fa-solid fa-caret-left"></i>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="mt-7">
                    <div class="flex flex-row items-center justify-between">
                        <h3 class="font-medium">Marque</h3>
                        <i class="fa-solid fa-caret-left"></i>
                    </div>
                    <div class="border-l ml-1 pl-5 mt-5 py-2">
                        <div class="flex flex-col gap-y-3">
                            @foreach($motor_brands as $brand)
                                <div class="flex flex-row gap-x-4">
                                    <input wire:model="selectedBrands" type="checkbox" name="brand_id" value="{{$brand->id}}" id="{{$brand->id}}"> {{$brand->title}}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="mt-7">
                    <div class="flex flex-row items-center justify-between">
                        <h3 class="font-medium">Disponibilité</h3>
                        <i class="fa-solid fa-caret-left"></i>
                    </div>
                    <div class="border-l ml-1 pl-5 mt-5 py-2">
                        <div class="flex flex-col gap-y-3">
                            <div class="flex flex-row gap-x-4">
                                <input type="checkbox" wire:model="stockStatus.En_stock" id="En_stock">
                                <label for="En_stock">En stock</label>
                            </div>
                            <div class="flex flex-row gap-x-4">
                                <input type="checkbox" wire:model="stockStatus.Stock_faible" id="Stock_faible">
                                <label for="Stock_faible">Stock faible</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-7">
                    <div class="flex flex-row items-center justify-between">
                        <h3 class="font-medium">Prix</h3>
                        <i class="fa-solid fa-caret-down"></i>
                    </div>
                    <div class="border-l ml-1 pl-5 mt-5 py-2">
                        <div class="flex flex-col gap-y-6">
                            <div class="flex flex-col justify-center gap-y-3">
                                <div class="flex flex-row gap-x-3">
                                    <input type="radio" wire:model="sortOrder" value="asc" id="croissant">
                                    <label for="croissant">Croissant</label>
                                </div>
                                <div class="flex flex-row gap-x-3">
                                    <input type="radio" wire:model="sortOrder" value="desc" id="decroissant">
                                    <label for="decroissant">Décroissant</label>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <h4>Entre :</h4>
                                <div class="flex flex-row items-center mt-5">
                                    <input wire:model="minPrice" class="w-full py-2 pl-5 rounded-lg" type="number" placeholder="Prix mini"><span class="ml-3">€</span>
                                    <span class="mx-4">ET</span>
                                    <input wire:model="maxPrice" class="w-full py-2 pl-5 rounded-lg" type="number" placeholder="Prix maxi"><span class="ml-3">€</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

