<form wire:submit.prevent="firstStep">
    @csrf
    <div class="flex">
        <div class="flex-1 mr-2">
            {{-- Contenu --}}

            {{-- Sélection du type de produit --}}
            <div class="textfield">
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

            {{-- @php
                dd($this->checkEtap1);
            @endphp --}}

            {{-- Image du produit --}}
            <div class="textfield mt-2">
                <label for="cover">Image principale du produit</label>
                <input type="file" id="cover" wire:model="cover" placeholder="Entrez le nom du produit" class="@if($errors->has('cover')) input-error @endif" value="{{ old('cover') }}">
                @if($errors->has('cover'))
                    <p class="text-error">{{ $errors->first('cover') }}</p>
                @endif
            </div>
            <div class="flex items-center mt-2">
                <div class="flex-1 bg-blue-100 rounded-l-md px-2 py-0.5 border border-blue-200">
                    <p class="text-sm">Il est conseillé de recharger votre page.</p>
                </div>
                <div class="flex-none">
                    <button wire:click="refresh" class="bg-blue-100 text-sm rounded-r-md px-5 py-0.5 border border-blue-200 hover:bg-blue-400 hover:text-white duration-300">Recharger</button>
                </div>
            </div>

            <hr class="my-3 border-gray-200">
            <div class="textfield">
                <label for="short_description">Description courte</label>
                <textarea wire:model="short_description" id="short_description" placeholder="Entrez une description courte" class="@if($errors->has('short_description')) input-error @endif">{{ old('short_description') }}</textarea>
                @if($errors->has('short_description'))
                    <p class="text-error">{{ $errors->first('short_description') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="long_description">Description complète</label>
                <textarea wire:model="long_description" id="long_description" placeholder="Entrez une description complète" class="@if($errors->has('long_description')) input-error @endif">{{ old('long_description') }}</textarea>
                @if($errors->has('long_description'))
                    <p class="text-error">{{ $errors->first('long_description') }}</p>
                @endif
            </div>
            <hr class="my-3 border-gray-200">
            <div class="flex">
                <div class="flex-1 mr-2">
                    <a wire:click.prevent="$emit('openModal', 'popups.back.products.product-add.add-category', {{ json_encode(['product_temp_id' => $product->id]) }})" class="cursor-pointer text-center bg-gray-100 py-3 font-bold rounded-md border border-transparent hover:border-gray-200 block w-full">@if($temp_product->category_id) Modifier la catégorie @else Ajouter une catégorie @endif</a>
                    @if($temp_product->category_id)
                        <div class="flex justify-center py-5 border-2 rounded-md border-gray-100 mt-2">
                            <p class="truncate">{{ $temp_product->getCategory()->title }}</p>
                        </div>
                    @else
                        <div class="flex justify-center py-5 rounded-md bg-red-500 text-white mt-2">
                            Catégorie obligatoire
                        </div>
                    @endif
                </div>
                <div class="flex-1 ml-2">
                    <a wire:click.prevent="$emit('openModal', 'popups.back.products.product-add.add-brand', {{ json_encode(['product_temp_id' => $product->id]) }})" class="cursor-pointer text-center bg-gray-100 py-3 font-bold rounded-md border border-transparent hover:border-gray-200 block w-full">@if($temp_product->brand_id) Modifier la marque @else Ajouter une marque @endif</a>
                    @if($temp_product->brand_id)
                        <div class="flex justify-center py-5 border-2 rounded-md border-gray-100 mt-2">
                            <img src="{{ asset('storage/images/brands/'. $temp_product->getBrand()->picture) }}" width="100px">
                        </div>
                    @else
                        <div class="flex justify-center py-5 rounded-md bg-red-500 text-white mt-2">
                            Marque obligatoire
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="flex-1 ml-2">
            {{-- Photo Produit --}}
            {{-- <div class="product_create_picture">
                @if($temp_product->cover != null)
                    <img src="{{ asset('storage/images/products/'. $temp_product->cover) }}" class="rounded-lg">
                @elseif($cover && $temp_product->cover == null)
                    <img src="{{ $cover->temporaryUrl() }}" class="rounded-lg">
                @else
                    <i class="fa-regular fa-image text-9xl"></i>
                @endif
            </div> --}}
            <div class="product_create_picture">
                @if($cover)
                    <img src="{{ $cover->temporaryUrl() }}" class="rounded-lg">
                @elseif($temp_product->cover)
                    <img src="{{ asset('storage/images/products/'. $temp_product->cover) }}" class="rounded-lg">
                @else
                    <i class="fa-regular fa-image text-9xl"></i>
                @endif
            </div>
        </div>
    </div>
    @if($title != $temp_product->title || $type != $temp_product->type || $short_description != $temp_product->short_description || $slug != $temp_product->slug || $long_description != $temp_product->long_description || $cover != $temp_product->cover)
        <button type="submit" class="fixed bottom-10 right-10 bg-primary text-white py-3 px-5 rounded-md drop-shadow-lg duration-300 hover:bg-secondary hover:text-black"><i class="fa-solid fa-floppy-disk mr-3"></i>Sauvegarder les modifications</button>
    @endif
</form>

