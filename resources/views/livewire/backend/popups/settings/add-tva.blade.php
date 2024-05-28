<div>
    <x-templates.header-popup label="Ajouter une règle de TVA" icon=""/>
    <div class="p-5">
        <p class="text-slate-400 border p-2 rounded-lg bg-slate-100">S'il s'agit de votre première règle, vous devez la spécifier en tant que "règle par défaut"</p>
        <form wire:submit="addTva" class="mt-5">
            @csrf
            <x-elements.inputs.textfield type="text" label="Nom de votre règle" name="name" placeholder="Entrez un nom pour votre règle" class="" livewire="yes" require=""/>
            <x-elements.inputs.textfield type="text" label="Code pays" name="country" placeholder="Exemple (RE pour la Réunion ou FR pour la France, ...)" class="mt-3" livewire="yes" require=""/>
            <x-elements.inputs.textfield type="text" label="Code état" name="state" placeholder="Exemple (974 pour la Réunion, ...)" class="mt-3" livewire="yes" require=""/>
            <hr class="my-3">
            <x-elements.inputs.textfield type="number" label="Taux de TVA" name="amount" placeholder="Exemple (8.5 pour la Réunion, ...)" class="" livewire="yes" require=""/>
            <hr class="my-3">
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" value="" wire:model.live="default" class="sr-only peer">
                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Règle de TVA par défaut pour tous mes produits</span>
            </label>
            <div class="mt-5">
                <x-elements.buttons.btn-submit label="Ajouter" class="w-full" icon=""/>
            </div>
        </form>
    </div>
</div>
