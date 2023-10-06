<div>
    <div class="bg-gray-100 p-5">
        <div class="flex items-center">
            <div class="flex-1">
                <h2 class="font-bold text-xl">Ajouter un pignon</h2>
            </div>
            <div class="flex-none">
                <button wire:click.prevent="$emit('closeModal')" type="button" class="py-2 px-2.5 hover:text-red-500"><i class="fa-solid fa-xmark"></i></button>
            </div>
        </div>
    </div>

    <div class="p-5">
        <form wire:submit.prevent="addPignon" enctype="multipart/form-data">
            @csrf
            <div class="textfield">
                <label for="reference">Référence de la pièce<span class="text-red-500">*</span></label>
                <input type="text" id="reference" wire:model="reference" placeholder="Entrez la référence" class="@if($errors->has('reference')) input-error @endif" value="{{ old('reference') }}">
                @if($errors->has('reference'))
                    <p class="text-error">{{ $errors->first('reference') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="gearing">Denture<span class="text-red-500">*</span></label>
                <input type="number" id="gearing" wire:model="gearing" placeholder="Entrez la denture de votre pignon" class="@if($errors->has('gearing')) input-error @endif" value="{{ old('gearing') }}">
                @if($errors->has('gearing'))
                    <p class="text-error">{{ $errors->first('gearing') }}</p>
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
