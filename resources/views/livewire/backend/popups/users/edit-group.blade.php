<div>
    <x-templates.header-popup label="Modification de votre groupe" icon=""/>
    <div class="p-5">
        <form wire:submit.prevent="editGroup">
            @csrf
            <x-elements.inputs.textfield type="text" livewire="yes" name="name" require="yes" label="Nom du groupe" class="" placeholder="Entrez le nom du groupe"/>
            <x-elements.inputs.textfield type="textarea" livewire="yes" name="description" require="" label="Description du groupe" class="mt-3" placeholder="Entrez une description pour ce groupe"/>
            <hr class="my-3">
            <h2 class="font-title font-bold text-lg">Avantage accordé</h2>
            <x-elements.inputs.textfield type="number" livewire="yes" name="discount" require="" label="Pourcentage de remise" class="mt-3" placeholder="Entrez le un pourcentage souhaité"/>
            <x-elements.buttons.btn-submit label="Modifier le groupe" class="mt-5 w-full" icon=""/>
        </form>
    </div>
</div>
