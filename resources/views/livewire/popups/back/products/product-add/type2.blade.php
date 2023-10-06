<div>
    <div class="bg-gray-100 p-5">
        <div class="flex items-center">
            <div class="flex-1">
                <h2 class="font-bold text-xl">Ajouter une variante</h2>
            </div>
            <div class="flex-none">
                <button wire:click.prevent="$emit('closeModal')" type="button" class="py-2 px-2.5 hover:text-red-500"><i class="fa-solid fa-xmark"></i></button>
            </div>
        </div>

    </div>
    <div class="border-b border-gray-100 p-5 text-gray-500">
        <p>
            Les variantes sont à définir dans les options des produits. <a href="{{ route('back.product.options') }}" target="_blank" class="text-blue-400 hover:underline">Définir de nouvelles variantes</a>.<br>
            Une fois vos variantes configurées, il est conseillé de recharger votre page.
        </p>
    </div>
    <form wire:submit.prevent="addVariant" class="p-5">
        @csrf
        <div class="textfield">
            <label for="ugs">Numéro UGS<span class="text-red-500">*</span></label>
            <input type="text" id="ugs" wire:model="ugs" placeholder="Entrez le numéro UGS de votre produit" class="@if($errors->has('ugs')) input-error @endif" value="{{ old('ugs') }}">
            @if($errors->has('ugs'))
                <p class="text-error">{{ $errors->first('ugs') }}</p>
            @endif
        </div>

        <div class="textfield mt-2">
            <label for="ugs_swatch">Numéro UGS de la variante<span class="text-red-500">*</span></label>
            <input type="text" id="ugs_swatch" wire:model="ugs_swatch" placeholder="Entrez le numéro UGS de votre variante" class="@if($errors->has('ugs_swatch')) input-error @endif" value="{{ old('ugs_swatch') }}">
            @if($errors->has('ugs_swatch'))
                <p class="text-error">{{ $errors->first('ugs_swatch') }}</p>
            @endif
        </div>

        {{-- Section Tarifs --}}
        <div class="flex items-center my-5 py-2 px-5 rounded-md bg-gray-100">
            <div class="flex-1">
                <h2 class="font-bold text-xl">Tarifications</h2>
            </div>
        </div>

        <p class="bg-blue-100 border border-blue-300 text-sm px-2 py-0.5 rounded-md mb-2"><i class="fa-solid fa-circle-info mr-3"></i>
            @if($TVA_custom == 'default') La règle de taxe par défaut est actuellement utilisée
            @elseif($TVA_custom == 'custom') Vous utilisez une règle de taxe personnalisée
            @else Vous n'utilisez pas de règle de taxe
            @endif
        </p>

        <div class="flex">
            <div class="flex-1 mr-2">
                <div class="textfield">
                    <label for="price_HT">Prix HT (€)<span class="text-red-500">*</span></label>
                    <input type="number" min="0.01" step="any" id="price_HT" wire:model="price_HT" placeholder="Entrez le prix HT de votre produit" class="@if($errors->has('price_HT')) input-error @endif currency" value="{{ old('price_HT') }}">
                    @if($errors->has('price_HT'))
                        <p class="text-error">{{ $errors->first('price_HT') }}</p>
                    @endif
                </div>
            </div>
            <div class="flex-1 ml-2">
                <div class="textfield">
                    <label for="price_TTC">Prix TTC (€)<span class="text-red-500">*</span></label>
                    <input type="number" min="0.01" step="any" id="price_TTC" wire:model="price_TTC" placeholder="Entrez le prix TTC de votre produit" class="@if($errors->has('price_TTC')) input-error @endif currency" value="{{ old('price_TTC') }}">
                    @if($errors->has('price_TTC'))
                        <p class="text-error">{{ $errors->first('price_TTC') }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-2 flex flex-col">
            <div class="flex-1">
                <input type="radio" wire:model="TVA_custom" value="default" id="TVA_custom-default">
                <label for="TVA_custom-default">Utiliser la règle par défaut</label>
            </div>
            <div class="flex-1">
                <input type="radio" wire:model="TVA_custom" value="custom" id="TVA_custom">
                <label for="TVA_custom">Utiliser une règle de taxe personnalisé</label>
            </div>
            <div class="flex-1">
                <input type="radio" wire:model="TVA_custom" value="none" id="TVA_custom-none">
                <label for="TVA_custom-none">Ce produit n'est pas soumis aux taxes</label>
            </div>
        </div>

        @if($TVA_custom == "custom")
            <div class="textfield mt-2">
                <label for="list_tva_custom">Règle de taxe<span class="text-red-500">*</span></label>
                <select name="list_tva_custom" id="list_tva_custom" wire:model="list_tva_custom">
                    <option value="">-- Sélectionner une régle --</option>
                    @foreach($taxes as $tax)
                        <option value="{{ $tax->id }}">{{ $tax->title }} - {{ $tax->country_code }} ({{ $tax->rate }})</option>
                    @endforeach
                </select>
            </div>
        @endif

        {{-- Section Variante --}}
        <div class="flex items-center my-5 py-2 px-5 rounded-md bg-gray-100">
            <div class="flex-1">
                <h2 class="font-bold text-xl">Variante</h2>
            </div>
        </div>

        <div class="textfield">
            <label for="option_group">Type de variante<span class="text-red-500">*</span></label>
            <select name="option_group" id="option_group" wire:model="option_group">
                <option value="">-- Sélectionner un type de variante --</option>
                @foreach($variant_group as $group)
                    <option value="{{ $group->id }}">{{ $group->title }}</option>
                @endforeach
            </select>
        </div>
        @if($option_group)
            <div class="mt-2 grid grid-cols-2 gap-4">
                @foreach($variant_items as $item)
                    @if($item->group_id == $option_group)
                        <div>
                            <label for="variant-{{ $item->id }}" class="font-bold rounded-md py-2 px-4 hover:drop-shadow-lg duration-300 cursor-pointer flex items-center relative @if($item->getGroupInfo()->type == 1) bg-gray-100 @endif" style="@if($item->getGroupInfo()->type == 2) background-color: @if($item->key == '#ffffff') #FFFFFF; border: 1px solid #00000010 @elseif($item->key == '#000000') #000; color: #FFF; @else {{ $item->key }}; color: #FFFFFF90 @endif @endif">
                                {{ $item->title }}
                                @if($item->id == $option_item)
                                    <i class="fa-solid fa-square-check absolute right-5 my-auto"></i>
                                @endif
                            </label>
                            <input type="radio" class="hidden" name="option_item" wire:model="option_item" value="{{ $item->id }}" id="variant-{{ $item->id }}">
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
        <div class="mt-5">
            <button type="submit" class="bg-primary text-white py-2.5 block w-full border border-transparent rounded-md hover:bg-primary/70 hover:border-primary duration-300"><i class="fa-solid fa-plus mr-3"></i>Ajouter</button>
        </div>
    </form>
</div>
