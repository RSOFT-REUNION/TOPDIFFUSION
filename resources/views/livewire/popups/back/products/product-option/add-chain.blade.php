<div>
    <div class="bg-gray-100 p-5">
        <div class="flex items-center">
            <div class="flex-1">
                <h2 class="font-bold text-xl">Ajouter une chaine</h2>
            </div>
            <div class="flex-none">
                <button wire:click.prevent="$emit('closeModal')" type="button" class="py-2 px-2.5 hover:text-red-500"><i class="fa-solid fa-xmark"></i></button>
            </div>
        </div>
    </div>

    <div class="p-5">
        <form wire:submit.prevent="addChain" enctype="multipart/form-data">
            @csrf
            <div class="textfield">
                <label for="type">Type de chaine<span class="text-red-500">*</span></label>
                <input type="text" id="type" wire:model="type" placeholder="Entrez le type de chaine" class="@if($errors->has('type')) input-error @endif" value="{{ old('type') }}">
                @if($errors->has('type'))
                    <p class="text-error">{{ $errors->first('type') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="step">Pas<span class="text-red-500">*</span></label>
                <input type="text" id="step" wire:model="step" placeholder="Entrez le pas de votre chaine" class="@if($errors->has('step')) input-error @endif" value="{{ old('step') }}">
                @if($errors->has('step'))
                    <p class="text-error">{{ $errors->first('step') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="color">Couleur (Couleur/Code)<span class="text-red-500">*</span></label>
                <input type="text" id="color" wire:model="color" placeholder="Entrez la couleur de votre chaine (ex: Or/GG)" class="@if($errors->has('color')) input-error @endif" value="{{ old('color') }}">
                @if($errors->has('color'))
                    <p class="text-error">{{ $errors->first('color') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="length">Longueur<span class="text-red-500">*</span></label>
                <input type="text" id="length" wire:model="length" placeholder="Entrez la longueur de votre chaine" class="@if($errors->has('length')) input-error @endif" value="{{ old('length') }}">
                @if($errors->has('length'))
                    <p class="text-error">{{ $errors->first('length') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="picture">Image<span class="text-red-500">*</span></label>
                <input type="file" id="picture" wire:model="picture" class="@if($errors->has('picture')) input-error @endif" value="{{ old('picture') }}">
                @if($errors->has('picture'))
                    <p class="text-error">{{ $errors->first('picture') }}</p>
                @endif
            </div>
            @if($picture)
                {{-- Affichage de la photo en temporaire --}}
                <div class="mt-4 force-center">
                    <img src="{{ $picture->temporaryUrl() }}" alt="Photo temporaire" class="w-[300px] object-cover rounded-md">
                </div>
            @endif
            <div class="mt-3">
                <button type="submit" class="bg-primary py-2 rounded-md duration-300 hover:bg-secondary hover:text-black block w-full text-white mt-5">Ajouter</button>
            </div>
        </form>
    </div>
</div>
