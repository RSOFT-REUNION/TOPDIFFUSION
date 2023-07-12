<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h2>Importer un fichier</h2>
            </div>
            <div class="flex-none">
                <a wire:click="$emit('closeModal')" class="btn-icon block cursor-pointer"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>
    <div class="entry-content">
        <p>Vous êtes sur le point d'importer une liste de motos, l'ordre des colonnes est très importante.</p>
        <form wire:submit.prevent="import">
            @csrf
            <div class="textfield mt-4">
                <label for="file">Fichier d'import (Uniquement format CSV)</label>
                <input type="file" id="file" wire:model="file" class="@if($errors->has('file')) input-error @endif" value="{{ old('file') }}">
                @if($errors->has('file'))
                    <p class="text-error">{{ $errors->first('file') }}</p>
                @endif
            </div>
            <div class="mt-5">
                <button type="submit" class="btn-secondary">Importer</button>
            </div>
        </form>
    </div>
</div>
