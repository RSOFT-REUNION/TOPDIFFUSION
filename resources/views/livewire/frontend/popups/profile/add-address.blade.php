<div>
    <x-templates.header-popup label="Ajouter une adresse de livraison à votre compte" icon="" />
    <div class="p-5">
        <form wire:submit="submit">
            @csrf
            <x-elements.inputs.textfield type="text" label="Adresse" name="address" placeholder="Entrez votre adresse" class="" livewire="yes" require="yes" />
            <x-elements.inputs.textfield type="text" label="Adresse (bis)" name="address_bis" placeholder="Entrez votre adresse (bis)" class="mt-3" livewire="yes" require="" />
            <x-elements.inputs.textfield type="text" label="Code postal" name="zip_code" placeholder="Entrez votre code postal" class="mt-3" livewire="yes" require="" />
            <x-elements.inputs.textfield type="text" label="Ville" name="city" placeholder="Entrez votre ville" class="mt-3" livewire="yes" require="" />
            <label class="inline-flex items-center cursor-pointer mt-3">
                <input type="checkbox" value="" wire:model.live="is_default" class="sr-only peer">
                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Il s'agit de mon adresse par défaut</span>
            </label>
            <x-elements.buttons.btn-submit class="mt-5 w-full" label="Ajouter l'adresse" icon="" />
        </form>
    </div>
</div>
