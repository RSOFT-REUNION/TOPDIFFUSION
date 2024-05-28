<div>
    <x-templates.header-popup label="{{ $category->name }}" icon=""/>
    <div class="p-5">
        <p class="">Vous pouvez configurer les pourcentages de remises accordés aux groupes de clients pour cette catégorie.</p>
        <form wire:submit.prevent="submitDiscount">
            @csrf
            @foreach($customer_groups as $group)
                <x-elements.inputs.textfield type="number" name="discounts.{{ $group->id }}" label="Remise pour le groupe: {{ $group->getGroupName() }}" livewire="yes" require="" class="my-2" placeholder="Entrez un pourcentage de remise"/>
            @endforeach
            <div class="inline-flex items-center justify-between w-full mt-3">
                <button wire:click="deleteCategory" class="btn-danger">Supprimer la catégorie</button>
                <x-elements.buttons.btn-submit label="Enregistrer les modifications" class="" icon="floppy-disk"/>
            </div>
        </form>
    </div>
    <div class="p-5 border-t">
    </div>
</div>
