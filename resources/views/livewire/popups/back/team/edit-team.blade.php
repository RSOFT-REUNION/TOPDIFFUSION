<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h2>Modification de mon profil</h2>
            </div>
            <div class="flex-none">
                <a wire:click="$emit('closeModal')" class="btn-icon block cursor-pointer"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>
    <div class="entry-content">
        <form wire:submit.prevent="edit" enctype="multipart/form-data">
            @csrf
            <div class="flex items-center">
                <div class="flex-1 mr-2">
                    <div class="textfield">
                        <label for="firstname">Prénom<span class="text-red-500">*</span></label>
                        <input type="text" id="firstname" wire:model="firstname" placeholder="Entrez votre prénom" class="@if($errors->has('firstname')) input-error @endif" value="{{ old('firstname') }}">
                        @if($errors->has('firstname'))
                            <p class="text-error">{{ $errors->first('firstname') }}</p>
                        @endif
                    </div>
                </div>
                <div class="flex-1 ml-2">
                    <div class="textfield">
                        <label for="lastname">Nom<span class="text-red-500">*</span></label>
                        <input type="text" id="lastname" wire:model="lastname" placeholder="Entrez votre nom " class="@if($errors->has('lastname')) input-error @endif" value="{{ old('lastname') }}">
                        @if($errors->has('lastname'))
                            <p class="text-error">{{ $errors->first('lastname') }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="textfield mt-2">
                <label for="email">Adresse e-mail<span class="text-red-500">*</span></label>
                <input type="email" id="email" wire:model="email" placeholder="Entrez votre adresse e-mail" class="@if($errors->has('email')) input-error @endif" value="{{ old('email') }}">
                @if($errors->has('email'))
                    <p class="text-error">{{ $errors->first('email') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="phone">Numéro de téléphone</label>
                <input type="text" id="phone" wire:model="phone" placeholder="Entrez votre numéro de téléphone" class="@if($errors->has('phone')) input-error @endif" value="{{ old('phone') }}">
                @if($errors->has('phone'))
                    <p class="text-error">{{ $errors->first('phone') }}</p>
                @endif
            </div>
            <div class="mt-10">
                <button type="submit" class="btn-secondary block w-full">Modifier</button>
            </div>
        </form>
    </div>
</div>

