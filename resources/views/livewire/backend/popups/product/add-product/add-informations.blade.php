<div>
    <x-templates.header-popup label="Information supplémentaire" icon=""/>
    <form wire:submit.prevent="addInfos">
        @csrf
        <div class="p-5">
            <p class="">Lorsque vous entrez une clé et une valeur, les informations seront afficher dans les détails du produit. Exemple "Largeur: 115mm"</p>
            <div class="mt-3 text-slate-400 italic text-sm">
                <p><b>Il s'agit d'une chaine : </b>Vous devez ajouter les clés suivante : Pas, Longueur, Couleur, Type</p>
                <p><b>Il s'agit d'un pignon : </b>Vous devez ajouter les clés suivante : Pas, Denture, Matière</p>
                <p><b>Il s'agit d'une couronne : </b>Vous devez ajouter les clés suivante : Pas, Denture, Matière</p>
            </div>
            <x-elements.inputs.textfield type="text" label="Clé" name="key" class="mt-5" livewire="yes" require="" placeholder="Entrez une clé (exemple: Largeur)"/>
            <x-elements.inputs.textfield type="text" label="Valeur" name="value" class="mt-3" livewire="yes" require="" placeholder="Entrez une valeur (exemple: 115mm)"/>
            <x-elements.buttons.btn-submit class="mt-5 w-full" label="Ajouter" icon="arrow-right"/>
        </div>
    </form>
</div>
