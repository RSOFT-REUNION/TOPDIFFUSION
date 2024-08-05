<div>
    <x-templates.header-popup label="Ajouter une variante" icon=""/>
    <div class="p-5">
        <form wire:submit="addVariant">
            @csrf
            @if($attribute_groups->count() > 0)
                @foreach($attribute_groups as $group)
                    <div class="my-5">
                        <h2 class="font-title font-bold">{{ $group->name }}</h2>
                        <div class="mt-3">
                            @foreach($attribute_items as $items)
                                @if($items->group_id == $group->id)
                                    <label for="{{ $items->id }}">
                                        <input type="checkbox" wire:model.live="selectedAttributes" id="{{ $items->id }}" value="{{ $items->id }}" class="mr-2" hidden>
                                        @if($items->type == 'color')
                                            <div class="mr-3 bg-slate-100 border p-2 rounded-full inline-flex items-center @if(in_array($items->id, $selectedAttributes)) border-2 border-primary @endif gap-2 hover:ring-1 hover:ring-offset-2 cursor-pointer">
                                                <div class="w-5 h-5 inline-block rounded-full" style="background-color: {{ $items->variable }}"></div>
                                                <span class="text-slate-400">{{ $items->name }}</span>
                                            </div>
                                        @else
                                            <div class="mr-3 bg-slate-100 border p-2 rounded-full inline-flex items-center gap-2 hover:ring-1 hover:ring-offset-2 cursor-pointer @if(in_array($items->id, $selectedAttributes)) border-2 border-primary @endif">
                                                <span class="text-slate-400">{{ $items->name }}</span>
                                            </div>
                                        @endif
                                    </label>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @else
                <p class="">Vous devez ajouter des attributs au préalable au niveau des "attributs"</p>
            @endif
            <x-elements.buttons.btn-submit class="mt-5 w-full" icon="" label="Ajouter"/>
        </form>
    </div>
</div>
