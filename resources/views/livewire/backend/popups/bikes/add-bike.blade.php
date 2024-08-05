<div>
    <x-templates.header-popup label="Ajouter une moto" icon=""/>
    <div class="p-5">
        <form wire:submit.prevent="addBike">
            @csrf
            <x-elements.inputs.textfield type="text" name="brand" label="Marque de la moto" livewire="yes" require="yes" class="" placeholder="Entrez la marque de la moto"/>
            <x-elements.inputs.textfield type="text" name="model" label="Modèle de la moto" livewire="yes" require="yes" class="mt-3" placeholder="Entrez le modèle de la moto"/>
            <x-elements.inputs.textfield type="text" name="cylinder" label="Cylindrée de la moto" livewire="yes" require="yes" class="mt-3" placeholder="Entrez la cylindrée de la moto"/>
            <x-elements.inputs.textfield type="number" name="year" label="Année de la moto" livewire="yes" require="yes" class="mt-3" placeholder="Entrez l'année de la moto"/>
            <x-elements.buttons.btn-submit class="mt-5 w-full" label="Ajouter la moto" icon=""/>
        </form>
    </div>
</div>
