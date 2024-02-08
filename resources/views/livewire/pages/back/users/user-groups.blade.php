<div>
    <div id="entry-header" class="flex items-center">
        <div class="flex-1">
            <h1>Liste des groupes clients</h1>
        </div>
        <div class="flex-none inline-flex items-center">
            <a class="btn-secondary cursor-pointer" wire:click="$emit('openModal', 'popups.back.users.add-groupe-users')">Ajouter un groupe</a>
        </div>
    </div>
    {{-- ENTRY CONTENT --}}
    @if($groups->isEmpty())
        {{-- if we haven't groups --}}
        <p class="text-orange-400 bg-orange-100 py-3 rounded-lg text-center">Attention ! Vous devez noter que tous vos utilisateurs seront automatiquement attribué à votre premier groupe créé !</p>
        <div class="py-4 border-dashed border-2 border-slate-200 flex rounded-lg mt-2">
            <div class="m-auto">
                <p class="text-center text-lg text-slate-400">Vous n'avez pas encore créé de groupe de client</p>
            </div>
        </div>
    @else
        <div id="entry-content" class="grid grid-cols-4 gap-5">
            @foreach($groups as $group)
                <div onclick="Livewire.emit('openModal', 'popups.back.users.edit-group-user', {group_id: {{ $group->id }}})" class="bg-slate-100 rounded-lg duration-300 border border-transparent flex flex-col hover:border-slate-200 group hover:scale-105 cursor-pointer relative">
                    <div class="p-5 grow">
                        <i class="fa-solid fa-pencil absolute top-5 right-5 invisible text-slate-400 group-hover:visible"></i>
                        <h2 class="text-3xl font-bold">{{ $group->title }}</h2>
                        <p class="text-slate-400">{{ $group->description }}</p>
                    </div>
                    <div class="p-5 border-t border-slate-200">
                        <div class="block w-full">
                            <p>Pourcentage de remise accordé</p>
                            @if($group->discount > 0)
                            <div class="flex items-center gap-2 mt-2">
                                <div class="flex-1">
                                    <progress value="{{ $group->discount / 100 }}" class="HI_TW_progress-light"></progress>
                                </div>
                                <div class="flex-none">
                                    <p class="text-sm text-slate-400">{{ number_format($group->discount, '0') }} %</p>
                                </div>
                            </div>
                            @else
                                <p class="bg-slate-200 text-center py-2 rounded-md mt-2">Aucune remise accordée</p>
                            @endif
                        </div>
                        <div class="block w-full inline-flex mt-3 justify-end">
                            <div class="p-3 aspect-square bg-slate-200 rounded-full border-2 border-slate-100">
                                BH
                            </div>
                            <div class="p-3 aspect-square bg-slate-200 rounded-full border-2 border-slate-100 -ml-5">
                                JD
                            </div>
                            <div class="p-3 aspect-square bg-slate-200 rounded-full border-2 border-slate-100 -ml-5">
                                JD
                            </div>
                            <div class="p-3 aspect-square bg-slate-200 rounded-full border-2 border-slate-100 -ml-5">
                                +6
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
