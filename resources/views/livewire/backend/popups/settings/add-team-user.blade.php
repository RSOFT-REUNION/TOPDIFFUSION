<div>
    <x-templates.header-popup label="Ajouter un membre à l'équipe" icon=""/>
    <div class="p-5">
        <form wire:submit="addTeam">
            @csrf
            <x-elements.inputs.textfield label="Nom" placeholder="Entrez un nom" name="lastname" type="text" class="" livewire="yes" require=""/>
            <x-elements.inputs.textfield label="Prénom" placeholder="Entrez un prénom" name="firstname" type="text" class="mt-3" livewire="yes" require=""/>
            <x-elements.inputs.textfield label="Adresse e-mail" placeholder="Entrez une adresse e-mail" name="email" type="email" class="mt-3" livewire="yes" require=""/>
            <x-elements.inputs.textfield label="Mot de passe" placeholder="Entrez un mot de passe" name="password" type="password" class="mt-3" livewire="yes" require=""/>
            <div class="textfield mt-3">
                <label for="type">Type de membre</label>
                <select wire:model.live="type" id="type">
                    <option value="">Sélectionner un type</option>
                    <option value="2">Administrateur</option>
                    <option value="3">Support</option>
                </select>
            </div>
            <x-elements.buttons.btn-submit class="mt-5 w-full" label="Enregistrer" icon="" />
        </form>
    </div>
</div>
