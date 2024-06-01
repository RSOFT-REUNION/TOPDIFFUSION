<div>
    <x-templates.header-popup label="Ajouter un point relais" icon=""/>
    <form wire:submit="addShippingPoint" class="p-5">
        @csrf
        <x-elements.inputs.textfield label="Nom du point relais" placeholder="Entrez le nom du magasin ou de l'organisme" name="name" type="text" class="" livewire="yes" require="yes"/>
        <x-elements.inputs.textfield label="Adresse" placeholder="Entrez une adresse" name="address" type="text" class="mt-3" livewire="yes" require="yes"/>
        <x-elements.inputs.textfield label="Adresse (bis)" placeholder="Entrez une adresse (bis)" name="address_bis" type="text" class="mt-3" livewire="yes" require=""/>
        <div class="flex items-center gap-3 mt-3">
            <x-elements.inputs.textfield label="Code postal" placeholder="Entrez un code postal" name="zip_code" type="text" class="flex-1" livewire="yes" require="yes"/>
            <x-elements.inputs.textfield label="Ville" placeholder="Entrez une ville" name="city" type="text" class="flex-1" livewire="yes" require="yes"/>
        </div>
        <x-elements.inputs.textfield label="Numéro de téléphone" placeholder="Entrez le numéro de téléphone" name="phone" type="tel" class="mt-3" livewire="yes" require=""/>
        <x-elements.buttons.btn-submit label="Ajouter" class="mt-5 w-full" icon=""/>
    </form>
</div>
