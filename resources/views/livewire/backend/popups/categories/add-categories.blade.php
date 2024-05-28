<div>
    <x-templates.header-popup label="Ajouter une catégorie" icon=""/>
    <div class="p-5">
        <form wire:submit.prevent="addCategory" enctype="multipart/form-data">
            @csrf
            <x-elements.inputs.textfield type="text" label="Nom de la catégorie" placeholder="Entrez un nom pour votre catégorie" livewire="yes" class="" name="name" require="yes"/>
            <x-elements.inputs.textfield type="textarea" label="Description" placeholder="Entrez une description" livewire="yes" class="mt-2" name="description" require="yes"/>
            <x-elements.inputs.textfield type="file" label="Icône" placeholder="" livewire="yes" class="mt-2" name="icon" require=""/>
            <hr class="my-2">
            <p class="mb-3 text-sm text-slate-400">Vous pouvez commencer à taper le nom du catégorie et ensuite sélectionner parmis les choix proposés (ex: "mo" pour "Moto")</p>
            <div class="textfield">
                <label for="parent">Catégorie parent</label>
                <input type="text" id="parent" wire:model.live="parent" placeholder="Entrez le nom de la catégorie parente">
                @if(count($suggestion) > 0)
                    <div class="p-3">
                        @foreach($suggestion as $index => $suggest)
                            <a href="" wire:click.prevent="selectParent('{{ $suggest['id'] }}')" class="block py-2 px-3 bg-slate-200 border text-sm border-slate-200 rounded-lg mt-2 hover:bg-primary hover:text-white">{{ $suggest['name'] }}</a>
                        @endforeach
                    </div>
                @endif
            </div>
            @if($categoryChoice)
                <div class="mt-3 bg-primary/30 py-2 px-4 rounded-md inline-flex items-center justify-between w-full">
                    <p class="">Catégorie parente sélectionnée :</p>
                    <p class="font-bold font-title">{{ $categoryChoice }}</p>
                </div>
            @endif
            <x-elements.buttons.btn-submit label="Ajouter la catégorie" class="mt-5 w-full" icon=""/>
        </form>
    </div>
</div>
