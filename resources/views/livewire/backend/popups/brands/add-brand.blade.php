<div>
    <x-templates.header-popup label="Ajouter une marque" icon=""/>
    <div class="p-5">
        <p class="text-sm text-slate-400"><i class="fa-regular fa-circle-info mr-3"></i>Afin d'éviter un mauvaise affichage des logos, il est préférable d'utiliser le format SVG et d'éviter les logos blancs</p>
        <form wire:submit.prevent="addBrand" enctype="multipart/form-data" class="mt-5">
            @csrf
            <x-elements.inputs.textfield type="text" name="name" label="Nom de la marque" livewire="yes" require="yes" placeholder="Entrez le nom de la marque" class=""/>
            <x-elements.inputs.textfield type="file" name="logo" label="Logo de la marque" livewire="yes" require="yes" placeholder="" class="mt-3"/>
            <x-elements.inputs.textfield type="text" name="url" label="URL de la marque" livewire="yes" require="" placeholder="Entrez l'url du site officiel de la marque" class="mt-3"/>
            <x-elements.buttons.btn-submit class="mt-5 w-full" icon="" label="Ajouter la marque"/>
        </form>
    </div>
</div>
