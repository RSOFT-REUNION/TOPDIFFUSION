<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h2>Sélectionner une moto</h2>
            </div>
            <div class="flex-none">
                <a wire:click="$emit('closeModal')" class="btn-icon block cursor-pointer"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>
    <div class="entry-content">
        <div class="textfield-search items-center">
            <label for="search"><i class="fa-solid fa-magnifying-glass mr-2 ml-2"></i></label>
            <input type="text" wire:model="search" placeholder="Rechercher une marque, un modèle..." class="focus:outline-none">
        </div>
        <form wire:submit.prevent="add">
            @csrf
            <div class="table-box-outline mt-2">
                <table>
                    <thead>
                    <tr class="text-center">
                        <th>Sélection</th>
                        <th>Marque</th>
                        <th>Cylindrée</th>
                        <th>Modèle</th>
                        <th>Année</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bikes as $bike)
                        <tr>
                            <td><input type="radio" wire:model="bike_selected" value="{{ $bike->id }}" ></td>
                            <td>{{ $bike->marque }}</td>
                            <td>{{ $bike->cylindree }}</td>
                            <td>{{ $bike->modele }}</td>
                            <td>{{ $bike->annee }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-2">
                {{ $bikes->links() }}
            </div>
            @if($bike_selected)
                <hr class="my-3"/>
                <button type="submit" class="btn-secondary block w-full"><i class="fa-solid fa-floppy-disk mr-3"></i>Sélectionner cette moto</button>
            @endif
        </form>

    </div>
</div>
