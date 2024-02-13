<form wire:submit.prevent="updateGroupUser">
    @csrf
    <div class="flex flex-col">
        <label for="newGroup">Sélectionnez le nouveau groupe :</label>
        <select wire:model="newGroup" name="newGroup" id="newGroup"
                class=" outline-none border-none rounded-md py-2 pl-4 mt-2">
            <option value="">-- Sélectionner un groupe --</option>
            @foreach ($allGroups as $allGroup)
                <option value="{{ $allGroup->id }}">{{ $allGroup->title }}</option>
            @endforeach
        </select>
    </div>
    @if($newGroup != $group->id && $newGroup != null)
        <button type="submit" class="btn-secondary mt-5 block w-full">Déplacer dans ce groupe</button>
    @endif
    @if($newGroup == $group->id)
        <p class="text-sm text-slate-400 text-center mt-2">Vous faîte déjà parti de ce groupe</p>
    @endif
</form>
