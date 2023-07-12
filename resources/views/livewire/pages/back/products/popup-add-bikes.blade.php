<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h2>Ajouter une moto</h2>
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
                <label for="marque">Marque<span class="text-red-500">*</span></label>
                <input type="text" id="marque" wire:model="marque" placeholder="Entrez une marque" class="@if($errors->has('marque')) input-error @endif" value="{{ old('marque') }}">
                @if($errors->has('marque'))
                    <p class="text-error">{{ $errors->first('marque') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="cylindre">Cylindrée<span class="text-red-500">*</span></label>
                <input type="text" id="cylindre" wire:model="cylindre" placeholder="Entrez une cylindrée" class="@if($errors->has('cylindre')) input-error @endif" value="{{ old('cylindre') }}">
                @if($errors->has('cylindre'))
                    <p class="text-error">{{ $errors->first('cylindre') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="modele">Modèle<span class="text-red-500">*</span></label>
                <input type="text" id="modele" wire:model="modele" placeholder="Entrez un modèle" class="@if($errors->has('modele')) input-error @endif" value="{{ old('modele') }}">
                @if($errors->has('modele'))
                    <p class="text-error">{{ $errors->first('modele') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="annee">Année<span class="text-red-500">*</span></label>
                <input type="text" id="annee" wire:model="annee" placeholder="Entrez une année" class="@if($errors->has('annee')) input-error @endif" value="{{ old('annee') }}">
                @if($errors->has('annee'))
                    <p class="text-error">{{ $errors->first('annee') }}</p>
                @endif
            </div>
            <div class="mt-10">
                <button type="submit" class="btn-secondary block w-full">Ajouter</button>
            </div>
        </form>
    </div>
</div>
