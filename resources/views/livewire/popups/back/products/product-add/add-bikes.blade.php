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

            <div class="mt-5">
                <button type="submit" class="bg-primary text-white py-2.5 block w-full border border-transparent rounded-md hover:bg-primary/70 hover:border-primary duration-300"><i class="fa-solid fa-plus mr-3"></i>Ajouter</button>
            </div>
        @else
            <p class="bg-gray-100 text-center py-2 rounded-md text-gray-500">Vous avez déjà ajouté toutes les motos.</p>
        @endif
    </form>
</div>
