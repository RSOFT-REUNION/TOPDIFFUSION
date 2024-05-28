<div>
    <x-templates.header-popup label="Ajouter des motos" icon=""/>
    <div class="p-5">
        <x-elements.inputs.textfield type="text" name="search" label="Rechercher une moto" livewire="yes" require="" class="" placeholder="Entrez le nom de la moto"/>
        <form wire:submit="addBike">
            @csrf
            <div class="mt-5 table-box">
                <table>
                    <thead>
                    <tr>
                        <th></th>
                        <th>Marque</th>
                        <th>Modèle</th>
                        <th>Cylindrée</th>
                        <th>Année</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bikes as $bike)
                        <tr>
                            <td><input type="checkbox" wire:model="bike_selected" value="{{ $bike->id }}" {{ $checkedBikes ? 'checked' : '' }}></td>
                            <td>{{ $bike->brand }}</td>
                            <td>{{ $bike->model }}</td>
                            <td>{{ $bike->cylinder }}</td>
                            <td>{{ $bike->year }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-5">
                @if ($bikes->hasPages())
                    <div class="flex items-center justify-center">
                        {{-- Bouton "Précédent" --}}
                        <button type="button" wire:click="setPreviousPage" class="px-2 py-1 text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-pointer rounded-l-lg"><i class="fa-solid fa-angle-left"></i> Précédent</button>
                        {{-- Bouton "Suivant" --}}
                        @if ($bikes->hasMorePages())
                            <button type="button" wire:click="setNextPage" class="px-2 py-1 text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-pointer rounded-r-lg">Suivant <i class="fa-solid fa-angle-right"></i></button>
                        @else
                            <button type="button" class="px-2 py-1 text-sm font-medium text-gray-300 bg-white border border-gray-300 cursor-default rounded-r-lg" disabled>Suivant <i class="fa-solid fa-angle-right"></i></button>
                        @endif
                    </div>
                @endif
            </div>
            <button type="submit" class="w-full btn-primary mt-5">Ajouter les motos</button>
        </form>

    </div>
</div>
