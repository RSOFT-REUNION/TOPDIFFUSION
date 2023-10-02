<div>
    <div id="entry-header">
        <div class="flex-1 inline-flex items-center">
            <div class="my-2 mr-7">
                <a onclick="window.history.back()" class="bg-secondary px-5 py-2 rounded-lg dark:bg-gray-700 cursor-pointer">
                    <i class="fa-solid fa-arrow-left-long"></i>
                </a>
            </div>
            <h1>Catégories {{ $findCategory->title }}</h1>
        </div>

        @if(count($groups) > 0)
            @foreach ($groups as $group)
                <div class="flex flex-row justify-between items-center border-b border-b-gray-200 pb-4 mt-4">
                    <div>
                        <h2 class="font-medium mb-1">Groupe {{ $group->name }}</h2>
                        <p class="text-[13px] text-[#808080]">Configurer le pourcentage de remise pour ce groupe</p>
                    </div>
                    <form wire:submit.prevent="updateDiscountPercentage({{ $group->id }})" class="inline-flex items-center">
                        @csrf
                        <div>
                            <label>
                                <input type="text"  wire:model="discountPercentages.{{ $group->id }}" placeholder="Entrez le pourcentage de remise..." class="focus:outline-none p-3 rounded-lg w-80 bg-gray-200 border border-gray-300 text-sm">
                            </label>
                        </div>
{{--                        {{ dd($group->pivot->discount_percentage) }}--}}
                    @if ($discountPercentages[$group->id])
                        <button type="submit" class="ml-2 bg-[#FBBC34] px-4 py-2.5 rounded-lg"><i class="fa-solid fa-floppy-disk"></i></button>
                        @endif
                    </form>
                </div>
            @endforeach
        @else
            <div class="flex flex-row justify-between items-center border-b border-b-gray-200 pb-4 mt-4">
                <p>Pas de groupes créés pour le moment</p>
                <a href="{{ route('back.user.userGroup') }}" class="bg-secondary px-1.5">Créer un groupe</a>
            </div>
        @endif

    </div>
</div>
