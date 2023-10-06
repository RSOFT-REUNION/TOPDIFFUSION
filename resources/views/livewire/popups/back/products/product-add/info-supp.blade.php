<div>
    <div class="bg-gray-100 p-5">
        <div class="flex items-center">
            <div class="flex-1">
                <h2 class="font-bold text-xl">Informations supplémentaire</h2>
            </div>
            <div class="flex-none">
                <button wire:click.prevent="$emit('closeModal')" type="button" class="py-2 px-2.5 hover:text-red-500"><i class="fa-solid fa-xmark"></i></button>
            </div>
        </div>

    </div>
    <div class="border-b border-gray-100 p-5 text-gray-500">
        <p>
            Ajouter des informations supplémentaire vous permet d'informer vos client différentes informations de manière plus rapides tel que
            pour les materiaux, leurs positions, des références supplémentaire...
        </p>
    </div>
    <form wire:submit.prevent="addInfos" class="p-5">
        @csrf
        <div class="flex items-center">
            <div class="flex-1 mr-2">
                <div class="textfield">
                    <label for="info_group">Clé<span class="text-red-500">*</span></label>
                    <input type="text" id="info_group" wire:model="info_group" placeholder="Entrez une clé" class="@if($errors->has('info_group')) input-error @endif" value="{{ old('info_group') }}">
                </div>
            </div>
            <div class="flex-1 ml-2">
                <div class="textfield">
                    <label for="info_value">Valeur<span class="text-red-500">*</span></label>
                    <input type="text" id="info_value" wire:model="info_value" placeholder="Entrez une valeur" class="@if($errors->has('info_value')) input-error @endif" value="{{ old('info_value') }}">
                </div>
            </div>
        </div>
        @if($errors->has('info_group') || $errors->has('info_value'))
            <p class="text-sm text-red-500 bg-red-100 border border-red-200 rounded-md px-2 py-0.5 mt-2">@if($errors->has('info_group')) {{ $errors->first('info_group') }} @else {{ $errors->first('info_value') }} @endif</p>
        @endif
        <div class="mt-5">
            <button type="submit" class="bg-primary text-white py-2.5 block w-full border border-transparent rounded-md hover:bg-primary/70 hover:border-primary duration-300"><i class="fa-solid fa-plus mr-3"></i>Ajouter</button>
        </div>
    </form>
</div>
