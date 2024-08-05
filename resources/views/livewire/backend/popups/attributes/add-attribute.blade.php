<div>
    <x-templates.header-popup label="Ajouter un nouvelle attribut" icon=""/>
    <div class="p-5">
        <form wire:submit.prevent="addAttribute">
            @csrf
            <div class="flex items-center border bg-slate-100 rounded-lg overflow-hidden divide-x">
                <label for="color" class="flex-1">
                    <input type="radio" name="type" wire:model.live="type" value="color" id="color" hidden>
                    <div class="inline-flex items-center justify-center py-3 w-full cursor-pointer @if($type == 'color') bg-primary hover:bg-primary/30 @else hover:bg-slate-200 @endif">
                        <i class="fa-solid fa-droplet mr-3"></i>Couleurs
                    </div>
                </label>
                <label for="size" class="flex-1">
                    <input type="radio" name="type" wire:model.live="type" value="size" id="size" hidden>
                    <div class="inline-flex items-center justify-center py-3 w-full cursor-pointer @if($type == 'size') bg-primary hover:bg-primary/30 @else hover:bg-slate-200 @endif">
                        <i class="fa-solid fa-text-size mr-3"></i>Textes
                    </div>
                </label>
            </div>
            <x-elements.inputs.textfield type="text" name="name" label="Nom de l'attribut" placeholder="Entrez le nom de l'attribut" livewire="yes" class="mt-3" require="yes"/>
            <div class="textfield mt-3">
                <label for="group">Groupe d'attribut</label>
                <select id="group" wire:model.live="group">
                    <option value="">Aucun groupe</option>
                    @foreach($groups_attributes as $group)
                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>
            @if($group)
                @if($type == 'color')
                    <x-elements.inputs.textfield type="color" name="color" label="Couleur de l'attribut" placeholder="Entrez la couleur de l'attribut" livewire="yes" class="mt-3" require="yes"/>
                @else
                    <x-elements.inputs.textfield type="text" name="text" label="Texte de l'attribut" placeholder="Entrez le texte de l'attribut" livewire="yes" class="mt-3" require="yes"/>
                @endif
            @endif
            <x-elements.buttons.btn-submit class="mt-5 w-full" label="Ajouter l'attribut" icon=""/>
        </form>
    </div>
</div>
