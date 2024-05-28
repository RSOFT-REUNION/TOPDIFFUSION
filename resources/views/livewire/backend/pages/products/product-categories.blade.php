<div>
    <div class="inline-flex items-center justify-between w-full">
        <h1 class="font-title font-bold text-2xl">Catégories de produits</h1>
        <div>
            <button wire:click="$dispatch('openModal', {component: 'backend.popups.categories.add-categories-import'})" class="btn-slate-icon mr-2" title="Importer une liste de catégories"><i class="fa-regular fa-arrow-up-from-line"></i></button>
            <button wire:click="$dispatch('openModal', {component: 'backend.popups.categories.add-categories'})" class="btn-primary"><i class="fa-solid fa-plus mr-3"></i>Ajouter une nouvelle catégorie</button>
        </div>
    </div>
    <div class="mt-10">
        @if($parent_categories->count() > 0)
            <div class="grid grid-cols-3 gap-10">
                @foreach($parent_categories as $parent)
                    <div>
                        <h2>
                            <div class="font-bold inline-flex items-center justify-between w-full border-b pb-3">
                                {{ $parent->name }}
                                <span class="text-sm font-thin border py-1 px-2 rounded-full">123</span>
                            </div>
                        </h2>
                        <ul class="mt-3">
                            @foreach($child_categories as $child)
                                @if($child->parent_id == $parent->id)
                                    <li>
                                        <a wire:click="$dispatch('openModal', {component: 'backend.popups.categories.edit-categories', arguments: { category_id: {{ $child->id }} }})" class="block cursor-pointer py-1 text-sm rounded-lg text-slate-400 hover:text-blue-500 inline-flex items-center justify-between w-full">
                                            {{ $child->name }}
                                            <span class="text-xs font-thin border py-1 px-2 rounded-full">123</span>
                                        </a>
                                    </li>
                                    <ul>
                                        @foreach($child_categories_2 as $sub_child)
                                            @if($sub_child->parent_id_2 == $child->id)
                                                <li>
                                                    <a wire:click="$dispatch('openModal', {component: 'backend.popups.categories.edit-categories', arguments: { category_id: {{ $sub_child->id }} }})" class="block cursor-pointer py-1 pl-2 text-sm rounded-lg text-slate-400 hover:text-blue-500 inline-flex items-center justify-between w-full">
                                                        <div>
                                                            <i class="fa-light fa-arrow-turn-down-right mr-3"></i>
                                                            {{ $sub_child->name }}
                                                        </div>
                                                        <span class="text-xs font-thin border py-1 px-2 rounded-full">123</span>
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        @else
            <div class="flex h-[500px]">
                <div class="m-auto">
                    <p class="text-slate-400 text-center">C'est vide ici !<br>Ajoutez votre première catégorie</p>
                </div>
            </div>
        @endif
    </div>
</div>
