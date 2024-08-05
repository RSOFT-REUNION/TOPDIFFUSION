<form wire:submit.prevent="createUser" class="mt-5">
    @csrf
    <div class="flex flex-col lg:flex-row items-center gap-3">
        <x-elements.inputs.textfield type="text" livewire="yes" name="firstname" label="Prénom" require="yes" class="flex-1" placeholder="Entrez votre prénom"/>
        <x-elements.inputs.textfield type="text" livewire="yes" name="lastname" label="Nom" require="yes" class="flex-1" placeholder="Entrez votre nom"/>
    </div>
    <x-elements.inputs.textfield type="tel" livewire="yes" name="phone" label="Numéro de téléphone" require="" class="mt-3" placeholder="Entrez votre numéro de téléphone"/>
    <x-elements.inputs.textfield type="email" livewire="yes" name="email" label="Adresse e-mail" require="yes" class="mt-3" placeholder="Entrez votre adresse e-mail"/>
    <div class="flex items-center flex-col lg:flex-row gap-3 mt-3">
        <x-elements.inputs.textfield type="password" livewire="yes" name="password" label="Mot de passe" require="yes" class="flex-1" placeholder="Entrez votre mot de passe"/>
        <x-elements.inputs.textfield type="password" livewire="yes" name="password_confirmation" label="Mot de passe (vérification)" require="yes" class="flex-1" placeholder="Entrez votre mot de passe (vérification)"/>
    </div>
    @if($professionnal)
        <div>
            <hr class="my-3">
            <h2 class="font-title font-bold text-xl">Information sur votre entreprise</h2>
            <p class="text-slate-400 mt-2">
                Les informations suivantes sont nécessaires pour la création de votre compte professionnel. Votre compte professionnel sera soumis a une vérification et vous serez averti lorsqu'il sera validé.
            </p>
            <x-elements.inputs.textfield type="text" livewire="yes" name="company_name" label="Nom de votre société" require="yes" class="mt-3" placeholder="Entrez le nom de votre société"/>
            <x-elements.inputs.textfield type="text" livewire="yes" name="company_commercial" label="Nom commerciale" require="" class="mt-3" placeholder="Entrez le nom commerciale (laissez vide s'il est le même que celui de la société)"/>
            <x-elements.inputs.textfield type="text" livewire="yes" name="company_siret" label="Numéro de SIRET" require="yes" class="mt-3" placeholder="Entrez votre numéro de SIRET"/>
            <div class="flex items-center flex-col lg:flex-row gap-3 mt-3">
                <x-elements.inputs.textfield type="text" livewire="yes" name="company_rcs" label="Numéro d'entreprise (RCS)" require="yes" class="flex-1" placeholder="Entrez votre numéro RCS"/>
                <x-elements.inputs.textfield type="text" livewire="yes" name="company_tva" label="Numéro de TVA" require="" class="flex-1" placeholder="Entrez votre numéro de TVA"/>
            </div>
        </div>
    @endif
    <div class="mt-3 ml-3">
        <input type="checkbox" wire:model.live="professionnal" id="professionnal">
        <label for="professionnal" class="hover:cursor-pointer">Je suis un professionnel</label>
    </div>
    <div class="mt-3 ml-3">
        <input type="checkbox" wire:model.live="consent" id="consent" required>
        <label for="consent" class="hover:cursor-pointer">J'accepte les conditions générales d'utilisation et la politique de confidentialité</label>
    </div>
    <x-elements.buttons.btn-submit class="w-full mt-5" label="Créer un compte" icon="arrow-right"/>
</form>
