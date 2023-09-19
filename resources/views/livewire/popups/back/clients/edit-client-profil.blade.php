<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h2>Modification du profil de {{ $lastname }}</h2>
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
            <hr class="my-3"/>
            @if($user->professionnal == 1)
                <div class="text-input">
                    <label for="company_name">Raison social</label>
                    <p>{{ $userData->company_name }}</p>
                </div>
                <div class="textfield mt-2">
                    <label for="company_com_name">Nom commercial</label>
                    <input type="text" id="company_com_name" wire:model="company_com_name" placeholder="Entrez le nom commerciale de votre entreprise" class="@if($errors->has('company_com_name')) input-error @endif" value="{{ old('company_com_name') }}">
                    @if($errors->has('company_com_name'))
                        <p class="text-error">{{ $errors->first('company_com_name') }}</p>
                    @endif
                </div>
                <div class="flex mt-2">
                    <div class="flex-1 mr-2">
                        <div class="text-input">
                            <label for="company_rcs">Numéro de RCS</label>
                            <p>{{ $userData->company_rcs }}</p>
                        </div>
                    </div>
                    <div class="flex-1 ml-2">
                        <div class="text-input">
                            <label for="company_tva">Numéro de TVA</label>
                            <p>{{ $userData->company_tva }}</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="mt-4">
                    <input type="checkbox" id="professionnal" wire:model="professionnal">
                    <label for="professionnal">Passer sur un compte professionnel</label>
                </div>
            @endif
            <div class="mt-10">
                <button type="submit" class="btn-secondary block w-full">Modifier</button>
            </div>
        </form>
    </div>
</div>
