<div>
    <x-templates.header-popup label="Modifier votre produit" icon=""/>
    <div class="p-5">
        <form wire:submit="editProduct" enctype="multipart/form-data">
            @csrf
            @if($cover)
                <div class="relative">
                    <div class="force-center">
                        <div class="aspect-square bg-slate-100 w-1/2 rounded-xl overflow-hidden">
                            <img src="{{ $cover != $product->cover ? $cover->temporaryUrl() : asset('storage/products/covers/'. $cover) }}" alt="Photo du produit" class="object-cover w-full h-full">
                        </div>
                    </div>
                    <label for="cover" class="absolute bottom-10 right-10">
                        <input type="file" id="cover" wire:model.live="cover" hidden>
                        <p class="border  bg-slate-100 py-2 px-4 rounded-lg duration-300 hover:bg-slate-200 cursor-pointer">Modifier la photo</p>
                        @error('cover')
                        <p class="text-sm mt-1 text-red-500 text-center">{{ $message }}</p>
                        @enderror
                    </label>
                </div>
            @else
                <div class="flex">
                    <div class="m-auto">
                        <label for="cover">
                            <input type="file" id="cover" wire:model.live="cover" hidden>
                            <p class="border bg-slate-100 py-2 px-4 rounded-lg duration-300 hover:bg-slate-200 cursor-pointer">Ajouter une photo produit</p>
                            @error('cover')
                            <p class="text-sm mt-1 text-red-500 text-center">{{ $message }}</p>
                            @enderror
                        </label>
                    </div>
                </div>
            @endif
            <div class="mt-5">
                <x-elements.inputs.textfield label="Nom du produit" type="text" name="name" placeholder="Nom du produit" class="" livewire="yes" require=""/>
                <x-elements.inputs.textfield label="Description du produit" type="textarea" name="description" placeholder="Entrez une description pour le produit" class="mt-3" livewire="yes" require=""/>
                <x-elements.inputs.textfield label="Mots clés" type="text" name="keywords" placeholder="Entrez des mots clés séparé par des virgules" class="mt-3" livewire="yes" require=""/>
                <hr class="my-3">
                <x-elements.inputs.textfield label="Prix HT" type="number" name="price" placeholder="Entrez un montant" class="" livewire="yes" require=""/>
                <x-elements.buttons.btn-submit label="Modifier le produit" class="mt-3 w-full" icon=""/>
            </div>
        </form>
    </div>
</div>
