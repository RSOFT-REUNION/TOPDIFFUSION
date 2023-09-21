<div>
    <div id="popup">
        <div class="entry-header">
            <div class="flex items-center">
                <div class="flex-1">
                    <h2><i class="fa-solid fa-plus mr-3"></i>Ajouter</h2>
                </div>
                <div class="flex-none">
                    <a wire:click="$emit('closeModal')" class="btn-icon block cursor-pointer"><i class="fa-solid fa-xmark"></i></a>
                </div>
            </div>
        </div>
        <div class="entry-content">
            @if($errors->has('error_input'))
                <p class="box-error mt-3"><i class="fa-solid fa-circle-exclamation mr-3"></i>{{ $errors->first('error_input') }}</p>
            @endif
            <div class="mt-2">
                <form wire:submit.prevent="create">
                    @csrf

                    <div class="flex">
                        <div class="flex-1 mr-2">
                            <div class="textfield">
                                <label for="firstname">Prénom<span class="text-red-500">*</span></label>
                                <input type="text" id="firstname" placeholder="Entrez votre prénom" name="firstname" wire:model="firstname" class="@if($errors->has('firstname')) input-error @endif" value="{{ old('firstname') }}">
                                @if($errors->has('firstname'))
                                    <p class="text-error">{{ $errors->first('firstname') }}</p>
                                @endif
                            </div>
                            <div class="textfield mt-2">
                                <label for="email">Adresse e-mail<span class="text-red-500">*</span></label>
                                <input type="email" id="email" placeholder="Entrez votre adresse e-mail" name="email" wire:model="email" class="@if($errors->has('email')) input-error @endif" value="{{ old('email') }}">
                                @if($errors->has('email'))
                                    <p class="text-error">{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="flex-1 ml-2">
                            <div class="textfield">
                                <label for="lastname">Nom<span class="text-red-500">*</span></label>
                                <input type="text" id="lastname" placeholder="Entrez votre nom" name="lastname" wire:model="lastname" class="@if($errors->has('lastname')) input-error @endif" value="{{ old('lastname') }}">
                                @if($errors->has('lastname'))
                                    <p class="text-error">{{ $errors->first('lastname') }}</p>
                                @endif
                            </div>
                            <div class="textfield mt-2">
                                <label for="phone">Numéro de téléphone</label>
                                <input type="tel" id="phone" placeholder="Entrez votre numéro de téléphone" name="phone" wire:model="phone" class="@if($errors->has('phone')) input-error @endif" value="{{ old('phone') }}">
                                @if($errors->has('phone'))
                                    <p class="text-error">{{ $errors->first('phone') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="textfield mt-2">
                        <label for="password">Mot de passe<span class="text-red-500">*</span></label>
                        <input type="password" id="password" name="password" wire:model="password" placeholder="Entrez votre mot de passe" class="@if($errors->has('password')) input-error @endif">
                        @if($errors->has('password'))
                            <p class="text-error">{{ $errors->first('password') }}</p>
                        @endif
                    </div>

                    <div class="flex mt-10">
                        <div class="mx-auto width-500">
                            <button type="submit" class="btn-secondary block w-full @if(strlen($firstname) < 2 || strlen($lastname) < 2 || strlen($password) < 6) btn-secondary-disabled bg-red-500 @endif"><i class="fa-solid fa-user-plus mr-2"></i>S'inscrire</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
