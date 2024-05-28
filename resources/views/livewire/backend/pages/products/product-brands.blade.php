<div>
    <div class="inline-flex items-center justify-between w-full">
        <h1 class="font-title font-bold text-2xl">Marques produits</h1>
        <div>
            <button wire:click="$dispatch('openModal', {component: 'backend.popups.categories.add-categories-import'})" class="btn-slate-icon mr-2" title="Importer une liste de catégories"><i class="fa-regular fa-arrow-up-from-line"></i></button>
            <button wire:click="$dispatch('openModal', {component: 'backend.popups.brands.add-brand'})" class="btn-primary"><i class="fa-solid fa-plus mr-3"></i>Ajouter une nouvelle marque</button>
        </div>
    </div>
    <div class="mt-10">
        @if($brands->count() > 0)
            <div class="grid grid-cols-5 gap-5">
                @foreach($brands as $brand)
                    <div class="bg-slate-100 rounded-xl border p-5 relative cursor-pointer flex flex-col h-full duration-300 hover:bg-white hover:scale-105">
                        <div class="m-auto">
                            <div class="force-center">
                                <img src="{{ asset('storage/products/brands/'. $brand->logo) }}" width="150px">
                            </div>
                            <p class="text-center mt-3">{{ $brand->name }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-5">
                {{ $brands->links() }}
            </div>
        @else
            <div class="flex h-full">
                <div class="m-auto">
                    <p class="text-slate-400">Vous n'avez pas encore ajouté de marque</p>
                </div>
            </div>
        @endif
    </div>
</div>
