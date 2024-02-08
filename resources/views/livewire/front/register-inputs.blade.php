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
    <!-- PROFESSIONNAL -->
    @if($pro)
        <div class="my-5 border-t border-t-gray-200">
        <div class="textfield mt-3">
            <label for="company_name">Nom de la société<span class="text-red-500">*</span></label>
            <input type="text" id="company_name" placeholder="Entrez le nom de la société" wire:model="company_name" name="company_name" class="@if($errors->has('company_name')) input-error @endif" value="{{ old('company_name') }}">
            @if($errors->has('company_name'))
                <p class="text-error">{{ $errors->first('company_name') }}</p>
            @endif
        </div>
        <div class="textfield mt-3">
            <label for="company_com">Nom commercial</label>
            <input type="text" id="company_com" placeholder="Entrez le nom commercial" wire:model="company_com" name="company_com" class="@if($errors->has('company_com')) input-error @endif" value="{{ old('company_com') }}">
            @if($errors->has('company_com'))
                <p class="text-error">{{ $errors->first('company_com') }}</p>
            @endif
        </div>
        <div class="flex">
            <div class="flex-1 mr-2">
                <div class="textfield mt-3">
                    <label for="company_rcs">Numéro d'entreprise (RCS)<span class="text-red-500">*</span></label>
                    <input type="text" id="company_rcs" placeholder="Entrez le numéro d'entreprise (RCS)" wire:model="company_rcs" name="company_rcs" class="@if($errors->has('company_rcs')) input-error @endif" value="{{ old('company_rcs') }}">
                    @if($errors->has('company_rcs'))
                        <p class="text-error">{{ $errors->first('company_rcs') }}</p>
                    @endif
                </div>
            </div>
            <div class="flex-1 ml-2">
                <div class="textfield mt-3">
                    <label for="company_tva">Numéro de TVA<span class="text-red-500">*</span></label>
                    <input type="text" id="company_tva" placeholder="Entrez le numéro de TVA" wire:model="company_tva" name="company_tva" class="@if($errors->has('company_tva')) input-error @endif" value="{{ old('company_tva') }}">
                    @if($errors->has('company_tva'))
                        <p class="text-error">{{ $errors->first('company_tva') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
        <p class="bg-slate-100 text-sm px-3 py-1 rounded-md">Votre numéro de TVA doit contenir uniquement des chiffres.</p>
        <p class="bg-slate-100 text-sm px-3 py-1 rounded-md mt-1">Votre profil professionnel sera soumis à une vérification.</p>
    @endif
    <!-- END PROFESSIONNAL -->
    <div class="textfield-checkbox mt-3 mx-5">
        <input type="checkbox" id="professionnal" wire:click="$toggle('professionnal')">
        <label for="professionnal">Je suis un professionnel</label>
    </div>
    <div class="textfield-checkbox mt-3 mx-5">
        <input type="checkbox" id="conditions" wire:click="$toggle('conditions')">
        <label for="conditions">J'accepte les conditions générales d'utilisation et la politique de confidentialité</label>
    </div>

    <div class="flex mt-10">
        <div class="mx-auto width-500">
            <button type="submit" class="btn-secondary block w-full @if(!$cond) btn-secondary-disabled bg-red-500 @endif"><i class="fa-solid fa-user-plus mr-2"></i>S'inscrire</button>
        </div>
    </div>
</form>
