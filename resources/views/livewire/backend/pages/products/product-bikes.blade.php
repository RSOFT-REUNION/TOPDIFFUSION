<div>
    <div class="inline-flex items-center justify-between w-full">
        <h1 class="font-title font-bold text-2xl">Liste des motos</h1>
        <div>
            <button wire:click="$dispatch('openModal', {component: 'backend.popups.bikes.add-bikes-import'})" class="btn-slate-icon mr-2" title="Importer une liste de catégories"><i class="fa-regular fa-arrow-up-from-line"></i></button>
            <button onclick="Livewire.dispatch('openModal', {component: 'backend.popups.bikes.add-bike'})" class="btn-primary"><i class="fa-solid fa-plus mr-3"></i>Ajouter une nouvelle moto</button>
        </div>
    </div>
    <div class="mt-10">
        <div class="table-box">
            <table>
                <thead>
                <tr>
                    <th>Marque</th>
                    <th>Modèle</th>
                    <th>Cylindrée</th>
                    <th>Année</th>
                    <th>Nb. produits</th>
                    <th>Nb. clients</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($bikes as $bike)
                    <tr class="group">
                        <td>{{ $bike->brand }}</td>
                        <td>{{ $bike->model }}</td>
                        <td>{{ $bike->cylinder }}</td>
                        <td class="border-r">{{ $bike->year }}</td>
                        <td>{{ $bike->getProductCount() }}</td>
                        <td>{{ $bike->getUserCount() }}</td>
                        <td><button wire:click="deleteBike({{ $bike->id }})" class="text-red-500 invisible group-hover:visible"><i class="fa-regular fa-delete-left"></i></button></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-5">
            {{ $bikes->links() }}
        </div>
    </div>
</div>
