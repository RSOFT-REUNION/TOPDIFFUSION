<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h2>Modification de mon adresse</h2>
            </div>
            <div class="flex-none">
                <a wire:click="$emit('closeModal')" class="btn-icon block cursor-pointer"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>
    <div class="entry-content">
        <form wire:submit.prevent="edit" enctype="multipart/form-data">
            @csrf
            <div class="textfield">
                <label for="title">Nom<span class="text-red-500">*</span></label>
                <input type="text" id="title" wire:model="title" placeholder="Donner un nom à votre adresse (ex: Maison..)" class="@if($errors->has('title')) input-error @endif" value="{{ old('title') }}">
                @if($errors->has('title'))
                    <p class="text-error">{{ $errors->first('title') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="add">Adresse<span class="text-red-500">*</span></label>
                <input type="text" id="add" wire:model="add" placeholder="Entrez votre adresse" class="@if($errors->has('add')) input-error @endif" value="{{ old('add') }}">
                @if($errors->has('add'))
                    <p class="text-error">{{ $errors->first('add') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="address_bis">Adresse (complément)</label>
                <input type="text" id="address_bis" wire:model="address_bis" placeholder="Entrez des informations supplémentaire sur votre adresse" class="@if($errors->has('address_bis')) input-error @endif" value="{{ old('address_bis') }}">
                @if($errors->has('address_bis'))
                    <p class="text-error">{{ $errors->first('address_bis') }}</p>
                @endif
            </div>
            <div class="flex mt-2">
                <div class="flex-1 mr-2">
                    <div class="textfield">
                        <label for="postal">Code postale<span class="text-red-500">*</span></label>
                        <input type="text" id="postal" wire:model="postal" placeholder="Entrez votre code postale" class="@if($errors->has('postal')) input-error @endif" value="{{ old('postal') }}">
                        @if($errors->has('postal'))
                            <p class="text-error">{{ $errors->first('postal') }}</p>
                        @endif
                    </div>
                </div>
                <div class="flex-1 ml-2">
                    <div class="textfield">
                        <label for="city">Ville<span class="text-red-500">*</span></label>
                        <input type="text" id="city" wire:model="city" placeholder="Entrez le nom de votre ville" class="@if($errors->has('city')) input-error @endif" value="{{ old('city') }}">
                        @if($errors->has('city'))
                            <p class="text-error">{{ $errors->first('city') }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="textfield mt-2">
                <label for="country">Pays / Département<span class="text-red-500">*</span></label>
                <input type="text" id="country" wire:model="country" placeholder="Entrez votre pays" class="@if($errors->has('country')) input-error @endif" value="{{ old('country') }}">
                @if($errors->has('country'))
                    <p class="text-error">{{ $errors->first('country') }}</p>
                @endif
            </div>
            <div class="mt-4">
                <input type="checkbox" id="main" wire:model="main">
                <label for="main">Il s'agit de mon adresse par défaut</label>
            </div>
            <div class="mt-10">
                <button type="submit" class="btn-secondary block w-full">Modifier</button>
            </div>
        </form>
    </div>
</div>
