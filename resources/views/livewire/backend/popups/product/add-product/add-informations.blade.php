<div>
    <x-templates.header-popup label="Information supplémentaire" icon=""/>
    <form wire:submit.prevent="addInfos">
        @csrf
        <div class="p-5">
            <p class="">Lorsque vous entrez une clé et une valeur, les informations seront afficher dans les détails du produit. Exemple "Largeur: 115mm"</p>
            <x-elements.inputs.textfield type="text" label="Clé" name="key" class="mt-5" livewire="yes" require="" placeholder="Entrez une clé (exemple: Largeur)"/>
            <x-elements.inputs.textfield type="text" label="Valeur" name="value" class="mt-3" livewire="yes" require="" placeholder="Entrez une valeur (exemple: 115mm)"/>
            <x-elements.buttons.btn-submit class="mt-5 w-full" label="Ajouter" icon="arrow-right"/>
        </div>
    </form>
</div>
