<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h2>Ajouter une catégorie</h2>
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
                <label for="title">Titre<span class="text-red-500">*</span></label>
                <input type="text" id="title" wire:model="title" placeholder="Entrez un titre de catégorie" class="@if($errors->has('title')) input-error @endif" value="{{ old('title') }}">
                @if($errors->has('title'))
                    <p class="text-error">{{ $errors->first('title') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="description">Description</label>
                <textarea wire:model="description" id="description" placeholder="Entrez une description" class="@if($errors->has('description')) input-error @endif">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <p class="text-error">{{ $errors->first('description') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="slug">Slug</label>
                <input type="text" id="slug" wire:model="slug" placeholder="Entrez un slug (visible dans l'URL)" class="@if($errors->has('slug')) input-error @endif" value="{{ old('slug') }}">
                @if($errors->has('slug'))
                    <p class="text-error">{{ $errors->first('slug') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="image">Image de couverture</label>
                <input type="file" id="image" wire:model="image" class="@if($errors->has('image')) input-error @endif" value="{{ old('image') }}">
                @if($errors->has('image'))
                    <p class="text-error">{{ $errors->first('image') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="emplacement">Emplacement dans le menu</label>
                <select wire:model="emplacement" id="emplacement" class="@if($errors->has('emplacement')) input-error @endif">
                    <option value="">-- Sélectionner un emplacement --</option>
                    <option value="0">Catégorie principal (Menu principal)</option>
                    <option value="">------</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                    @endforeach
                </select>
                @if($errors->has('emplacement'))
                    <p class="text-error">{{ $errors->first('emplacement') }}</p>
                @endif
            </div>
            <div class="mt-3 mx-3">
                <input type="checkbox" wire:model="professionnal" id="professionnal">
                <label for="professionnal">Visible uniquement pour les professionnels</label>
            </div>
            <div class="mt-10">
                <button type="submit" class="btn-secondary block w-full">Ajouter</button>
            </div>
        </form>
    </div>
</div>
