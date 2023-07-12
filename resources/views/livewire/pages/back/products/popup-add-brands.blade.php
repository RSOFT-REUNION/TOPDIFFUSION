<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h2>Ajouter une marque</h2>
            </div>
            <div class="flex-none">
                <a wire:click="$emit('closeModal')" class="btn-icon block cursor-pointer"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>
    <div class="entry-content">
        <form wire:submit.prevent="create" enctype="multipart/form-data">
            @csrf
            <div class="textfield">
                <label for="title">Nom de la marque<span class="text-red-500">*</span></label>
                <input type="text" id="title" wire:model="title" placeholder="Entrez un nom de marque" class="@if($errors->has('title')) input-error @endif" value="{{ old('title') }}">
                @if($errors->has('title'))
                    <p class="text-error">{{ $errors->first('title') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="image">Logo de la marque</label>
                <input type="file" id="image" wire:model="image" class="@if($errors->has('image')) input-error @endif" value="{{ old('image') }}">
                @if($errors->has('image'))
                    <p class="text-error">{{ $errors->first('image') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="url">Adresse URL officiel</label>
                <input type="text" id="url" wire:model="url" placeholder="Entrez l'adresse URL de la marque" class="@if($errors->has('url')) input-error @endif" value="{{ old('url') }}">
                @if($errors->has('url'))
                    <p class="text-error">{{ $errors->first('url') }}</p>
                @endif
            </div>
            <div class="mt-10">
                <button type="submit" class="btn-secondary block w-full">Ajouter</button>
            </div>
        </form>
    </div>
</div>
