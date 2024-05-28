<div>
    <x-templates.header-popup label="Sélectionner une catégorie de produit" icon=""/>
    <form wire:submit.prevent="selectCategory">
        @csrf
        <div class="p-5">
            @if($parent_categories->count() > 0)
                <div class="grid grid-cols-3 gap-10">
                    @foreach($parent_categories as $parent)
                        <div>
                            <h2>
                                <div class="font-bold inline-flex items-center justify-between w-full border-b pb-3">
                                    {{ $parent->name }}
                                </div>
                            </h2>
                            <ul class="mt-3">
                                @foreach($child_categories as $child)
                                    @if($child->parent_id == $parent->id)
                                        <li>
                                            <label for="{{ $child->id }}">
                                                <input type="radio" name="category_selected" wire:model.live="category_selected" id="{{ $child->id }}" value="{{ $child->id }}" hidden>
                                                <p class="group cursor-pointer py-1 text-sm rounded-lg text-slate-400 hover:text-blue-500 inline-flex items-center justify-between w-full">
                                                    {{ $child->name }}
                                                    <span class="text-xs invisible group-hover:visible"><i class="fa-solid fa-circle-plus"></i></span>
                                                </p>
                                            </label>
                                        </li>
                                        <ul>
                                            @foreach($child_categories_2 as $sub_child)
                                                @if($sub_child->parent_id_2 == $child->id)
                                                    <li>
                                                        <label for="{{ $sub_child->id }}">
                                                            <input type="radio" name="category_selected" wire:model.live="category_selected" id="{{ $sub_child->id }}" value="{{ $sub_child->id }}" hidden />
                                                            <div class="group cursor-pointer py-1 pl-2 text-sm rounded-lg text-slate-400 hover:text-blue-500 inline-flex items-center justify-between w-full">
                                                                <div>
                                                                    <i class="fa-light fa-arrow-turn-down-right mr-3"></i>
                                                                    {{ $sub_child->name }}
                                                                </div>
                                                                <span class="text-xs invisible group-hover:visible"><i class="fa-solid fa-circle-plus"></i></span>
                                                            </div>
                                                        </label>
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
            @endif
        </div>
        <div class="p-5 text-right border-t inline-flex items-center justify-between w-full">
            <p>
                @if($category_selected)
                    Catégorie sélectionné : <span class="uppercase font-bold">{{ \App\Models\ProductCategory::where('id', $category_selected)->first()->name }}</span>
                @endif
            </p>
            <x-elements.buttons.btn-submit class="" label="Sélectionner" icon="arrow-right"/>
        </div>
    </form>
</div>
