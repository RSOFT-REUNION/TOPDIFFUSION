<div>
    <x-templates.header-popup label="Modifier les stocks" icon=""/>
    <div class="p-5">
        <form wire:submit="editStock">
            @csrf
            <x-elements.inputs.textfield label="Quantité" name="quantity" type="number" placeholder="Entrez une quantité" livewire="yes" require="" class=""/>
            <x-elements.buttons.btn-submit label="Modifier les quantités" class="mt-5 w-full" icon=""/>
        </form>
    </div>
</div>
