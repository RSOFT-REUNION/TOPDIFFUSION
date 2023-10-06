<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h2>Ajouter une classe de taxe</h2>
            </div>
            <div class="flex-none">
                <a wire:click="$emit('closeModal')" class="btn-icon block cursor-pointer"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>
    <div class="entry-content">
        <form wire:submit.prevent="create">
            @csrf
            <div class="textfield">
                <label for="title">Nom de la classe<span class="text-red-500">*</span></label>
                <input type="text" id="title" wire:model="title" placeholder="Entrez le nom de la classe" class="@if($errors->has('title')) input-error @endif" value="{{ old('title') }}">
                @if($errors->has('title'))
                    <p class="text-error">{{ $errors->first('title') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="rate">Taux (%)<span class="text-red-500">*</span></label>
                <input type="text" id="rate" wire:model="rate" placeholder="Entrez le taux (ex: 8.5)" class="@if($errors->has('rate')) input-error @endif" value="{{ old('rate') }}">
                @if($errors->has('rate'))
                    <p class="text-error">{{ $errors->first('rate') }}</p>
                @endif
            </div>
            <hr class="my-3">
            <div class="textfield">
                <label for="country_code">Code pays<span class="text-red-500">*</span></label>
                <input type="text" id="country_code" wire:model="country_code" placeholder="Entrez le code pays (ex: RE, FR...)" class="@if($errors->has('country_code')) input-error @endif" value="{{ old('country_code') }}">
                @if($errors->has('country_code'))
                    <p class="text-error">{{ $errors->first('country_code') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="state_code">Code etat<span class="text-red-500">*</span></label>
                <input type="number" id="state_code" wire:model="state_code" placeholder="Entrez le code état (ex: 974, 95..)" class="@if($errors->has('state_code')) input-error @endif" value="{{ old('state_code') }}">
                @if($errors->has('state_code'))
                    <p class="text-error">{{ $errors->first('state_code') }}</p>
                @endif
            </div>
            <div class="mt-2">
                <input type="checkbox" id="default" wire:model="default">
                <label for="default">Il s'agit de ma classe par défaut</label>
            </div>
            <div class="mt-5">
                <button type="submit" class="btn-secondary">Ajouter</button>
            </div>
        </form>
    </div>
</div>
