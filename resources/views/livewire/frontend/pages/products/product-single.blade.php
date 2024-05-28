<div class="container mx-auto my-10">
    <div class="flex items-center gap-10">
        <div class="flex-1">
            <div class="bg-slate-100 rounded-xl overflow-hidden aspect-square">
                @if($product->cover)

                @else
                    <div class="flex h-full">
                        <div class="m-auto">
                            <i class="fa-solid fa-image-slash fa-3x text-gray-300"></i>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="flex-1">
            <div class="inline-flex items-center w-full justify-between">
                <div>
                    <h1 class="font-title font-bold text-xl">{{ $product->name }}</h1>
                    <h2 class="text-primary font-bold font-title mt-2 text-2xl">{{ number_format($product->getUnitPrice(), 2, ',', ' ') }} €</h2>
                </div>
                <a href="" class=""><i class="fa-regular fa-heart"></i></a>
            </div>
            <hr class="my-5">
            <p class="text-slate-400">{{ $product->description }}</p>
            @if($product->type == 'variable')
                <hr class="my-5">

                {{-- Couleurs --}}
                <div class="inline-flex items-center w-full rounded-lg divide-x bg-slate-100 border">
                    <p class="py-2 px-4">Couleurs</p>
                    <div class="py-2 px-4 inline-flex items-center gap-3">
                        @foreach($product_data->unique('color_name') as $data)
                            @if($data->color_name != null)
                                <div wire:click="selectColor('{{ $data->color }}')" title="{{ $data->color_name }}" aria-label="{{ $data->color_name }}"
                                     class="w-5 h-5 cursor-pointer hover:ring-1 hover:ring-offset-2 rounded-full {{ $selectedColor == $data->color ? 'border-2 border-primary' : '' }}"
                                     style="background-color: {{ $data->color }};">
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                {{-- Tailles --}}
                <div class="inline-flex items-center w-full rounded-lg divide-x bg-slate-100 border mt-3">
                    <p class="py-2 px-4">Tailles</p>
                    <div class="py-2 px-4 inline-flex items-center gap-3">
                        @foreach($product_data->where('color', $selectedColor)->unique('size_name') as $data)
                            @if($data->size != null)
                                <span wire:click="selectSize('{{ $data->size }}')"
                                      class="bg-white border rounded-full py-1 px-2 text-sm cursor-pointer hover:ring-1 hover:ring-offset-2 {{ $selectedSize == $data->size ? 'border-2 border-primary' : '' }} ">
                            {{ $data->size }}
                        </span>
                            @endif
                        @endforeach
                    </div>
                </div>
            @elseif($product->type == 'kit')
                <div class="mt-5 table-box-outline">
                    <table>
                        <thead>
                        <tr class="*:text-center">
                            @if($product->getKitElement() == 'chain')
                                <th>UGS</th>
                                <th>Pas</th>
                                <th>Longueur</th>
                                <th>Couleur</th>
                            @else
                                <th>UGS</th>
                                <th>Pas</th>
                                <th>Denture</th>
                                <th>Matière</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @if($product->getKitElement() == 'chain')
                                    <th>{{ $product->getChainInformations()['ugs'] }}</th>
                                    <th>{{ $product->getChainInformations()['pas'] }}</th>
                                    <th>{{ $product->getChainInformations()['longueur'] }}</th>
                                    <th>{{ $product->getChainInformations()['couleur'] }}</th>
                                @elseif($product->getKitElement() == 'pignon')
                                    <th>{{ $product->getPignonInformations()['ugs'] }}</th>
                                    <th>{{ $product->getPignonInformations()['pas'] }}</th>
                                    <th>{{ $product->getPignonInformations()['denture'] }}</th>
                                    <th>{{ $product->getPignonInformations()['matiere'] }}</th>
                                @else
                                    <th>{{ $product->getCrownInformations()['ugs'] }}</th>
                                    <th>{{ $product->getCrownInformations()['pas'] }}</th>
                                    <th>{{ $product->getCrownInformations()['denture'] }}</th>
                                    <th>{{ $product->getCrownInformations()['matiere'] }}</th>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endif
            <hr class="my-5">
            @if($product->type == 'variable' && $selectedSize && $selectedColor)
                <div class="inline-flex items-center gap-3">
                    {{-- Sélecteur de quantité intelligent --}}
                    @if($product->getStockInformations() != 'rupture')
                        <div class="inline-flex items-center bg-slate-100 border rounded-lg overflow-hidden">
                            <button wire:click="minusQuantity" class="px-3 text-slate-400 hover:text-blue-500"><i class="fa-solid fa-minus"></i></button>
                            <p class="p-2 font-title">{{ $quantity }}</p>
                            <button wire:click="plusQuantity" class="px-3 text-slate-400 hover:text-blue-500"><i class="fa-solid fa-plus"></i></button>
                        </div>
                        <button wire:click="addToCart" class="btn-primary"><i class="fa-regular fa-cart-shopping mr-3"></i>Ajouter au panier</button>
                        @if($product->getStockInformations() == 'faible')
                            <span class="text-amber-500"><i class="fa-solid fa-circle-info mr-3"></i>Il en reste plus que {{ $product->getStock()->quantity }}</span>
                        @endif
                    @else
                        <p class="text-red-500"><i class="fa-solid fa-circle-exclamation mr-3"></i>Ce produit est en rupture de stock</p>
                    @endif
                </div>
            @elseif($product->type == 'simple' || $product->type == 'kit')
                <div class="inline-flex items-center gap-3">
                    {{-- Sélecteur de quantité intelligent --}}
                    @if($product->getStockInformations() != 'rupture')
                        <div class="inline-flex items-center bg-slate-100 border rounded-lg overflow-hidden">
                            <button wire:click="minusQuantity" class="px-3 text-slate-400 hover:text-blue-500"><i class="fa-solid fa-minus"></i></button>
                            <p class="p-2 font-title">{{ $quantity }}</p>
                            <button wire:click="plusQuantity" class="px-3 text-slate-400 hover:text-blue-500"><i class="fa-solid fa-plus"></i></button>
                        </div>
                        <button wire:click="addToCart" class="btn-primary"><i class="fa-regular fa-cart-shopping mr-3"></i>Ajouter au panier</button>
                        @if($product->getStockInformations() == 'faible')
                            <span class="text-amber-500"><i class="fa-solid fa-circle-info mr-3"></i>Il en reste plus que {{ $product->getStock()->quantity }}</span>
                        @endif
                    @else
                        <p class="text-red-500"><i class="fa-solid fa-circle-exclamation mr-3"></i>Ce produit est en rupture de stock</p>
                    @endif
                </div>
            @else
                <p class="text-slate-400 italic">Sélectionner des options</p>
            @endif
            <hr class="my-5">
            <ul class="text-slate-400">
                <li><b>Catégorie : </b><a href="" class="hover:text-blue-500 hover:underline underline-offset-4">{{ $product->getCategory()->name }}</a></li>
                <li><b>Marque : </b><a href="" class="hover:text-blue-500 hover:underline underline-offset-4">{{ $product->getBrand()->name }}</a></li>
                <li><b>Mots clés : </b>{{ $product->keywords }}</li>
            </ul>
        </div>
    </div>
</div>
