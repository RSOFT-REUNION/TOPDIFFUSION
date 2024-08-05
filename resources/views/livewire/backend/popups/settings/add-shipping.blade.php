<div>
    <x-templates.header-popup label="Ajouter des frais de livraison" icon=""/>
    <form wire:submit="addShipping" class="p-5">
        @csrf
        <x-elements.inputs.textfield label="Montant" placeholder="Entrez le montant" name="amount" type="number" class="" livewire="yes" require=""/>
        <x-elements.inputs.textfield label="À partir de combien (en euros sur le tarif HT)" placeholder="Entrez à partir de combien (en euros sur le tarif HT)" name="cible" type="number" class="mt-3" livewire="yes" require=""/>
        <x-elements.buttons.btn-submit label="Ajouter" class="mt-5 w-full" icon=""/>
    </form>
</div>
