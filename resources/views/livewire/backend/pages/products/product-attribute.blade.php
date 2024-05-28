<div>
    <div class="inline-flex items-center justify-between w-full">
        <h1 class="font-title font-bold text-2xl">Attributs de produits</h1>
        <div>
            <button wire:click="$dispatch('openModal', {component: 'backend.popups.categories.add-categories-import'})" class="btn-slate-icon mr-2" title="Importer une liste de catégories"><i class="fa-regular fa-arrow-up-from-line"></i></button>
            <button wire:click="$dispatch('openModal', {component: 'backend.popups.attributes.add-attribute'})" class="btn-primary"><i class="fa-solid fa-plus mr-3"></i>Ajouter une nouvelle attribut</button>
        </div>
    </div>
    <div class="mt-5">
        <p class="border p-2 rounded-lg bg-slate-100 text-slate-400">
            Les attributs vous permets de créer des déclinaisons de produits. Par exemple, si vous vendez des t-shirts, vous pouvez ajouter des attributs de taille et de couleur.
        </p>
    </div>
    @if($attributes->count() > 0)
        <div class="grid grid-cols-4 gap-5 mt-10">
            @foreach($attribute_groups as $group)
                <div>
                    <div class="border-b pb-2 inline-flex items-center justify-between w-full group">
                        <h2 class="font-bold">{{ $group->name }}</h2>
                        <button wire:click="" wire:confirm="Êtes-vous sûr de vouloir supprimer ce groupe ?" class="text-red-500 invisible cursor-pointer group-hover:visible"><i class="fa-regular fa-delete-left"></i></button>
                    </div>
                    @if($attribute_items->count() > 0)
                        <ul class="mt-3 *:text-slate-400 *:py-1">
                            @foreach($attribute_items as $item)
                                @if($item->group_id == $group->id)
                                    <li class="inline-flex items-center justify-between w-full group">
                                        <div class="inline-flex items-center gap-2">
                                            @if($item->type == 'color')
                                                <div class="inline-flex ring-1 items-center justify-center w-5 h-5 rounded-full" style="background-color: {{ $item->variable }}"></div>
                                            @else
                                                <span class="bg-slate-100 py-1 px-2 text-sm rounded-full">{{ $item->variable }}</span>
                                            @endif
                                            <span>| {{ $item->name }}</span>
                                        </div>
                                        <button wire:click="" wire:confirm="Êtes-vous sûr de vouloir supprimer cet attribut ?" class="text-red-500 invisible cursor-pointer group-hover:visible"><i class="fa-regular fa-delete-left"></i></button>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endforeach
        </div>
    @else
    @endif
</div>
