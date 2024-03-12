<div>
    <div class="bg-gray-100 p-5">
        <div class="flex items-center">
            <div class="flex-1">
                <h2 class="font-bold text-xl">Ajouter un pneu</h2>
            </div>
            <div class="flex-none">
                <button wire:click.prevent="$emit('closeModal')" type="button" class="py-2 px-2.5 hover:text-red-500"><i class="fa-solid fa-xmark"></i></button>
            </div>
        </div>

    </div>
    <div class="border-b border-gray-100 p-5 text-gray-500">
        <p>
            Pour une référence principale, vous pouvez ajouter plusieurs type de pneus ou bien en créer uniquement un.
        </p>
    </div>
    <form wire:submit.prevent="addVariant" class="p-5">
        @csrf
        <div class="flex">
            <div class="flex-1 mr-2">
                <div class="textfield">
                    <label for="ugs">Numéro UGS<span class="text-red-500">*</span></label>
                    <input type="text" id="ugs" wire:model="ugs" placeholder="Entrez le numéro UGS de votre produit" class="@if($errors->has('ugs')) input-error @endif" value="{{ old('ugs') }}">
                    @if($errors->has('ugs'))
                        <p class="text-error">{{ $errors->first('ugs') }}</p>
                    @endif
                </div>
            </div>
            <div class="flex-1 ml-2">
                <div class="textfield">
                    <label for="ugs_swatch">Numéro UGS de la variante<span class="text-red-500">*</span></label>
                    <input type="text" id="ugs_swatch" wire:model="ugs_swatch" placeholder="Entrez le numéro UGS de votre variante" class="@if($errors->has('ugs_swatch')) input-error @endif" value="{{ old('ugs_swatch') }}">
                    @if($errors->has('ugs_swatch'))
                        <p class="text-error">{{ $errors->first('ugs_swatch') }}</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Section pneu --}}
        <div class="flex items-center my-5 py-2 px-5 rounded-md bg-gray-100">
            <div class="flex-1">
                <h2 class="font-bold text-xl">Configuration du pneu</h2>
            </div>
        </div>

        <div class="textfield">
            <label for="position">Position du pneu<span class="text-red-500">*</span></label>
            <select id="position" wire:model="position">
                <option value="">-- Sélectionnez une position --</option>
                <option value="avant">Avant</option>
                <option value="arriere">Arrière</option>
                <option value="les2">Avant et arrière</option>
            </select>
        </div>

        <div class="flex">
            <div class="flex-1 mr-2">
                <div class="textfield mt-2">
                    <label for="width">Largeur<span class="text-red-500">*</span></label>
                    <input type="text" id="width" wire:model="width" placeholder="Entrez la largeur du pneu" class="@if($errors->has('width')) input-error @endif" value="{{ old('width') }}">
                    @if($errors->has('width'))
                        <p class="text-error">{{ $errors->first('width') }}</p>
                    @endif
                </div>
                <div class="textfield mt-2">
                    <label for="diameter">Diamètre<span class="text-red-500">*</span></label>
                    <input type="text" id="diameter" wire:model="diameter" placeholder="Entrez le diamètre du pneu" class="@if($errors->has('diameter')) input-error @endif" value="{{ old('diameter') }}">
                    @if($errors->has('diameter'))
                        <p class="text-error">{{ $errors->first('diameter') }}</p>
                    @endif
                </div>
            </div>
            <div class="flex-1 ml-2">
                <div class="textfield mt-2">
                    <label for="height">Hauteur<span class="text-red-500">*</span></label>
                    <input type="text" id="height" wire:model="height" placeholder="Entrez la hauteur du pneu" class="@if($errors->has('height')) input-error @endif" value="{{ old('height') }}">
                    @if($errors->has('height'))
                        <p class="text-error">{{ $errors->first('height') }}</p>
                    @endif
                </div>
                <div class="textfield mt-2">
                    <label for="indice">Indice de vitesse<span class="text-red-500">*</span></label>
                    <input type="text" id="indice" wire:model="indice" placeholder="Entrez l'indice de vitesse" class="@if($errors->has('indice')) input-error @endif" value="{{ old('indice') }}">
                    @if($errors->has('indice'))
                        <p class="text-error">{{ $errors->first('indice') }}</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Section Tarifs --}}
        <div class="flex items-center my-5 py-2 px-5 rounded-md bg-gray-100">
            <div class="flex-1">
                <h2 class="font-bold text-xl">Tarifs</h2>
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

        <div class="mt-5">
            <button type="submit" class="bg-primary text-white py-2.5 block w-full border border-transparent rounded-md hover:bg-primary/70 hover:border-primary duration-300"><i class="fa-solid fa-plus mr-3"></i>Ajouter</button>
        </div>
    </form>
</div>
