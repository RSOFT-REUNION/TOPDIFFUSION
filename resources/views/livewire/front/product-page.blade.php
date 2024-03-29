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
                                    @if ($promotion)
                                        <p class="inline-block bg-[#fbbc34] font-[700] py-[5px] px-[7px] rounded-[5px] text-[14px] text-black">{{ $this->promotion->discount }} %</p>
                                    @endif
                                </div>
                                <img class="w-full rounded-lg" src="{{ asset('storage/images/products/'. $product->cover) }}" alt="image du produit">
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
            <form wire:submit.prevent="createCart" class="flex flex-col">
                @csrf
                <div class="inline-flex items-center gap-x-3">
                    <p class="marque-tag">{{ $product->getBrand()->title }}</p>
                </div>
                <div class="product-title">
                    <h1>{{ $product->title }}</h1>
                    <h3>Référence (UGS) : {{ $product->getUgs() }}</h3>
                </div>
                <div class="mt-5">
                    <p>
                        {{ $product->short_description }}
                    </p>
                </div>
                <div class="mt-7 border-b-2 border-dashed border-gray-500">
                    @if($product->type == 1)
                        {{-- S'il s'agit d'un produit simple --}}
                        @if(!auth()->guest() && auth()->user()->professionnal === 1 && auth()->user()->verified === 1 && $my_setting->professionnal_prices === 1)
                            {{-- Il s'agit d'un membre professionnel --}}
                            @if($promotion)
                                @php
                                    $discountAmountPro = $product->getPriceWithDiscount() * ($promotion->discount / 100);
                                    $newPricePro = $product->getPriceWithDiscount() - $discountAmountPro;
                                @endphp

                                <div class="flex items-center gap-2">
                                    <h3 class="text-[40px] font-bold text-red-500">{{ number_format($newPricePro, 2, ',', ' ') }} €</h3>
                                    <p class="text-sm text-gray-400 line-through">{{ number_format($product->getPriceWithDiscount(), 2, ',', ' ') }} €</p>
                                </div>
                                <p class="text-sm text-gray-400">HT</p>
                            @else
                                <h2 class="text-5xl font-bold block w-full text-secondary">{{ number_format($product->getPriceWithDiscount(), '2', ',', ' ') }} € <span class="text-sm text-gray-400">HT</span></h2>
                            @endif
                        @else
                            {{-- Il s'agit d'un membre particulier --}}
                            @if($promotion)
                                @php
                                    $discountAmount = $product->getPriceTTC() * ($promotion->discount / 100);
                                    $newPrice = $product->getPriceTTC() - $discountAmount;
                                @endphp

                                <div class="flex items-center gap-2">
                                    <h3 class="text-[40px] font-bold text-red-500">{{ number_format($newPrice, 2, ',', ' ') }} €</h3>
                                    <p class="text-sm text-gray-400 line-through">{{ number_format($product->getPriceTTC(), 2, ',', ' ') }} €</p>
                                </div>
                                <p class="text-sm text-gray-400">TTC</p>
                            @else
                                <h2 class="text-5xl font-bold block w-full text-secondary mb-2">{{ number_format($product->getPriceTTC(), '2', ',', ' ') }} € <span class="text-sm text-gray-400">TTC</span></h2>
                            @endif
                        @endif
                        @if(!auth()->guest() && auth()->user()->professionnal === 1 && auth()->user()->verified === 1 && $settings->prices_type === 1 && $my_setting->professionnal_prices === 1)
                            <p class="text-slate-400 mt-2">Prix public conseillé (TTC): <b>{{ number_format($product->getPriceTTC(), '2', ',', ' ') }} €</b> (-{{ number_format($product->getCustomerDiscount(), '0', ',', ' ') }} %)</p>
                        @endif
                    @elseif($product->type == 2)

                        {{-- S'il s'agit d'un produit variable --}}
                        <h2 class="mb-1 font-bold">Configurer votre produit</h2>
                        @foreach($product_group_tag as $group)
                            <div class="textfield-line_select mb-2">
                                <label for="{{ $group->title }}">{{ $group->title }}</label>
                                <select id="{{ $group->title }}" wire:model.live="declinaison_{{ $group->type }}">
                                    <option value="">-- Sélectionner une déclinaison --</option>
                                    @foreach($product_tag as $tag)
                                        <option value="{{ $group->id }}/{{ $tag->id }}">{{ $tag->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach

                        {{-- Affichage des tarifs --}}
                        @if($product_swatch != null)
                            @if(!auth()->guest() && auth()->user()->professionnal === 1 && auth()->user()->verified === 1 && $my_setting->professionnal_prices === 1)
                                {{-- S'il s'agit d'un membre professionnel --}}
                                @if($promotion)
                                    @php
                                        $discountAmountPro = $product->getPriceWithDiscount() * ($promotion->discount / 100);
                                        $newPricePro = $product->getPriceWithDiscount() - $discountAmountPro;
                                    @endphp

                                    <div class="flex items-center gap-2">
                                        <h3 class="text-[40px] font-bold text-red-500">{{ number_format($newPricePro, 2, ',', ' ') }} €</h3>
                                        <p class="text-sm text-gray-400 line-through">{{ number_format($product->getPriceWithDiscount(), 2, ',', ' ') }} €</p>
                                    </div>
                                    <p class="text-sm text-gray-400">HT</p>
                                @else
                                    <h2 class="mt-5 text-5xl font-bold block w-full text-secondary">{{ number_format($product->getPriceWithDiscount(), '2', ',', ' ') }} € <span class="text-sm text-gray-400">HT</span></h2>
                                @endif
                                @if(!auth()->guest() && auth()->user()->professionnal === 1 && auth()->user()->verified === 1 && $settings->prices_type === 1 && $my_setting->professionnal_prices === 1)
                                    <p class="text-slate-400 mt-2">Prix public conseillé (TTC): <b>{{ number_format($product->getPriceTTC(), '2', ',', ' ') }} €</b> (-{{ number_format($product->getCustomerDiscount(), '0', ',', ' ') }} %)</p>
                                @endif
                            @else
                                {{-- S'il s'agit d'un membre particulier --}}
                                @if($promotion)
                                    @php
                                        $discountAmount = $product->getPriceTTC() * ($promotion->discount / 100);
                                        $newPrice = $product->getPriceTTC() - $discountAmount;
                                    @endphp

                                    <div class="flex items-center gap-2">
                                        <h3 class="text-[40px] font-bold text-red-500">{{ number_format($newPrice, 2, ',', ' ') }} €</h3>
                                        <p class="text-sm text-gray-400 line-through">{{ number_format($product->getPriceTTC(), 2, ',', ' ') }} €</p>
                                    </div>
                                    <p class="text-sm text-gray-400">TTC</p>
                                @else
                                    <h2 class="text-5xl font-bold block w-full text-secondary mb-2">{{ number_format($product->getPriceTTC(), '2', ',', ' ') }} € <span class="text-sm text-gray-400">TTC</span></h2>
                                @endif
                            @endif
                        @endif
                    @elseif($product->type == 4)

                        {{-- S'il s'agit d'un pneu --}}
                        {{-- TODO: Pour le moment sous forme de tableau, il va falloir faire en sorte de pouvoir les sélectionner lorsqu'il y en a plusieurs --}}
                        <h2 class="mb-1 font-bold">Information sur le pneu</h2>
                        <div class="table-box-outline my-2">
                            <table>
                                <thead>
                                <tr>
                                    <th>Position</th>
                                    <th>Largeur</th>
                                    <th>Hauteur</th>
                                    <th>Diamètre</th>
                                    <th>Charge</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($product_swatches as $swatch)
                                        <tr>
                                            <td class="uppercase">{{ $swatch->tire_position }}</td>
                                            <td>{{ $swatch->tire_width }}</td>
                                            <td>{{ $swatch->tire_height }}</td>
                                            <td>{{ $swatch->tire_diameter }}</td>
                                            <td>{{ $swatch->tire_charge }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    @endif
                </div>

                {{-- Section des quantités et de la mise en panier --}}
                <div class="product-buttons inline-flex items-center mt-3 ">
                    @if(!auth()->guest())
                        @if($product->type == 2)
                            {{-- Si il s'agit d'un produit variable --}}
                            @if($product_swatch == null)
                                <p class="bg-slate-100 rounded-md py-2 px-3">Vous devez sélectionner une déclinaison pour pouvoir continuer</p>
                            @else
                                <div class="border border-gray-100 rounded-lg mr-3">
                                    <button wire:click="minusQuantity" type="button" class="pr-1 pl-2 hover:text-secondary"><i class="fa-solid fa-minus"></i></button>
                                    <input type="number" min="1" max="{{ $product_swatch->getSwatchStockQuantity() }}" value="{{ $quantity }}" wire:model="quantity" class="p-2 w-[50px] text-center font-bold text-xl appearance-none outline-none">
                                    @if($quantity < $product_swatch->getSwatchStockQuantity())
                                        <button wire:click="addQuantity" type="button" class="pl-1 pr-2 hover:text-secondary"><i class="fa-solid fa-plus"></i></button>
                                    @endif
                                </div>
                                <input type="submit" class="btn-secondary" value="Ajouter au panier">
                            @endif
                        @else
                            {{-- Si il s'agit d'un produit simple --}}
                            @if($product_stock == 0)
                                <div class="py-[10px] px-[15px] border border-solid border-gray-700 bg-gray-500 text-white rounded-[10px] duration-300 font-[600] cursor-not-allowed">Rupture de stock</div>
                            @else
                                <div class="border border-gray-100 rounded-lg mr-3">
                                    <button wire:click="minusQuantity" type="button" class="pr-1 pl-2 hover:text-secondary"><i class="fa-solid fa-minus"></i></button>
                                    <input type="number" min="1" max="" value="{{ $quantity }}" wire:model="quantity" class="p-2 w-[50px] text-center font-bold text-xl appearance-none outline-none">
                                    @if($quantity < $product_stock)
                                        <button wire:click="addQuantity" type="button" class="pl-1 pr-2 hover:text-secondary"><i class="fa-solid fa-plus"></i></button>
                                    @endif
                                </div>
                                <input type="submit" class="btn-secondary" value="Ajouter au panier">
                            @endif
                        @endif
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
                        <a href="{{ route('front.login') }}" class="btn-secondary">Se connecter</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- Tableau d'informations --}}
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
                        <thead>
                        <tr>
                            <th>Marque</th>
                            <th>Cylindrée</th>
                            <th>Modèle</th>
                            <th>Année</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($allCompatibleBike as $bike)
                                <tr>
                                    <td>{{ $bike->bike->marque }}</td>
                                    <td>{{ $bike->bike->cylindree }}</td>
                                    <td>{{ $bike->bike->modele }}</td>
                                    <td>{{ $bike->bike->annee }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
