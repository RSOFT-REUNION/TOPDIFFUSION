<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h2>Ajouter un groupe d'option</h2>
            </div>
            <div class="flex-none">
                <a wire:click="$emit('closeModal')" class="btn-icon block cursor-pointer"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>
    <div class="entry-content">
        <p class="mb-5 bg-gray-100 p-2 rounded-lg">
            Les groupes d'options vous permettent de gérer les différentes variantes possible pour les articles. Vous pouvez
            créer différents groupes d'options afin de correspondre au mieux à votre besoin. Une fois un groupe créer vous devez créer les variantes possible pour chacun des groupes.
        </p>
        <form wire:submit.prevent="create" enctype="multipart/form-data">
            @csrf
            <div class="textfield mt-2">
                <label for="title">Titre<span class="text-red-500">*</span></label>
                <input type="text" id="title" wire:model="title" placeholder="Entrez un nom de groupe" class="@if($errors->has('title')) input-error @endif" value="{{ old('title') }}">
                @if($errors->has('title'))
                    <p class="text-error">{{ $errors->first('title') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="type">Type de groupe</label>
                <select wire:model="type" id="type" class="@if($errors->has('type')) input-error @endif">
                    <option value="">-- Sélectionner un type --</option>
                    <option value="1">Variante texte (dimensions, options..)</option>
                    <option value="2">Variante couleur</option>
                </select>
                @if($errors->has('type'))
                    <p class="text-error">{{ $errors->first('type') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="description">Description</label>
                <textarea wire:model="description" id="description" placeholder="Entrez une description" class="@if($errors->has('description')) input-error @endif">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <p class="text-error">{{ $errors->first('description') }}</p>
                @endif
            </div>
            <div class="mt-10">
                <button type="submit" class="btn-secondary block w-full">Ajouter</button>
            </div>
        </form>
    </div>
</div>
