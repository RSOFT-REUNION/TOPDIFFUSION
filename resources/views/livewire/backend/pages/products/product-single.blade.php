<div>
    <div class="inline-flex items-center justify-between w-full">
        <a href="{{ route('bo.products.list') }}" class="btn-slate"><i class="fa-solid fa-arrow-left mr-3"></i>Retour à la liste</a>
    </div>
    <div class="flex items-start gap-5">
        <div class="flex-1">
            <h1 class="font-title font-bold text-2xl mt-5">{{ $product->name }}</h1>
            <p class="mt-5 text-slate-400">
                {{ $product->description }}
            </p>
            <div class="mt-5 grid grid-cols-3 gap-5">
                <div class="border rounded-xl hover:bg-slate-100 hover:scale-105 duration-300 group hover:drop-shadow-2xl cursor-pointer overflow-hidden">
                    <div class="inline-flex items-center justify-center gap-5 w-full p-5 bg-white">
                        <p class="text-xl font-title">{{ $product->getCategory()->name }}</p>
                    </div>
                    <div class="border-t bg-slate-100 p-3 text-center">
                        <p class="text-slate-400 text-sm">Catégorie produit</p>
                    </div>
                </div>
                <div class="border rounded-xl hover:bg-slate-100 hover:scale-105 duration-300 group hover:drop-shadow-2xl cursor-pointer overflow-hidden">
                    <div class="inline-flex items-center justify-center gap-5 w-full p-5 bg-white">
                        <p class="text-xl font-title">{{ $product->getBrand()->name }}</p>
                    </div>
                    <div class="border-t bg-slate-100 p-3 text-center">
                        <p class="text-slate-400 text-sm">Marque</p>
                    </div>
                </div>
                <div class="border rounded-xl hover:bg-slate-100 hover:scale-105 duration-300 group hover:drop-shadow-2xl cursor-pointer overflow-hidden">
                    <div class="inline-flex items-center justify-center gap-5 w-full p-5 bg-white">
                        <p class="text-xl font-title">{{ $stock }}</p>
                    </div>
                    <div class="border-t bg-slate-100 p-3 text-center">
                        <p class="text-slate-400 text-sm">Quantité en stock</p>
                    </div>
                </div>
            </div>
            @if($product->type == 'kit')
                <div class="mt-5">
                    <h2 class="font-title font-bold text-xl">Informations sur : {{ $product->getCategory()->name }}</h2>
                    <div class="table-box-outline mt-5">
                        <table>
                            <thead>
                            <tr>
                                <th>Code UGS</th>
                                <th>Pas</th>
                                @if($product->getKitElement() == 'chain')
                                    <th>Longueur</th>
                                    <th>Couleur</th>
                                @else
                                    <th>Denture</th>
                                    <th>Matière</th>
                                @endif
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="*:text-center">
                                <td>{{ $product_data->ugs_code }}</td>
                                <td>{{ $kit_info['pas'] }}</td>
                                @if($product->getKitElement() == 'chain')
                                    <td>{{ $kit_info['longueur'] }}</td>
                                    <td>{{ $kit_info['couleur'] }}</td>
                                @else
                                    <td>{{ $kit_info['denture'] }}</td>
                                    <td>{{ $kit_info['matiere'] }}</td>
                                @endif
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @elseif($product->type == 'variable')
                @if($variants->count() > 0)
                    <div class="mt-5">
                        <h2 class="font-title font-bold text-xl">Informations sur les variantes</h2>
                        <div class="table-box-outline mt-5">
                            <table>
                                <thead>
                                <tr>
                                    <th>UGS</th>
                                    <th>Couleur</th>
                                    <th>Taille</th>
                                    <th>Quantité en stock</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($variants as $variant)
                                    <tr class="group">
                                        <td class="border-r">{{ $variant->ugs_code}}/{{ $variant->ugs_code_variant }}</td>
                                        <td>
                                            <div class="inline-flex items-center gap-5">
                                                <div class="w-5 h-5 rounded-full ring-1" style="background-color: {{ $variant->color }}"></div>
                                                <p class="">{{ $variant->color_name }}</p>
                                            </div>
                                        </td>
                                        <td>{{ $variant->size }}</td>
                                        <td>{{ $variant->getStock() }}</td>
                                        <td><button wire:click="$dispatch('openModal', {component: 'backend.popups.product.edit-single-stock', arguments: { product_id: {{ $product->id }}, product_data: {{ $variant->id }} }})" class="hover:underline hover:text-blue-500">Modifier les stocks</button></td>
                                        <td><button wire:click="deleteVariant({{ $variant->id }})" class="text-red-500 group-hover:visible invisible cursor-pointer"><i class="fa-regular fa-delete-left"></i></button></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            @endif
            @if($informations->count() > 0)
                <div class="mt-5">
                    <h2 class="font-title font-bold text-xl">Informations sur le produit</h2>
                    <div class="table-box-outline mt-5">
                        <table>
                            <thead>
                            <tr>
                                <th>Clé</th>
                                <th>Valeur</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($informations as $info)
                                <tr class="group">
                                    <td class="border-r">{{ $info->key}}</td>
                                    <td>{{ $info->value }}</td>
                                    <td><button wire:click="deleteInfo({{ $info->id }})" class="text-red-500 group-hover:visible invisible cursor-pointer"><i class="fa-regular fa-delete-left"></i></button></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
            @if($bikes->count() > 0)
                <div class="mt-5">
                    <h2 class="font-title font-bold text-xl">Liste des motos compatible</h2>
                    <div class="table-box-outline mt-5">
                        <table>
                            <thead>
                            <tr>
                                <th>Marque</th>
                                <th>Modèle</th>
                                <th>Cylindrée</th>
                                <th>Année</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bikes as $bike)
                                <tr class="group">
                                    <td>{{ $bike->getBike()->brand }}</td>
                                    <td>{{ $bike->getBike()->model }}</td>
                                    <td>{{ $bike->getBike()->cylinder }}</td>
                                    <td>{{ $bike->getBike()->year }}</td>
                                    <td><button wire:click="deleteBike({{ $bike->id }})" class="text-red-500 group-hover:visible invisible cursor-pointer"><i class="fa-regular fa-delete-left"></i></button></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
        <div class="flex-none w-[300px] border-l pl-5">
            <div class="mb-5 aspect-square bg-slate-100 rounded-xl p-5">
                <img src="{{ asset('storage/products/covers/'. $product->cover) }}">
            </div>
            <div>
                <p class="text-slate-400">Montant HT</p>
                <h2 class="font-title font-bold text-2xl">{{ number_format($product->getUnitPriceBack(), 2, ',', ' ') }} €</h2>
            </div>
            <div class="mt-5">
                <p class="text-slate-400">Montant TTC (TVA à 8,5%)</p>
                <h2 class="font-title font-bold text-2xl">{{ number_format($product->getUnitPriceTVABack(), 2, ',', ' ') }} €</h2>
            </div>
            <div class="border-t pt-5 mt-5">
                <button wire:click="$dispatch('openModal', {component: 'backend.popups.product.edit-product', arguments: { product_id: {{ $product->id }} }})" class="btn-slate w-full"><i class="fa-regular fa-pen-to-square mr-3"></i>Modifier le produit</button>
                {{--<button class="btn-slate w-full mt-2">Ajouter une moto compatible</button>
                <button class="btn-slate w-full mt-2">Ajouter une informations</button>
                <button class="btn-slate w-full mt-2">Modifier la catégorie</button>
                <button class="btn-slate w-full mt-2">Modifier la marque</button>--}}
                @if($product->type != 'variable')
                    <button wire:click="$dispatch('openModal', {component: 'backend.popups.product.edit-single-stock', arguments: { product_id: {{ $product->id }}, product_data: {{ $product_data->id }} }})" class="btn-slate w-full mt-2"><i class="fa-regular fa-boxes-packing mr-3"></i>Modifier les stocks</button>
                @endif
                <button wire:click="deleteProduct" class="btn-danger w-full mt-2"><i class="fa-regular fa-trash mr-3"></i>Supprimer le produit</button>
            </div>
        </div>
    </div>
</div>
