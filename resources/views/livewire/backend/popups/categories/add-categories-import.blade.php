<div>
    <x-templates.header-popup label="Importer une liste de catégories" icon=""/>
    <div class="p-5">
        <form wire:submit.prevent="importCategories" enctype="multipart/form-data">
            @csrf
            <x-elements.inputs.textfield type="file" label="Fichier CSV" placeholder="Sélectionner un fichier" livewire="yes" class="" name="file" require="yes"/>
            <hr class="my-2">
            <p class="mb-3 text-sm text-slate-400">Le fichier doit être au format CSV et doit contenir les colonnes suivantes : "Nom de la catégorie", "Description", "Icône", "Catégorie parente" (optionnel)</p>
            <x-elements.buttons.btn-submit label="Importer les catégories" class="mt-5 w-full" icon=""/>
        </form>
    </div>
</div>
