<div>
    <div class="bg-gray-100 p-5">
        <div class="flex items-center">
            <div class="flex-1">
                <h2 class="font-bold text-xl">Configurer mon produit</h2>
            </div>
            <div class="flex-none">
                <button wire:click.prevent="$emit('closeModal')" type="button" class="py-2 px-2.5 hover:text-red-500"><i class="fa-solid fa-xmark"></i></button>
            </div>
        </div>
    </div>
    <form wire:submit.prevent="addSimple" class="p-5">
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
                <label for="TVA_custom">Utiliser une règle de taxe personnalisée</label>
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
