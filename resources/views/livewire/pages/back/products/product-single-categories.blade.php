<div>
    <div id="entry-header">
        <div class="flex-1 inline-flex items-center">
            <div class="my-2 mr-7">
                <a onclick="window.history.back()" class="bg-secondary px-5 py-2 rounded-lg dark:bg-gray-700 cursor-pointer">
                    <i class="fa-solid fa-arrow-left-long"></i>
                </a>
            </div>
            <h1>Catégories {{ $category->title }}</h1>
        </div>
    </div>
    <div id="entry-content">
        @if($groups->count() > 0)
            <ul>
                @foreach($groups as $group)
                    <li class="border-b border-slate-100">
                        <div class="flex items-center py-3">
                            <div class="flex-1">
                                <p class="text-xl font-medium">{{ $group->getInfos()->title }}</p>
                                <p class="text-sm text-slate-400">{{ $group->getInfos()->description }}</p>
                            </div>
                            <div class="flex-none w-1/4">
                                <form wire:submit.prevent="updateDiscountPercentage({{ $group->getInfos()->id }})" class="flex items-center">
                                    <div class="textfield-line w-[200px] flex-1">
                                        <input type="range" min="0" max="100" wire:model="discountPercentages.{{ $group->id }}" value="{{ $group->discount }}">
                                        <p class="ml-3 w-1/4 text-center">{{ $discountPercentages[$group->id] }} %</p>
                                    </div>
                                    <div class="flex-none ml-2">
                                        @if($discountPercentages[$group->id] != $group->discount)
                                            <button class="aspect-square p-2 bg-slate-100 rounded-md duration-300 hover:bg-secondary"><i class="fa-solid fa-floppy-disk"></i></button>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="bg-slate-100 py-3 text-center rounded-md text-slate-400">
                Vous n'avez pas encore configuré de groupe de client, <a href="" class="underline">configurez-en un dès maintenant</a> !
            </p>
        @endif
    </div>
</div>
