<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h2>Séléctionner votre kit chaine AFAM</h2>
                <p class="text-slate-400 text-sm capitalize">{{ $bike->marque }} {{ $bike->cylindree }} {{ $bike->modele }} {{ $bike->annee }}</p>
            </div>
            <div class="flex-none">
                <a wire:click="$emit('closeModal')" class="btn-icon block cursor-pointer"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>
    <div class="entry-content">
        <div class="bg-slate-100 p-4 rounded-md">
            <h2 class="text-xl font-bold text-slate-500">Kit Afam aluminium standard</h2>
            <div class="flex items-center gap-2 mt-4">
                <div class="flex-none rounded-sm border border-slate-300">
                    <div class="bg-slate-300 font-bold px-5 py-3">
                        Pignon
                    </div>
                    <div class="p-4">
                        <div class="textfield-white">
                            <label for="sprocket_size">Denture</label>
                            <select id="sprocket_size" wire:model="gear_type">
                                <option value="">--</option>
                                @foreach($products as $product)
                                    @if($product->kit_element == 2)
                                        @foreach($product_swatches as $swatch)
                                            @if($swatch->product_id == $product->id)
                                                {{-- TODO: Revoir la manière dont nous récupérons cette données. --}}
                                                <option value="{{ $swatch->id }}">{{ $swatch->gear_tooth }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-center gap-2 mt-2">
                            <div class="flex-grow">
                                <div class="text-input-white">
                                    <label for="chain_parts">Pièce</label>
                                    <p>
                                        @if($gear_type != null)
                                            {{ $gear->ugs }}{{ $gear->ugs_swatch }}
                                        @else
                                            --
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grow rounded-sm border border-slate-300">
                    <div class="bg-slate-300 font-bold px-5 py-3">
                        Chaîne
                    </div>
                    <div class="p-4">
                        <div class="textfield-white">
                            <label for="chain_type">Type de chaine</label>
                            <select id="chain_type" wire:model="chain_type">
                                <option value="">-- Sélectionner --</option>
                                @foreach($products as $product)
                                    @if($product->kit_element == 1)
                                        @foreach($product_swatches as $swatch)
                                            @if($swatch->product_id == $product->id)
                                                {{-- TODO: Revoir la manière dont nous récupérons cette données. --}}
                                                <option value="{{ $swatch->id }}">{{ $swatch->chains_reference }} - {{ $swatch->chains_length }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-center gap-2 mt-2">
                            <div class="flex-none w-1/4">
                                <div class="text-input-white">
                                    <label for="chain_color">Couleur</label>
                                    <p>Or</p>
                                </div>
                            </div>
                            <div class="flex-none w-1/4">
                                <div class="text-input-white">
                                    <label for="chain_length">Longueur</label>
                                    <p>
                                        @if($chain_type != null)
                                            {{ $chain->chains_length }}
                                        @else
                                            --
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="flex-grow">
                                <div class="text-input-white">
                                    <label for="chain_parts">Pièce</label>
                                    <p>
                                        @if($chain_type != null)
                                            {{ $chain->ugs }}{{ $chain->ugs_swatch }}
                                        @else
                                            --
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-none rounded-sm border border-slate-300">
                    <div class="bg-slate-300 font-bold px-5 py-3">
                        Couronne
                    </div>
                    <div class="p-4">
                        <div class="textfield-white">
                            <label for="crown_size">Denture</label>
                            <select id="crown_size" wire:model="crown_type">
                                <option value="">--</option>
                                @foreach($products as $product)
                                    @if($product->kit_element == 3)
                                        @foreach($product_swatches as $swatch)
                                            @if($swatch->product_id == $product->id)
                                                {{-- TODO: Revoir la manière dont nous récupérons cette données. --}}
                                                <option value="{{ $swatch->id }}">{{ $swatch->crown_tooth }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-center gap-2 mt-2">
                            <div class="flex-grow">
                                <div class="text-input-white">
                                    <label for="chain_parts">Pièce</label>
                                    <p>
                                        @if($crown_type != null)
                                            {{ $crown->ugs }}{{ $crown->ugs_swatch }}
                                        @else
                                            --
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4 text-right">
            <div class="inline-flex items-center">
                @if($chain_type && $gear_type && $crown_type)
                    <p class="font-bold text-xl pr-2 mr-2 border-r border-slate-200">{{ number_format($price, '2', ',', ' ') }} €</p>
                @endif
                @if(auth()->user())
                    <button class="btn-secondary">Ajouter mon kit au panier</button>
                @endif
            </div>
        </div>
    </div>
</div>
