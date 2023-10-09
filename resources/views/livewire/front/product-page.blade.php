<div>
    {{--<div class="arianne my-4">
        --}}{{-- <p><a href="{{ route('front.home') }}"><i class="fa-solid fa-house mr-2"></i>Accueil</a> / Produit</p> --}}{{--
        @livewire('components.breadcrumb', ['crumbs' => $crumbs])
    </div>--}}
    <div class="flex items-center my-10">
        <!-- Carousel -->
        <div class="flex-1 mr-2">
            <div class="product-images">
                <input type="radio" name="slides" checked="checked" id="slide-1">
                @foreach($product_pictures as $pictures)
                    <input type="radio" name="slides" id="slide-{{ $pictures->id }}">
                @endforeach

                <ul class="carousel_slides">
                    <li class="carousel_slide">
                        <figure>
                            <div>
                                <div class="absolute ml-2 mt-2 flex gap-x-3 h-8">
                                    @if($product_stock == 0)
                                        <p class="inline-block bg-red-500 stock-tag-off font-bold rounded-md text-white">Rupture de stock</p>
                                    @elseif($product_stock < 3 && $product_stock > 0)
                                        <p class="inline-block bg-orange-500 stock-tag-on text-white">Plus que {{ $product_stock }}</p>
                                    @endif
                                    {{--@if ($category)
                                        <p class="inline-block marque-tag bg-[#fbbc34] font-bold text-black">{{ $category->delivery }} %</p>
                                    @endif--}}
                                </div>
                                <img src="{{ asset('storage/images/products/'. $product->cover) }}" alt="image du produit">
                            </div>
                        </figure>
                    </li>
                    @foreach($product_pictures as $pictures)
                        <li class="carousel_slide">
                            <figure>
                                <div>
                                    <img src="{{ asset('storage/images/products_attachment/'. $pictures->picture_url) }}" alt="image du produit">
                                </div>
                            </figure>
                        </li>
                    @endforeach
                </ul>
                <ul class="carousel_thumbnails">
                    <li><label for="slide-1"><img src="{{ asset('storage/images/products/'. $product->cover) }}" alt="image du produit"></label></li>
                    @foreach($product_pictures as $pictures)
                        <li><label for="slide-{{ $pictures->id }}"><img src="{{ asset('storage/images/products_attachment/'. $pictures->picture_url) }}" alt="image du produit"></label></li>
                    @endforeach
                </ul>
            </div>
        </div>


        @if(count($images) > 1)
            <div class="relative" x-data="{ activeImage: @entangle('activeImage'), timer: null }" x-init="timer = setInterval(() => { activeImage = (activeImage + 1) % {{ count($images) }}; }, 3000);">

                <!-- Image principale -->
                <div class="w-full">
                    <img src="{{ $images[$activeImage] }}" alt="Image produit {{ $activeImage }}">
                </div>

                <!-- Miniatures -->
                <div class="flex space-x-2 mt-4">
                    @foreach($images as $index => $image)
                        <img
                            class="w-16 h-16 cursor-pointer border-2 {{ $activeImage === $index ? 'border-blue-500' : 'border-transparent' }}"
                            src="{{ $image }}"
                            alt="Miniature produit {{ $index }}"
                            @click="activeImage = {{ $index }}; clearTimeout(timer); timer = setInterval(() => { activeImage = (activeImage + 1) % {{ count($images) }}; }, 3000);"
                        >
                    @endforeach
                </div>

            </div>
            @endif

        {{-- fin crousel --}}
        <div class="flex-1 ml-2">
            <form wire:submit.prevent="createCart">
                @csrf
                <div class="inline-flex items-center gap-x-3">
                    <p class="marque-tag">{{ $product->getBrand()->title }}</p>
                    {{-- @if ($category)
                        <p class="marque-tag bg-[#fbbc34] text-black">{{ $category->delivery }} %</p>
                    @endif --}}
                    {{-- @if($product_infos->count() > 0)
                        @foreach($product_infos as $info)
                            @if($info->title == 'POS')
                                <p class="ml-1 other-tag">{{ $info->value }}</p>
                            @endif
                        @endforeach
                    @endif --}}
                </div>
                <div class="product-title">
                    <h1>{{ $product->title }}</h1>
                    <h3>Référence (UGS) : {{ $product->getUgs() }}</h3>
                </div>
                <div class="product-desc mt-5">
                    <p>
                        {{ $product->short_description }}
                    </p>
                </div>
                @if($product->type != 1)
                    <div class="product-swatch mt-5 border-2 border-gray-100 rounded-lg">
                        <ul>
                            <li>
                                @if($product->type != 1) {{-- Si il s'agit d'un kit chaine --}}
                                    <div class="inline-flex items-center justify-between w-full px-5 py-3">
                                        <label class="text-gray-500 text-sm" for="config_swatch">Sélectionner une configuration:</label>
                                        <select id="config_swatch" name="config_swatch" wire:model="config_swatch" class="width-300 pr-2 outline-none text-right">
                                            <option value="">Liste des configurations</option>
                                            @foreach($product_swatches as $index => $swatch)
                                                <option value="{{ $swatch->id }}">Configuration {{ $index + 1 }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if($config_swatch != null)
                                        @if($product->type === 3 )
                                            <div class="inline-flex items-center justify-between w-full border-t-2 border-gray-100 px-5 py-3">
                                                <label for="" class="text-gray-500 text-sm">CHAINE sélectionnée :</label>
                                                <p class="font-bold">{{ $swatch_info->chain }}</p>
                                            </div>
                                            <div class="inline-flex items-center justify-between w-full border-t-2 border-gray-100 px-5 py-3">
                                                <label for="" class="text-gray-500 text-sm">PAS sélectionnée :</label>
                                                <p class="font-bold">{{ $swatch_info->pas }}</p>
                                            </div>
                                            <div class="inline-flex items-center justify-between w-full border-t-2 border-gray-100 px-5 py-3">
                                                <label for="" class="text-gray-500 text-sm">LONGUEUR sélectionnée :</label>
                                                <p class="font-bold">{{ $swatch_info->width }}</p>
                                            </div>
                                            <div class="inline-flex items-center justify-between w-full border-t-2 border-gray-100 px-5 py-3">
                                                <label for="" class="text-gray-500 text-sm">PIGNON sélectionné :</label>
                                                <p class="font-bold">{{ $swatch_info->pignon }}</p>
                                            </div>
                                            <div class="inline-flex items-center justify-between w-full border-t-2 border-gray-100 px-5 py-3">
                                                <label for="" class="text-gray-500 text-sm">COURONNE sélectionnée :</label>
                                                <p class="font-bold">{{ $swatch_info->crown }}</p>
                                            </div>
                                        @elseif($product->type === 2)
                                            <div class="inline-flex items-center justify-between w-full border-t-2 border-gray-100 px-5 py-3">
                                                <label for="" class="text-gray-500 text-sm">{{ $swatch_info->getVariablesGroup()->title }} sélectionnée:</label>
                                                <p class="font-bold">{{ $swatch_info->getVariablesItem()->title }}</p>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                            </li>
                        </ul>

                    </div>
                @endif
                <div class="product-prices">
                    @if($product->type == 1)
                        @if(!auth()->guest() && auth()->user()->professionnal === 1 && auth()->user()->verified === 1 && $my_setting->professionnal_prices === 1)
                            <h2>{{ number_format($product->getPriceWithDiscount(), '2', ',', ' ') }} €</h2>
                        @else
                            <h2>{{ number_format($product->getPriceTTC(), '2', ',', ' ') }} €</h2>
                        @endif
                        @if(!auth()->guest() && auth()->user()->professionnal === 1 && auth()->user()->verified === 1 && $settings->prices_type === 1 && $my_setting->professionnal_prices === 1)
                            <p>Prix public conseillé: <b>{{ number_format($product->getPriceTTC(), '2', ',', ' ') }} €</b> (-{{ number_format($product->getCustomerDiscount(), '0', ',', ' ') }} %)</p>
                        @endif
                    @else
                        @if($config_swatch)
                            @if(!auth()->guest() && auth()->user()->professionnal === 1 && auth()->user()->verified === 1 && $my_setting->professionnal_prices === 1)
                                <h2>{{ $swatch_info->getPriceProfessionnal() }} €</h2>
                            @else
                                <h2>{{ $swatch_info->getPriceCustomer() }} €</h2>
                            @endif
                            @if(!auth()->guest() && auth()->user()->professionnal === 1 && auth()->user()->verified === 1 && $settings->prices_type === 1 && $my_setting->professionnal_prices === 1)
                                <p>Prix public conseillé: <b>{{ $swatch_info->getPriceCustomer() }} €</b> (-{{ $product->getPricePourcentage() }} %)</p>
                            @endif
                        @else
                            @if(!auth()->guest() && auth()->user()->professionnal === 1 && auth()->user()->verified === 1 && $my_setting->professionnal_prices === 1)
                                <h2>{{ number_format($product->getPriceProfessionnal(), '2', ',', ' ') }} €</h2>
                            @else
                                <h2>{{ number_format($product->getPriceCustomer(), '2', ',', ' ') }} €</h2>
                            @endif
                        @endif
                    @endif
                </div>
                <div class="product-buttons inline-flex items-center mt-3">
                    @if(!auth()->guest())
                        @if($product->type != 1 && $config_swatch)
                            <div class="border border-gray-100 rounded-lg mr-3">
                                <button wire:click="minusQuantity" type="button" class="pr-1 pl-2 hover:text-secondary"><i class="fa-solid fa-minus"></i></button>
                                <input type="number" min="1" max="" value="{{ $quantity }}" wire:model="quantity" class="p-2 w-[50px] text-center font-bold text-xl appearance-none outline-none">
                                <button wire:click="addQuantity" type="button" class="pl-1 pr-2 hover:text-secondary"><i class="fa-solid fa-plus"></i></button>
                            </div>

                            <input type="submit" class="btn-secondary" value="Ajouter au panier">
                            <a href="" class="py-[12px] px-[16px] rounded-full duration-300 ml-2 @if($favoriteLike) bg-[#ff253a20] hover:bg-gray-200 hover:text-black text-red-500 @else bg-gray-200 hover:text-red-500 hover:bg-[#ff253a20] @endif" wire:click="@if($favoriteLike) deleteFavorite({{ $product->id }}) @else addProductToFavorite({{ $product->id }}) @endif "><i class="fa-solid fa-heart"></i></a>
                        @elseif($product->type == 1)
                            <div class="border border-gray-100 rounded-lg mr-3">
                                <button wire:click="minusQuantity" type="button" class="pr-1 pl-2 hover:text-secondary"><i class="fa-solid fa-minus"></i></button>
                                <input type="number" min="1" max="" value="{{ $quantity }}" wire:model="quantity" class="p-2 w-[50px] text-center font-bold text-xl appearance-none outline-none">
                                <button wire:click="addQuantity" type="button" class="pl-1 pr-2 hover:text-secondary"><i class="fa-solid fa-plus"></i></button>
                            </div>

                            <input type="submit" class="btn-secondary" value="Ajouter au panier">
                            <a href="" class="py-[12px] px-[16px] rounded-full duration-300 ml-2 @if($favoriteLike) bg-[#ff253a20] hover:bg-gray-200 hover:text-black text-red-500 @else bg-gray-200 hover:text-red-500 hover:bg-[#ff253a20] @endif" wire:click="@if($favoriteLike) deleteFavorite({{ $product->id }}) @else addProductToFavorite({{ $product->id }}) @endif "><i class="fa-solid fa-heart"></i></a>
                        @else
                            <p class="empty-text">Vous devez sélectionner une configuration pour continuer</p>
                        @endif
                    @else
                        <a href="{{ route('front.login') }}" class="btn-secondary">Se connecter</a>
                    @endif
                </div>
            </form>
        </div>
    </div>
    <div class="product-infos mb-10">
        <div class="entry-nav inline-flex items-center">
            <a wire:click="changeTab('1')" class="@if($tab === '1') tab-active @else tab-desactive @endif">Description</a>
            <a wire:click="changeTab('2')" class="@if($tab === '2') tab-active @else tab-desactive @endif">Informations complèmentaires</a>
            @if($settings->bikes_compatibility == 1)
                <a wire:click="changeTab('3')" class="@if($tab === '3') tab-active @else tab-desactive @endif">Liste des motos compatibles<i class="fa-solid fa-circle ml-2 @if (!$userBikeCompatible) text-red-500 @else text-green-500 @endif text-sm"></i></a>
            @endif
        </div>
        <div class="entry-content">
            @if($tab === '1')
                @if($product->long_description)
                    <p>
                        {{ $product->long_description }}
                    </p>
                @else
                    <p>
                        Aucune description fournie
                    </p>
                @endif
            @elseif($tab === '2')
                <ul>
                    <li><b>UGS : </b>{{ $product->getUgs() }}</li>
                    <li><b>Catégories : </b>{{ $product->getCategory()->title }}</li>
                    <li><b>Marque : </b>{{ $product->getBrand()->title }}</li>
                    @if($product_infos->count() > 0)
                        @foreach($product_infos as $info)
                            @if($info->title == 'POS')
                                <li><b>Position : </b>{{ $info->value }}</li>
                            @elseif($info->title == 'REF')
                                <li><b>Référence : </b>{{ $info->value }}</li>
                            @else
                                <li><b>{{ $info->title }} : </b>{{ $info->value }}</li>
                            @endif
                        @endforeach
                    @endif
                </ul>
            @elseif($tab === '3' && $settings->bikes_compatibility == 1)
                @if (!$userBikeCompatible)
                    <p class="text-red-500 bg-red-100 py-2 px-4 rounded-lg mb-3">
                        Votre moto <b>MOTO</b> n'est pas compatible avec cette pièce
                    </p>
                @else
                    <p class="text-gree-500 bg-green-100 py-2 px-4 rounded-lg mb-3">
                        Votre moto <b>MOTO</b> est compatible avec cette pièce
                    </p>
                @endif
                <div class="table-box-outline">
                    <table>
                        @foreach ($allCompatibleBike as $bike)
                            <thead>
                            <tr>
                                <th>{{ $bike->bike->marque }}</th>
                                <th>{{ $bike->bike->cylindree }}</th>
                                <th>{{ $bike->bike->modele }}</th>
                                <th>{{ $bike->bike->annee }}</th>
                            </tr>
                            </thead>
                            {{-- <tbody>
                            <tr>
                                <td>KYMCO</td>
                                <td>50</td>
                                <td>GRAND DINK 50</td>
                                <td>2004</td>
                            </tr>
                            <tr>
                                <td>KYMCO</td>
                                <td>50</td>
                                <td>GRAND DINK 50</td>
                                <td>2004</td>
                            </tr>
                            <tr>
                                <td>KYMCO</td>
                                <td>50</td>
                                <td>GRAND DINK 50</td>
                                <td>2004</td>
                            </tr>
                            </tbody> --}}
                        @endforeach
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
