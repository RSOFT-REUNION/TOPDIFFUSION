<div class="mt-5">
    <p class="mb-5">Configurez les groupes utilisé par défaut pour les clients qui n'ont pas de groupe spécifique.</p>
    <form wire:submit.prevent="">
        @csrf
        <label for="group_default_customer">
            <div class="inline-flex items-center justify-between w-full py-3" id="group_default_customer">
                <div>
                    <h3>Groupe par défaut pour les particuliers</h3>
                    <p class="text-sm text-slate-400">
                        Vous pouvez définir un groupe par défaut pour les particuliers.
                    </p>
                </div>
                <div class="textfield w-[300px]">
                    <select wire:model.live="group_default_customer" id="group_default_customer">
                        <option value="">Sélectionner un groupe</option>
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </label>
        <label for="group_default_customer">
            <div class="inline-flex items-center justify-between w-full py-3 border-t border-slate-100" id="group_default_customer">
                <div>
                    <h3>Groupe par défaut pour les professionnels</h3>
                    <p class="text-sm text-slate-400">
                        Vous pouvez définir un groupe par défaut pour les professionnels.
                    </p>
                </div>
                <div class="textfield w-[300px]">
                    <select wire:model.live="group_default_customer" id="group_default_customer">
                        <option value="">Sélectionner un groupe</option>
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </label>
    </form>
</div>
