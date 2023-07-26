<div>
    <form wire:submit.prevent="create" enctype="multipart/form-data">
        @csrf
        <div id="entry-header" class="flex items-center">
            <div class="flex-1">
                <h1>Ajout d'un produit</h1>
            </div>
            <div class="flex-none inline-flex items-center">
                <button type="submit" class="btn-secondary">Publier l'article</button>
            </div>
        </div>

        <div class="entry-content">
            {{-- Titre de l'article --}}
            <div class="textfield">
                <label for="title">Nom<span class="text-red-500">*</span></label>
                <input type="text" id="title" wire:model="title" placeholder="Entrez le nom du produit" class="@if($errors->has('title')) input-error @endif" value="{{ old('title') }}">
                @if($errors->has('title'))
                    <p class="text-error">{{ $errors->first('title') }}</p>
                @endif
            </div>
            <p class="bg-gray-100 text-sm px-2 py-1 rounded-lg mt-2 text-gray-500">Affichage dans l'url: @if($this->title) <b><input class="rounded border border-gray-600 pl-2" wire:model="slug" type="text"></b> @else Entrez le nom du produit.. @endif</p>
            <hr class="my-3"/>
            <div class="flex mt-5">
                <div class="flex-1 mr-2">
                    {{-- Image du produit --}}
                    <div class="textfield">
                        <label for="cover">Image principal du produit</label>
                        <input type="file" id="cover" wire:model="cover" placeholder="Entrez le nom du produit" class="@if($errors->has('cover')) input-error @endif" value="{{ old('cover') }}">
                        @if($errors->has('cover'))
                            <p class="text-error">{{ $errors->first('cover') }}</p>
                        @endif
                    </div>
                    {{-- Catégorie principal --}}
                    <div class="textfield mt-2">
                        <label for="parent_category">Catégorie principal<span class="text-red-500">*</span></label>
                        <select wire:model="parent_category" id="parent_category" wire:change="updateelivery">
                            <option value="">-- Sélectionner une catégorie --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('long_description'))
                            <p class="text-error">{{ $errors->first('long_description') }}</p>
                        @endif
                        @if($delivery)
                            <span wire:change="delivery" class="bg-[#FBBC34] px-2 rounded-md text-black border font-semibold border-[#D9D9D9]">
                                @if ($delivery)
                                    {{ $delivery }}
                                @else
                                    0
                                @endif
                                %
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Image du produit --}}
                <div class="flex-none ml-2">
                    <div class="product_create_picture">
                        @if($cover)
                            <img src="{{ $cover->temporaryUrl() }}" class="rounded-lg">
                        @else
                            <i class="fa-regular fa-image fa-2x"></i>
                        @endif
                    </div>
                </div>
            </div>

            <hr class="my-3">

            <div class="textfield mt-2">
                <label for="type">Type de produit</label>
                <select wire:model="type" id="type" class="@if($errors->has('type')) input-error @endif">
                    <option value="">-- Sélectionner un type --</option>
                    <option value="1">Produit simple</option>
                    <option value="2">Produit variable</option>
                    <option value="3">Kit chaine</option>
                    <option value="4">Pneus</option>
                </select>
                @if($errors->has('type'))
                    <p class="text-error">{{ $errors->first('type') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="brand">Marque<span class="text-red-500">*</span></label>
                <select wire:model="brand" id="brand">
                    <option value="">-- Sélectionner une marque --</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                    @endforeach
                </select>
                @if($errors->has('long_description'))
                    <p class="text-error">{{ $errors->first('long_description') }}</p>
                @endif
            </div>
            <div class="flex mt-2">
                <div class="flex-1 mr-2">
                    <div class="textfield">
                        <label for="short_description">Description courte</label>
                        <textarea wire:model="short_description" id="short_description" placeholder="Entrez une description courte" class="@if($errors->has('short_description')) input-error @endif">{{ old('short_description') }}</textarea>
                        @if($errors->has('short_description'))
                            <p class="text-error">{{ $errors->first('short_description') }}</p>
                        @endif
                    </div>
                </div>
                <div class="flex-1 ml-2">
                    <div class="textfield">
                        <label for="long_description">Description complète</label>
                        <textarea wire:model="long_description" id="long_description" placeholder="Entrez une description complète" class="@if($errors->has('long_description')) input-error @endif">{{ old('long_description') }}</textarea>
                        @if($errors->has('long_description'))
                            <p class="text-error">{{ $errors->first('long_description') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="entry-content">
        <form wire:submit.prevent="createSwatch">
            @csrf
            <hr class="my-3">

            @if($type)
                @if($type == 1)
                    {{-- Produit simple --}}
                    <div class="textfield mt-2">
                        <label for="UGS">Numéro UGS<span class="text-red-500">*</span></label>
                        <input type="text" id="UGS" wire:model="UGS" placeholder="Entrez le numéro UGS de votre produit" class="@if($errors->has('UGS')) input-error @endif" value="{{ old('UGS') }}">
                        @if($errors->has('UGS'))
                            <p class="text-error">{{ $errors->first('UGS') }}</p>
                        @endif
                    </div>
                    <hr class="my-3">
                    <div class="flex">
                        <div class="flex-1 mr-2">
                            <div class="textfield">
                                <label for="customer_price">Tarif client (€)<span class="text-red-500">*</span></label>
                                <input type="number" min="0.01" step="any" id="customer_price" wire:model="customer_price" placeholder="Entrez un tarif pour les clients" class="@if($errors->has('customer_price')) input-error @endif currency" value="{{ old('customer_price') }}">
                                @if($errors->has('customer_price'))
                                    <p class="text-error">{{ $errors->first('customer_price') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="flex-1 mr-2 ml-2">
                            <div class="textfield">
                                <label for="professionnal_price">Tarif professionnel (€)<span class="text-red-500">*</span></label>
                                <input type="number" min="0.01" step="any" id="professionnal_price" wire:model="professionnal_price" placeholder="@if($professionnal_price) Tarif automatique : {{ $professionnal_price }} @else Entrez un tarif pour les professionnel @endif" class="@if($errors->has('professionnal_price')) input-error @endif currency" value="">
                                @if($errors->has('professionnal_price'))
                                    <p class="text-error">{{ $errors->first('professionnal_price') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="flex-1 ml-2">
                            <div class="textfield">
                                <label for="pourcentage_price">Pourcentage de remise (%)</label>
                                <input type="number" min="0.01" step="any" id="pourcentage_price" wire:model="pourcentage_price" placeholder="Entrez un %" class="@if($errors->has('pourcentage_price')) input-error @endif currency" value="{{ $pourcentage_price }}">
                                @if($errors->has('pourcentage_price'))
                                    <p class="text-error">{{ $errors->first('pourcentage_price') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if(!$TVA_None && $TVA_Custom)
                        <div class="textfield mt-2">
                            <label for="TVA_Class">Classe de TVA<span class="text-red-500">*</span></label>
                            <select wire:model="TVA_Class" id="TVA_Class">
                                <option value="">-- Sélectionner une classe --</option>
                                @foreach($TVAs as $TVA)
                                    <option value="{{ $TVA->id }}">[{{ $TVA->country_code }}] {{ $TVA->title }} - {{ $TVA->rate }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('long_description'))
                                <p class="text-error">{{ $errors->first('long_description') }}</p>
                            @endif
                        </div>
                    @endif
                    @if(!$TVA_None && !$TVA_Custom)
                        <div class="mt-2 px-3">
                            <input type="checkbox" wire:model="TVA_Custom" id="TVA_Custom">
                            <label for="TVA_Custom">Classe de TVA personnalisé</label>
                        </div>
                    @endif
                    <div class="mt-2 px-3">
                        <input type="checkbox" wire:model="TVA_None" id="TVA_None">
                        <label for="TVA_None">Aucune TVA pour cette article</label>
                    </div>
                @elseif($type == 2)
                    {{-- Produit variante --}}
                    <div class="flex items-center">
                        <div class="flex-1">
                            <h2 class="subtitle">Produit décliné</h2>
                        </div>
                        <div class="flex-none">
                            @if(!$showAddVariant)
                                <a wire:click="$toggle('showAddVariant')" class="btn-secondary mt-2 block cursor-pointer">Ajouter une déclinaison</a>
                            @endif
                        </div>
                    </div>
                    @if($showAddVariant)
                        <div class="rounded-lg bg-blue-100 px-3 py-2 block mt-2">
                            <p class="bg-blue-200 px-2 py-1 rounded-lg">Vous êtes sur le point de créer une déclinaison</p>
                            <div class="flex mt-2">
                                <div class="flex-1 mr-2">
                                    <div class="textfield-white">
                                        <label for="UGS">Numéro UGS<span class="text-red-500">*</span></label>
                                        <input type="text" id="UGS" wire:model="UGS" placeholder="Entrez le numéro UGS de votre produit" class="@if($errors->has('UGS')) input-error @endif" value="{{ old('UGS') }}">
                                        @if($errors->has('UGS'))
                                            <p class="text-error">{{ $errors->first('UGS') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-1 ml-2">
                                    <div class="textfield-white">
                                        <label for="UGS_swatch">Numéro UGS de la déclinaison<span class="text-red-500">*</span></label>
                                        <input type="text" id="UGS_swatch" wire:model="UGS_swatch" placeholder="Ajouter uniquement le UGS pour la déclinaison" class="@if($errors->has('UGS_swatch')) input-error @endif" value="{{ old('UGS_swatch') }}">
                                        @if($errors->has('UGS_swatch'))
                                            <p class="text-error">{{ $errors->first('UGS_swatch') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="flex mt-2">
                                <div class="flex-1 mr-2">
                                    <div class="textfield-white">
                                        <label for="swatch_group">Type de déclinaison<span class="text-red-500">*</span></label>
                                        <select wire:model="swatch_group" id="swatch_group">
                                            <option value="">-- Sélectionner un type --</option>
                                            @foreach($swatchGroup as $sw)
                                                @if($sw->hasOptions())
                                                    <option value="{{ $sw->id }}">{{ $sw->title }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if($errors->has('swatch_group'))
                                            <p class="text-error">{{ $errors->first('swatch_group') }}</p>
                                        @endif
                                    </div>
                                </div>
                                @if($swatch_group)
                                    <div class="flex-1 ml-2">

                                        <div class="textfield-white">
                                            <label for="swatch_value">Valeur<span class="text-red-500">*</span></label>
                                            <select wire:model="swatch_value" id="swatch_value">
                                                <option value="">-- Sélectionner une valeur --</option>
                                                @foreach($swatchValue as $sv)
                                                    @if($sv->group_id == $swatch_group)
                                                        <option value="{{ $sv->id }}">{{ $sv->key }} - {{ $sv->title }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @if($errors->has('swatch_value'))
                                                <p class="text-error">{{ $errors->first('swatch_value') }}</p>
                                            @endif
                                        </div>

                                    </div>
                                @endif
                            </div>
                            <div class="flex mt-3">
                                <div class="flex-1 mr-2">
                                    <div class="textfield-white">
                                        <label for="customer_price">Tarif client (€)<span class="text-red-500">*</span></label>
                                        <input type="number" min="0.01" step="any" id="customer_price" wire:model="customer_price" placeholder="Entrez un tarif pour les clients" class="@if($errors->has('customer_price')) input-error @endif currency" value="{{ old('customer_price') }}">
                                        @if($errors->has('customer_price'))
                                            <p class="text-error">{{ $errors->first('customer_price') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-1 mr-2 ml-2">
                                    <div class="textfield-white">
                                        <label for="professionnal_price">Tarif professionnel (€)<span class="text-red-500">*</span></label>
                                        <input type="number" min="0.01" step="any" id="professionnal_price" wire:model="professionnal_price" placeholder="@if($professionnal_price) Tarif automatique : {{ $professionnal_price }} @else Entrez un tarif pour les professionnel @endif" class="@if($errors->has('professionnal_price')) input-error @endif currency" value="">
                                        @if($errors->has('professionnal_price'))
                                            <p class="text-error">{{ $errors->first('professionnal_price') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-1 ml-2">
                                    <div class="textfield-white">
                                        <label for="pourcentage_price">Pourcentage de remise (%)</label>
                                        <input type="number" min="0.01" step="any" id="pourcentage_price" wire:model="pourcentage_price" placeholder="Entrez un %" class="@if($errors->has('pourcentage_price')) input-error @endif currency" value="{{ $pourcentage_price }}">
                                        @if($errors->has('pourcentage_price'))
                                            <p class="text-error">{{ $errors->first('pourcentage_price') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if(!$TVA_None && $TVA_Custom)
                                <div class="textfield mt-2">
                                    <label for="TVA_Class">Classe de TVA<span class="text-red-500">*</span></label>
                                    <select wire:model="TVA_Class" id="TVA_Class">
                                        <option value="">-- Sélectionner une classe --</option>
                                        @foreach($TVAs as $TVA)
                                            <option value="{{ $TVA->id }}">[{{ $TVA->country_code }}] {{ $TVA->title }} - {{ $TVA->rate }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('long_description'))
                                        <p class="text-error">{{ $errors->first('long_description') }}</p>
                                    @endif
                                </div>
                            @endif
                            @if(!$TVA_None && !$TVA_Custom)
                                <div class="mt-2 px-3">
                                    <input type="checkbox" wire:model="TVA_Custom" id="TVA_Custom">
                                    <label for="TVA_Custom">Classe de TVA personnalisé</label>
                                </div>
                            @endif
                            <div class="mt-2 px-3">
                                <input type="checkbox" wire:model="TVA_None" id="TVA_None">
                                <label for="TVA_None">Aucune TVA pour cette article</label>
                            </div>

                            <div class="mt-3 text-right">
                                <button type="submit" class="btn-secondary"><i class="fa-solid fa-floppy-disk mr-3"></i>Sauvegarder ma déclinaison</button>
                            </div>

                        </div>
                    @endif
                    @if($swatchTemp->count() > 0)
                        <div class="table-box-outline mt-2">
                            <table>
                                <thead>
                                <tr>
                                    <th>UGS</th>
                                    <th>Groupe de déclinaison</th>
                                    <th>Valeur de la déclinaison</th>
                                    <th>Prix public</th>
                                    <th>Prix pro.</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($swatchTemp as $swatch)
                                    <tr>
                                        <td>{{ $swatch->ugs }}/{{ $swatch->ugs_swatch }}</td>
                                        <td>{{ $swatch->getSwatchGroup() }}</td>
                                        <td>{{ $swatch->getSwatchTag() }}</td>
                                        <td>{{ number_format($swatch->customer_price, '2', ',', ' ') }}</td>
                                        <td>{{ number_format($swatch->professionnal_price, '2', ',', ' ') }}</td>
                                        <td><a wire:click="deleteSwatch({{ $swatch->id }})" class="hover:text-amber-500"><i class="fa-solid fa-trash"></i></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                @elseif($type == 3)
                    {{-- KIT CHAINES --}}
                    <div class="flex items-center">
                        <div class="flex-1">
                            <h2 class="subtitle">Kits chaines</h2>
                        </div>
                        <div class="flex-none">
                            @if(!$showAddKit)
                                <a wire:click="$toggle('showAddKit')" class="btn-secondary mt-2 block cursor-pointer">Ajouter un kit</a>
                            @else
                                <a wire:click="$toggle('showAddPicture')" class="btn-secondary cursor-pointer">Fermer</a>
                            @endif
                        </div>
                    </div>
                    @if($showAddKit)
                        <div class="rounded-lg bg-blue-100 px-3 py-2 block mt-2">
                            <p class="bg-blue-200 px-2 py-1 rounded-lg">Vous êtes sur le point d'ajouter de créer un kit chaine</p>
                            <div class="flex mt-2">
                                <div class="flex-1 mr-2">
                                    <div class="textfield-white">
                                        <label for="UGS">Numéro UGS<span class="text-red-500">*</span></label>
                                        <input type="text" id="UGS" wire:model="UGS" placeholder="Entrez le numéro UGS de votre produit" class="@if($errors->has('UGS')) input-error @endif" value="{{ old('UGS') }}">
                                        @if($errors->has('UGS'))
                                            <p class="text-error">{{ $errors->first('UGS') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-1 ml-2">
                                    <div class="textfield-white">
                                        <label for="UGS_swatch">Numéro UGS du Kit<span class="text-red-500">*</span></label>
                                        <input type="text" id="UGS_swatch" wire:model="UGS_swatch" placeholder="Ajouter uniquement le UGS pour le kit" class="@if($errors->has('UGS_swatch')) input-error @endif" value="{{ old('UGS_swatch') }}">
                                        @if($errors->has('UGS_swatch'))
                                            <p class="text-error">{{ $errors->first('UGS_swatch') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="textfield-white mt-2">
                                <label for="chain">Chaine<span class="text-red-500">*</span></label>
                                <input type="text" id="chain" wire:model="chain" placeholder="Entrez le nom de la chaine" class="@if($errors->has('chain')) input-error @endif" value="{{ old('chain') }}">
                                @if($errors->has('chain'))
                                    <p class="text-error">{{ $errors->first('chain') }}</p>
                                @endif
                            </div>
                            <div class="flex mt-2">
                                <div class="flex-1 border-r border-blue-200 px-2">
                                    <div class="textfield-white">
                                        <label for="pas">Pas<span class="text-red-500">*</span></label>
                                        <input type="text" id="pas" wire:model="pas" placeholder="Entrez le pas" class="@if($errors->has('pas')) input-error @endif" value="{{ old('pas') }}">
                                        @if($errors->has('pas'))
                                            <p class="text-error">{{ $errors->first('pas') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-1 border-r border-blue-200 px-2">
                                    <div class="textfield-white">
                                        <label for="width">Longueur<span class="text-red-500">*</span></label>
                                        <input type="text" id="width" wire:model="width" placeholder="Entrez la longueur" class="@if($errors->has('width')) input-error @endif" value="{{ old('width') }}">
                                        @if($errors->has('width'))
                                            <p class="text-error">{{ $errors->first('width') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-1 border-r border-blue-200 px-2">
                                    <div class="textfield-white">
                                        <label for="pignon">Pignon<span class="text-red-500">*</span></label>
                                        <input type="text" id="pignon" wire:model="pignon" placeholder="Entrez le pignon" class="@if($errors->has('pignon')) input-error @endif" value="{{ old('pignon') }}">
                                        @if($errors->has('pignon'))
                                            <p class="text-error">{{ $errors->first('pignon') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-1 border-r border-blue-200 px-2">
                                    <div class="textfield-white">
                                        <label for="crown">Couronne<span class="text-red-500">*</span></label>
                                        <input type="text" id="crown" wire:model="crown" placeholder="Entrez la couronne" class="@if($errors->has('crown')) input-error @endif" value="{{ old('crown') }}">
                                        @if($errors->has('crown'))
                                            <p class="text-error">{{ $errors->first('crown') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="flex mt-3">
                                <div class="flex-1 mr-2">
                                    <div class="textfield-white">
                                        <label for="customer_price">Tarif client (€)<span class="text-red-500">*</span></label>
                                        <input type="number" min="0.01" step="any" id="customer_price" wire:model="customer_price" placeholder="Entrez un tarif pour les clients" class="@if($errors->has('customer_price')) input-error @endif currency" value="{{ old('customer_price') }}">
                                        @if($errors->has('customer_price'))
                                            <p class="text-error">{{ $errors->first('customer_price') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-1 mr-2 ml-2">
                                    <div class="textfield-white">
                                        <label for="professionnal_price">Tarif professionnel (€)<span class="text-red-500">*</span></label>
                                        <input type="number" min="0.01" step="any" id="professionnal_price" wire:model="professionnal_price" placeholder="@if($professionnal_price) Tarif automatique : {{ $professionnal_price }} @else Entrez un tarif pour les professionnel @endif" class="@if($errors->has('professionnal_price')) input-error @endif currency" value="">
                                        @if($errors->has('professionnal_price'))
                                            <p class="text-error">{{ $errors->first('professionnal_price') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-1 ml-2">
                                    <div class="textfield-white">
                                        <label for="pourcentage_price">Pourcentage de remise (%)</label>
                                        <input type="number" min="0.01" step="any" id="pourcentage_price" wire:model="pourcentage_price" placeholder="Entrez un %" class="@if($errors->has('pourcentage_price')) input-error @endif currency" value="{{ $pourcentage_price }}">
                                        @if($errors->has('pourcentage_price'))
                                            <p class="text-error">{{ $errors->first('pourcentage_price') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if(!$TVA_None && $TVA_Custom)
                                <div class="textfield mt-2">
                                    <label for="TVA_Class">Classe de TVA<span class="text-red-500">*</span></label>
                                    <select wire:model="TVA_Class" id="TVA_Class">
                                        <option value="">-- Sélectionner une classe --</option>
                                        @foreach($TVAs as $TVA)
                                            <option value="{{ $TVA->id }}">[{{ $TVA->country_code }}] {{ $TVA->title }} - {{ $TVA->rate }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('long_description'))
                                        <p class="text-error">{{ $errors->first('long_description') }}</p>
                                    @endif
                                </div>
                            @endif
                            @if(!$TVA_None && !$TVA_Custom)
                                <div class="mt-2 px-3">
                                    <input type="checkbox" wire:model="TVA_Custom" id="TVA_Custom">
                                    <label for="TVA_Custom">Classe de TVA personnalisé</label>
                                </div>
                            @endif
                            <div class="mt-2 px-3">
                                <input type="checkbox" wire:model="TVA_None" id="TVA_None">
                                <label for="TVA_None">Aucune TVA pour cette article</label>
                            </div>

                            <div class="mt-3 text-right">
                                <button type="submit" class="btn-secondary"><i class="fa-solid fa-floppy-disk mr-3"></i>Sauvegarder mon kit</button>
                            </div>

                        </div>
                    @endif
                    @if($kitTemp->count() > 0)
                        <div class="mt-2 table-box-outline">
                            <table>
                                <thead>
                                <tr>
                                    <th>UGS</th>
                                    <th>Chaine</th>
                                    <th>Pas</th>
                                    <th>Longueur</th>
                                    <th>Pignon</th>
                                    <th>Couronne</th>
                                    <th>Prix public</th>
                                    <th>Prix pro.</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($kitTemp as $kit)
                                    @if($kit->type == 3)
                                        <tr>
                                            <td>{{ $kit->ugs }}/{{ $kit->ugs_swatch }}</td>
                                            <td>{{ $kit->chain }}</td>
                                            <td>{{ $kit->pas }}</td>
                                            <td>{{ $kit->width }}</td>
                                            <td>{{ $kit->pignon }}</td>
                                            <td>{{ $kit->crown }}</td>
                                            <td>{{ number_format($kit->customer_price, '2', ',', ' ') }}</td>
                                            <td>{{ number_format($kit->professionnal_price, '2', ',', ' ') }}</td>
                                            <td><a wire:click="deleteKit({{ $kit->id }})" class="hover:text-amber-500"><i class="fa-solid fa-trash"></i></a></td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                @elseif($type == 4)
                    {{-- PNEUS --}}
                    <div class="flex items-center">
                        <div class="flex-1">
                            <h2 class="subtitle">Pneus</h2>
                        </div>
                        <div class="flex-none">
                            @if(!$showAddTires)
                                <a wire:click="$toggle('showAddTires')" class="btn-secondary mt-2 block cursor-pointer">Ajouter un pneu</a>
                            @else
                                <a wire:click="$toggle('showAddPicture')" class="btn-secondary cursor-pointer">Fermer</a>
                            @endif
                        </div>
                    </div>
                    @if($showAddTires)
                        <div class="rounded-lg bg-blue-100 px-3 py-2 block mt-2">
                        <p class="bg-blue-200 px-2 py-1 rounded-lg">Vous êtes sur le point de créer un pneu</p>
                        <div class="flex mt-2">
                            <div class="flex-1 mr-2">
                                <div class="textfield-white">
                                    <label for="UGS">Numéro UGS<span class="text-red-500">*</span></label>
                                    <input type="text" id="UGS" wire:model="UGS" placeholder="Entrez le numéro UGS de votre produit" class="@if($errors->has('UGS')) input-error @endif" value="{{ old('UGS') }}">
                                    @if($errors->has('UGS'))
                                        <p class="text-error">{{ $errors->first('UGS') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex-1 ml-2">
                                <div class="textfield-white">
                                    <label for="UGS_swatch">Numéro UGS du pneu<span class="text-red-500">*</span></label>
                                    <input type="text" id="UGS_swatch" wire:model="UGS_swatch" placeholder="Ajouter uniquement le UGS pour le pneu" class="@if($errors->has('UGS_swatch')) input-error @endif" value="{{ old('UGS_swatch') }}">
                                    @if($errors->has('UGS_swatch'))
                                        <p class="text-error">{{ $errors->first('UGS_swatch') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="flex mt-2">
                            <div class="flex-1 border-r border-blue-200 px-2">
                                <div class="textfield-white">
                                    <label for="tire_width">Largeur<span class="text-red-500">*</span></label>
                                    <input type="text" id="tire_width" wire:model="tire_width" placeholder="Entrez la largeur" class="@if($errors->has('tire_width')) input-error @endif" value="{{ old('tire_width') }}">
                                    @if($errors->has('tire_width'))
                                        <p class="text-error">{{ $errors->first('tire_width') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex-1 border-r border-blue-200 px-2">
                                <div class="textfield-white">
                                    <label for="tire_height">Hauteur<span class="text-red-500">*</span></label>
                                    <input type="text" id="tire_height" wire:model="tire_height" placeholder="Entrez la hauteur" class="@if($errors->has('tire_height')) input-error @endif" value="{{ old('tire_height') }}">
                                    @if($errors->has('tire_height'))
                                        <p class="text-error">{{ $errors->first('tire_height') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex-1 border-r border-blue-200 px-2">
                                <div class="textfield-white">
                                    <label for="tire_diameter">Diamètre<span class="text-red-500">*</span></label>
                                    <input type="text" id="tire_diameter" wire:model="tire_diameter" placeholder="Entrez le diamètre" class="@if($errors->has('tire_diameter')) input-error @endif" value="{{ old('tire_diameter') }}">
                                    @if($errors->has('tire_diameter'))
                                        <p class="text-error">{{ $errors->first('tire_diameter') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex-1 px-2">
                                <div class="textfield-white">
                                    <label for="tire_charge">Indice de charge<span class="text-red-500">*</span></label>
                                    <input type="text" id="tire_charge" wire:model="tire_charge" placeholder="Entrez l'indice de charge" class="@if($errors->has('tire_charge')) input-error @endif" value="{{ old('tire_charge') }}">
                                    @if($errors->has('tire_charge'))
                                        <p class="text-error">{{ $errors->first('tire_charge') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="flex mt-3 border-t border-blue-200 pt-3">
                            <div class="flex-1 mr-2">
                                <div class="textfield-white">
                                    <label for="customer_price">Tarif client (€)<span class="text-red-500">*</span></label>
                                    <input type="number" min="0.01" step="any" id="customer_price" wire:model="customer_price" placeholder="Entrez un tarif pour les clients" class="@if($errors->has('customer_price')) input-error @endif currency" value="{{ old('customer_price') }}">
                                    @if($errors->has('customer_price'))
                                        <p class="text-error">{{ $errors->first('customer_price') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex-1 mr-2 ml-2">
                                <div class="textfield-white">
                                    <label for="professionnal_price">Tarif professionnel (€)<span class="text-red-500">*</span></label>
                                    <input type="number" min="0.01" step="any" id="professionnal_price" wire:model="professionnal_price" placeholder="@if($professionnal_price) Tarif automatique : {{ $professionnal_price }} @else Entrez un tarif pour les professionnel @endif" class="@if($errors->has('professionnal_price')) input-error @endif currency" value="">
                                    @if($errors->has('professionnal_price'))
                                        <p class="text-error">{{ $errors->first('professionnal_price') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex-1 ml-2">
                                <div class="textfield-white">
                                    <label for="pourcentage_price">Pourcentage de remise (%)</label>
                                    <input type="number" min="0.01" step="any" id="pourcentage_price" wire:model="pourcentage_price" placeholder="Entrez un %" class="@if($errors->has('pourcentage_price')) input-error @endif currency" value="{{ $pourcentage_price }}">
                                    @if($errors->has('pourcentage_price'))
                                        <p class="text-error">{{ $errors->first('pourcentage_price') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if(!$TVA_None && $TVA_Custom)
                            <div class="textfield mt-2">
                                <label for="TVA_Class">Classe de TVA<span class="text-red-500">*</span></label>
                                <select wire:model="TVA_Class" id="TVA_Class">
                                    <option value="">-- Sélectionner une classe --</option>
                                    @foreach($TVAs as $TVA)
                                        <option value="{{ $TVA->id }}">[{{ $TVA->country_code }}] {{ $TVA->title }} - {{ $TVA->rate }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('long_description'))
                                    <p class="text-error">{{ $errors->first('long_description') }}</p>
                                @endif
                            </div>
                        @endif
                        @if(!$TVA_None && !$TVA_Custom)
                            <div class="mt-2 px-3">
                                <input type="checkbox" wire:model="TVA_Custom" id="TVA_Custom">
                                <label for="TVA_Custom">Classe de TVA personnalisé</label>
                            </div>
                        @endif
                        <div class="mt-2 px-3">
                            <input type="checkbox" wire:model="TVA_None" id="TVA_None">
                            <label for="TVA_None">Aucune TVA pour cette article</label>
                        </div>

                        <div class="mt-3 text-right">
                            <button type="submit" class="btn-secondary"><i class="fa-solid fa-floppy-disk mr-3"></i>Sauvegarder mon pneu</button>
                        </div>
                    </div>
                    @endif
                    @if($tireTemp->count() > 0)
                        <div class="mt-2 table-box-outline">
                            <table>
                                <thead>
                                <tr>
                                    <th>UGS</th>
                                    <th>Largeur</th>
                                    <th>Hauteur</th>
                                    <th>Diamètre</th>
                                    <th>Charge</th>
                                    <th>Prix public</th>
                                    <th>Prix pro.</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tireTemp as $tire)
                                    <tr>
                                        <td>{{ $tire->ugs }}-{{ $tire->ugs_swatch }}</td>
                                        <td>{{ $tire->tire_width }}</td>
                                        <td>{{ $tire->tire_height }}</td>
                                        <td>{{ $tire->tire_diameter }}</td>
                                        <td>{{ $tire->tire_charge }}</td>
                                        <td>{{ number_format($tire->customer_price, '2', ',', ' ') }}</td>
                                        <td>{{ number_format($tire->professionnal_price, '2', ',', ' ') }}</td>
                                        <td><a wire:click="deleteTire({{ $tire->id }})" class="hover:text-amber-500"><i class="fa-solid fa-trash"></i></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                @endif
            @else
                <p class="empty-text mt-2">Veuillez sélectionner le type de produit pour accèder à cette section</p>
            @endif
        </form>

        <form wire:submit.prevent="addInformations">
            @csrf
            <hr class="my-3">

            <div class="mt-2 flex items-center">
                <div class="flex-1">
                    <h2 class="subtitle">Ajouter des informations sur le produit</h2>
                </div>
                <div class="flex-none">
                    @if(!$showAddTag)
                        <a wire:click="$toggle('showAddTag')" class="btn-secondary cursor-pointer">Ajouter</a>
                    @else
                        <a wire:click="$toggle('showAddTag')" class="btn-secondary cursor-pointer">Fermer</a>
                    @endif
                </div>
            </div>
            @if($showAddTag)
                <div class="rounded-lg bg-blue-100 px-3 py-2 block mt-2">
                <p class="bg-blue-200 px-2 py-1 rounded-lg">Vous êtes sur le point d'ajouter des informations personnalisé</p>
                <div class="flex mt-2">
                    <div class="flex-1 mr-2">
                        <div class="textfield-white">
                            <label for="info_group">Titre<span class="text-red-500">*</span></label>
                            <input type="text" id="info_group" wire:model="info_group" placeholder="Entrez un titre" class="@if($errors->has('info_group')) input-error @endif" value="{{ old('info_group') }}">
                            @if($errors->has('info_group'))
                                <p class="text-error">{{ $errors->first('info_group') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="flex-1 ml-2">
                        <div class="textfield-white">
                            <label for="info_value">Valeur<span class="text-red-500">*</span></label>
                            <input type="text" id="info_value" wire:model="info_value" placeholder="Entrez une valeur" class="@if($errors->has('info_value')) input-error @endif" value="{{ old('info_value') }}">
                            @if($errors->has('info_value'))
                                <p class="text-error">{{ $errors->first('info_value') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mt-3 text-right">
                    <button type="submit" class="btn-secondary"><i class="fa-solid fa-floppy-disk mr-3"></i>Sauvegarder</button>
                </div>
            </div>
            @endif
            @if($infoTemp->count() > 0)
                <div class="mt-3 table-box-outline">
                <table>
                    <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Valeur</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($infoTemp as $info)
                        <tr>
                            <td>{{ $info->title }}</td>
                            <td>{{ $info->value }}</td>
                            <td><a wire:click="deleteInfo({{ $info->id }})" class="hover:text-amber-500"><i class="fa-solid fa-trash"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @else
                <p class="empty-text mt-2">Aucune informations supplémentaire de renseigné</p>
            @endif
        </form>

        <form wire:submit.prevent="addPictures" enctype="multipart/form-data">
            @csrf
            <hr class="my-3">

            <div class="mt-2 flex items-center">
                <div class="flex-1">
                    <h2 class="subtitle">Ajouter des photos</h2>
                </div>
                <div class="flex-none">
                    @if(!$showAddPicture)
                        <a wire:click="$toggle('showAddPicture')" class="btn-secondary cursor-pointer">Ajouter</a>
                    @else
                        <a wire:click="$toggle('showAddPicture')" class="btn-secondary cursor-pointer">Fermer</a>
                    @endif
                </div>
            </div>
            @if($showAddPicture)
                <div class="rounded-lg bg-blue-100 px-3 py-2 block mt-2">
                    <p class="bg-blue-200 px-2 py-1 rounded-lg">Vous êtes sur le point d'ajouter des photos</p>
                    <div class="textfield-white mt-2">
                        <label for="picture">Photo<span class="text-red-500">*</span></label>
                        <input type="file" id="picture" wire:model="picture" class="@if($errors->has('picture')) input-error @endif" value="{{ old('picture') }}">
                        @if($errors->has('picture'))
                            <p class="text-error">{{ $errors->first('picture') }}</p>
                        @endif
                    </div>
                    <div class="mt-3 text-right">
                        <button type="submit" class="btn-secondary"><i class="fa-solid fa-floppy-disk mr-3"></i>Sauvegarder</button>
                    </div>
                </div>
            @endif
            @if($pictureTemp->count() > 0)
                <div class="mt-3 grid grid-cols-4 gap-4">
                    @foreach($pictureTemp as $picture)
                        <div class="border border-gray-200 rounded-lg overflow-hidden text-center">
                            <img src="{{ asset('storage/images/products_attachment/'. $picture->picture_url) }}"/>
                            <div class="py-3">
                                <a wire:click="deletePicture({{ $picture->id }})" class="hover:text-amber-500 cursor-pointer"><i class="fa-solid fa-trash"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="empty-text mt-2">Aucune informations supplémentaire de renseigné</p>
            @endif
        </form>


    </div>

</div>
