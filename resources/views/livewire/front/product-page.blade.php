<div>
    <div class="arianne my-4">
        {{-- <p><a href="{{ route('front.home') }}"><i class="fa-solid fa-house mr-2"></i>Accueil</a> / Produit</p> --}}
        @livewire('components.breadcrumb', ['crumbs' => $crumbs])
    </div>
    <div class="flex items-center my-10">
        <div class="flex-1 mr-2">
            <div class="product-images">
                <!-- Carousel -->
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
                                    @if ($category)
                                        <p class="inline-block marque-tag bg-[#fbbc34] font-bold text-black">{{ $category->delivery }} %</p>
                                    @endif
                                </div>
                                <img src="{{ asset('storage/images/products/'. $product->cover) }}">
                            </div>
                        </figure>
                    </li>
                    @foreach($product_pictures as $pictures)
                        <li class="carousel_slide">
                            <figure>
                                <div>
                                    <img src="{{ asset('storage/images/products_attachment/'. $pictures->picture_url) }}">
                                </div>
                            </figure>
                        </li>
                    @endforeach
                </ul>
                <ul class="carousel_thumbnails">
                    <li><label for="slide-1"><img src="{{ asset('storage/images/products/'. $product->cover) }}"></label></li>
                    @foreach($product_pictures as $pictures)
                        <li><label for="slide-{{ $pictures->id }}"><img src="{{ asset('storage/images/products_attachment/'. $pictures->picture_url) }}"></label></li>
                    @endforeach
                </ul>
            </div>
        </div>
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
                    <div class="product-swatch">
                        <ul>
                            @if($product->type == 3)
                                <li class="inline-flex items-center block w-full">
                                    <p>Chaine :</p>
                                    @foreach($product_swatches as $ps)
                                        @if(!in_array($ps->chain, $this->seenChainsValue))
                                            <span class="ml-2 btn-tag">{{ $ps->chain }}</span>
                                            @php
                                                $this->seenChainsValue[] = $ps->chain;
                                            @endphp
                                        @endif
                                    @endforeach
                                </li>
                                <li class="inline-flex items-center mt-3 block w-full">
                                    <p>Pas :</p>
                                    @foreach($product_swatches as $ps)
                                        @if(!in_array($ps->pas, $this->seenPasValue))
                                            <span class="ml-2 btn-tag">{{ $ps->pas }}</span>
                                            @php
                                                $this->seenPasValue[] = $ps->pas;
                                            @endphp
                                        @endif
                                    @endforeach
                                </li>
                                <li class="inline-flex items-center mt-3 block w-full">
                                    <p>Longeur :</p>
                                    @foreach($product_swatches as $ps)
                                        @if(!in_array($ps->width, $this->seenWidthValue))
                                            <span class="ml-2 btn-tag">{{ $ps->width }}</span>
                                            @php
                                                $this->seenWidthValue[] = $ps->width;
                                            @endphp
                                        @endif
                                    @endforeach
                                </li>
                                <li class="inline-flex items-center mt-3 block w-full">
                                    <p>Pignon :</p>
                                    @foreach($product_swatches as $ps)
                                        @if(!in_array($ps->pignon, $this->seenPignonValue))
                                            <span class="ml-2 btn-tag">{{ $ps->pignon }}</span>
                                            @php
                                                $this->seenPignonValue[] = $ps->pignon;
                                            @endphp
                                        @endif
                                    @endforeach
                                </li>
                                <li class="inline-flex items-center mt-3 block w-full">
                                    <p>Couronne :</p>
                                    @foreach($product_swatches as $ps)
                                        @if(!in_array($ps->crown, $this->seenCrownValue))
                                            <span class="ml-2 btn-tag">{{ $ps->crown }}</span>
                                            @php
                                                $this->seenCrownValue[] = $ps->crown;
                                            @endphp
                                        @endif
                                    @endforeach
                                </li>
                            @endif
                        </ul>

                    </div>
                @endif
                <div class="product-prices">
                    @if(!auth()->guest() && auth()->user()->professionnal === 1 && auth()->user()->verified === 1 && $my_setting->professionnal_prices === 1)
                        <h2>{{ number_format($product->getPriceProfessionnal(), '2', ',', ' ') }} €</h2>
                    @else
                        <h2>{{ number_format($product->getPriceCustomer(), '2', ',', ' ') }} €</h2>
                    @endif
                    @if(!auth()->guest() && auth()->user()->professionnal === 1 && auth()->user()->verified === 1 && $settings->prices_type === 1 && $my_setting->professionnal_prices === 1)
                        <p>Prix public conseillé: <b>{{ number_format($product->getPriceCustomer(), '2', ',', ' ') }} €</b> (-{{ $product->getPricePourcentage() }} %)</p>
                    @endif
                </div>
                <div class="product-buttons inline-flex items-center mt-3">
                    @if(!auth()->guest())
                    <input type="number" wire:model="quantity" min="1" class="py-2 w-12 text-xl mr-3 border-gray-600 border rounded-xl">
                    <input type="submit" class="btn-secondary" value="Ajouter au panier">
                    <a href="" class="py-[12px] px-[16px] rounded-full duration-300 ml-2 @if($favoriteLike) bg-[#ff253a20] hover:bg-gray-200 hover:text-black text-red-500 @else bg-gray-200 hover:text-red-500 hover:bg-[#ff253a20] @endif" wire:click="@if($favoriteLike) deleteFavorite({{ $product->id }}) @else addProductToFavorite({{ $product->id }}) @endif "><i class="fa-solid fa-heart"></i></a>
                    {{-- <a href="" class="btn-icon-favorite ml-2"><i class="fa-solid fa-heart"></i></a> --}}
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
                <a wire:click="changeTab('3')" class="@if($tab === '3') tab-active @else tab-desactive @endif">Liste des motos compatibles<i class="fa-solid fa-circle ml-2 text-red-500 text-sm"></i></a>
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
                <p class="text-red-500 bg-red-100 py-2 px-4 rounded-lg mb-3">
                    Votre moto <b>MOTO</b> n'est pas compatible avec cette pièce
                </p>
                <div class="table-box-outline">
                    <table>
                        <thead>
                        <tr>
                            <th>Marques</th>
                            <th>Cylindrées</th>
                            <th>Modèles</th>
                            <th>Années</th>
                        </tr>
                        </thead>
                        <tbody>
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
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
