<div>
    <div class="bg-gray-100 p-5">
        <div class="flex items-center">
            <div class="flex-1">
                <h2 class="font-bold text-xl">Motos</h2>
            </div>
            <div class="flex-none">
                <button wire:click.prevent="$emit('closeModal')" type="button" class="py-2 px-2.5 hover:text-red-500"><i class="fa-solid fa-xmark"></i></button>
            </div>
        </div>

    </div>
    <div class="border-b border-gray-100 p-5 text-gray-500">
        <div class="textfield-search items-center">
            <label for="search"><i class="fa-solid fa-magnifying-glass mr-2 ml-2"></i></label>
            <input type="text" wire:model="search" placeholder="Rechercher une marque, un modèle..." class="focus:outline-none">
        </div>
    </div>
    <form wire:submit.prevent="addBikes" class="p-5">
        @csrf
        @if($bikes->count() > 0)
            <div class="table-box-outline mt-2">
                <table>
                    <thead>
                    <tr class="text-center">
                        <th></th>
                        <th>Marque</th>
                        <th>Cylindrée</th>
                        <th>Modèle</th>
                        <th>Année</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bikes as $bike)
                        <tr>
                            <td><input type="checkbox" wire:model="bike_selected" value="{{ $bike->id }}" {{ $checkedBikes ? 'checked' : '' }}></td>
                            <td>{{ $bike->marque }}</td>
                            <td>{{ $bike->cylindree }}</td>
                            <td>{{ $bike->modele }}</td>
                            <td>{{ $bike->annee }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
{{--            @if ($bikes instanceof \Illuminate\Pagination\LengthAwarePaginator && $bikes->hasPages())--}}
{{--                <div class="flex mt-7">--}}
{{--                    <nav class="flex flex-row items-center justify-center w-full">--}}
{{--                        @if ($bikes->onFirstPage())--}}
{{--                            <span aria-disabled="true" wire:click.prevent="setPage({{ $bikes->currentPage() - 1 }})">--}}
{{--                            <span class="relative inline-flex items-center px-4 py-[11px] -ml-px text-sm font-medium text-gray-300 rounded-l-lg bg-white border border-gray-300 cursor-default leading-5"><i class="fa-solid fa-angle-left"></i></span>--}}
{{--                        </span>--}}
{{--                        @else--}}
{{--                            <span aria-disabled="true" wire:click.prevent="setPage({{ $bikes->currentPage() - 1 }})">--}}
{{--                            <span class="relative inline-flex items-center px-4 py-[11px] -ml-px text-sm font-medium text-gray-700 bg-white rounded-l-lg border border-gray-300 cursor-pointer leading-5 hover:text-black hover:bg-secondary "><i class="fa-solid fa-angle-left"></i></span>--}}
{{--                        </span>--}}
{{--                        @endif--}}

{{--                        @foreach ($bikes->getUrlRange(1, $bikes->lastPage()) as $page => $url)--}}
{{--                            @if ($page == $bikes->currentPage())--}}
{{--                                <span aria-current="page">--}}
{{--                                <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-300 bg-white border border-gray-300 cursor-default leading-5">{{ $page }}</span>--}}
{{--                            </span>--}}
{{--                            @else--}}
{{--                                <a wire:click.prevent="setPage({{ $page }})" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-black hover:bg-secondary focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 cursor-pointer">--}}
{{--                                    {{ $page }}--}}
{{--                                </a>--}}
{{--                            @endif--}}
{{--                        @endforeach--}}

{{--                        @if ($bikes->hasMorePages())--}}
{{--                            <span aria-disabled="true" wire:click.prevent="setPage({{ $bikes->currentPage() + 1 }})">--}}
{{--                            <span class="relative inline-flex items-center px-4 py-[11px] -ml-px text-sm font-medium text-gray-700 bg-white rounded-r-lg border border-gray-300 cursor-pointer leading-5 hover:text-black hover:bg-secondary "><i class="fa-solid fa-angle-right"></i></span>--}}
{{--                        </span>--}}
{{--                        @else--}}
{{--                            <span aria-disabled="true">--}}
{{--                            <span class="relative inline-flex items-center px-4 py-[11px] -ml-px text-sm font-medium text-gray-300 bg-white rounded-r-lg  border border-gray-300 cursor-default leading-5"><i class="fa-solid fa-angle-right"></i></span>--}}
{{--                        </span>--}}
{{--                        @endif--}}
{{--                    </nav>--}}
{{--                </div>--}}
{{--            @endif--}}
        {{ $bikes->links() }}
            <div class="mt-5">
                <button type="submit" class="bg-primary text-white py-2.5 block w-full border border-transparent rounded-md hover:bg-primary/70 hover:border-primary duration-300"><i class="fa-solid fa-plus mr-3"></i>Ajouter</button>
            </div>
        @else
            <p class="bg-gray-100 text-center py-2 rounded-md text-gray-500">Vous avez déjà ajouté toutes les motos.</p>
        @endif
    </form>
</div>
