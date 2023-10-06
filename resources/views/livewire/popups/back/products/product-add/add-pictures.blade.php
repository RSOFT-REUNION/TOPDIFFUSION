<div>
    <div class="bg-gray-100 p-5">
        <div class="flex items-center">
            <div class="flex-1">
                <h2 class="font-bold text-xl">Ajouter des photos</h2>
            </div>
            <div class="flex-none">
                <button wire:click.prevent="$emit('closeModal')" type="button" class="py-2 px-2.5 hover:text-red-500"><i class="fa-solid fa-xmark"></i></button>
            </div>
        </div>

    </div>
    <form wire:submit.prevent="addPicture" class="p-5">
        @csrf
        <div class="textfield">
            <label for="picture">Ajouter une photo<span class="text-red-500">*</span></label>
            <input type="file" id="picture" wire:model="picture" class="@if($errors->has('picture')) input-error @endif" value="{{ old('picture') }}">
            @if($errors->has('picture'))
                <p class="text-error">{{ $errors->first('picture') }}</p>
            @endif
        </div>
        @if($picture)
            <div class="force-center mt-5">
                <img src="{{ $picture->temporaryUrl() }}" alt="Photo du produit" style="max-width: 300px">
            </div>
        @endif
        <div class="mt-5">
            <button type="submit" class="bg-primary text-white py-2.5 block w-full border border-transparent rounded-md hover:bg-primary/70 hover:border-primary duration-300"><i class="fa-solid fa-plus mr-3"></i>Ajouter</button>
        </div>
    </form>
</div>
