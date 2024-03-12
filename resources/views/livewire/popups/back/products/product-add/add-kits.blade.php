<div>
    <div class="bg-gray-100 p-5">
        <div class="flex items-center">
            <div class="flex-1">
                <h2 class="font-bold text-xl">Ajouter un kit</h2>
            </div>
            <div class="flex-none">
                <button wire:click.prevent="$emit('closeModal')" type="button" class="py-2 px-2.5 hover:text-red-500"><i class="fa-solid fa-xmark"></i></button>
            </div>
        </div>
    </div>
    <div class="p-5 border-b border-gray-100">
        <p class="text-gray-500">
            Lors de l'ajout d'un kit de chaîne, plusieurs étapes sont requises. Nous devons dans un premier temps configurer le kit, avec
            son nom, sa référence, sa règle de taxe et sa description. Ensuite, nous devons configurer le pignon, la chaîne et la couronne. Cette
            deuxième étape se passe une fois votre kit enregistré.
        </p>
    </div>

    <div class="p-5">
        <form wire:submit.prevent="">
            @csrf
            <div class="textfield">
                <label for="title">Nom du kit<span class="text-red-500">*</span></label>
                <input type="text" id="title" wire:model="title" placeholder="Entrez le nom de votre kit" class="@if($errors->has('title')) input-error @endif" value="{{ old('title') }}">
                @if($errors->has('title'))
                    <p class="text-error">{{ $errors->first('title') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="reference">Référence du kit<span class="text-red-500">*</span></label>
                <input type="text" id="reference" wire:model="reference" placeholder="Entrez la référence de votre kit" class="@if($errors->has('reference')) input-error @endif" value="{{ old('reference') }}">
                @if($errors->has('reference'))
                    <p class="text-error">{{ $errors->first('reference') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="description">Description</label>
                <input type="text" id="description" wire:model="description" placeholder="Entrez la description de votre kit" class="@if($errors->has('description')) input-error @endif" value="{{ old('description') }}">
                @if($errors->has('description'))
                    <p class="text-error">{{ $errors->first('description') }}</p>
                @endif
            </div>

            {{-- Section Tarifs --}}
            <div class="flex items-center my-5 py-2 px-5 rounded-md bg-gray-100">
                <div class="flex-1">
                    <h2 class="font-bold text-xl">Règles de TVA</h2>
                </div>
            </div>

            <p class="bg-blue-100 border border-blue-300 text-sm px-2 py-0.5 rounded-md mb-2"><i class="fa-solid fa-circle-info mr-3"></i>
                @if($TVA_custom == 'default') La règle de taxe par défaut est actuellement utilisée
                @elseif($TVA_custom == 'custom') Vous utilisez une règle de taxe personnalisée
                @else Vous n'utilisez pas de règle de taxe
                @endif
            </p>

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
                <button type="submit" class="bg-primary px-3 py-2 rounded-md text-white block w-full duration-300 hover:bg-secondary hover:text-black">Enregistrer</button>
            </div>
        </form>
    </div>
</div>
