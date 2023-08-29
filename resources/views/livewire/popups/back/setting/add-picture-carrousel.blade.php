<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h2>Ajouter une image</h2>
            </div>
            <div class="flex-none">
                <a wire:click="$emit('closeModal')" class="btn-icon block cursor-pointer"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>
    <div class="entry-content">
        <form wire:submit.prevent="create" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col w-full">
                @if($cover)
                    <div class="force-center mb-5">
                        <img src="{{ $cover->temporaryUrl() }}" class="image-preview rounded-md"/>
                    </div>
                @endif
                <div class="textfield mt-2">
                    <label for="cover">Image<span class="text-red-500">*</span></label>
                    <input type="file" id="cover" wire:model="cover" name="cover" class="@if($errors->has('cover'))textfield-error @endif" value="{{ old('cover') }}">
                    @if($errors->has('cover'))
                        <p class="bg-red-500 text-red-100 px-3 py-1 rounded-lg mt-2 mb-3 text-sm">{{ $errors->first('cover') }}</p>
                    @endif
                </div>
                <p class="bg-secondary px-3 py-1 rounded-lg mt-2 mb-3 text-sm">Vous devez fournir une image au format 1920x600</p>
                <div class="textfield">
                    <label for="key">Clé (uniquement visible dans votre espace)<span class="text-red-500">*</span></label>
                    <input type="text" id="key" wire:model="key" name="key" placeholder="Entrez une clé" class="@if($errors->has('key'))textfield-error @endif" value="{{ old('key') }}">
                    @if($errors->has('key'))
                        <p class="bg-red-500 text-red-100 px-3 py-1 rounded-lg mt-2 mb-3 text-sm">{{ $errors->first('key') }}</p>
                    @endif
                </div>
                <div class="text-right mt-5">
                    <button type="submit" class="btn-secondary w-full">Ajouter</button>
                </div>
            </div>
        </form>
    </div>
</div>
