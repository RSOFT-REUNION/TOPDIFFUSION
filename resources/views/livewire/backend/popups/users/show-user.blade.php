<div>
    <x-templates.header-popup label="Affichage de l'utilisateur" icon=""/>
    <div class="p-5">
        <form wire:submit="editGroup">
            @csrf
            <div class="textfield">
                <label for="group">Groupe du client</label>
                <select wire:model="group" id="group"  class="w-full">
                    <option value="">--</option>
                    @foreach($groups as $group)
                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>
            <x-elements.buttons.btn-submit label="Modifier le groupe" class="w-full mt-3" icon=""/>
        </form>
    </div>
</div>
