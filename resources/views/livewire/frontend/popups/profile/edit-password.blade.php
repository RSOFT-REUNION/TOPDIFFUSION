<div>
    <x-templates.header-popup label="Modifier mon mot de passe" icon="" />
    <div class="p-5">
        <form wire:submit="submit">
            @csrf
            <x-elements.inputs.textfield type="password" label="Mot de passe" name="password" placeholder="Entrez un mot de passe" class="" livewire="yes" require="yes" />
            <x-elements.inputs.textfield type="password" label="Mot de passe (confirmation)" name="password_confirmation" placeholder="Retapez votre mot de passe" class="mt-3" livewire="yes" require="yes" />
            <x-elements.buttons.btn-submit class="mt-5 w-full" label="Modifier" icon="" />
        </form>
    </div>
</div>
