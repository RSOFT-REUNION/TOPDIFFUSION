<div>
    <h1 class="font-title font-bold text-xl">Mon tableau de bord</h1>
    <div class="mt-5 grid grid-cols-4 gap-5">
        <div class="border rounded-xl hover:bg-slate-100 hover:scale-105 duration-300 group hover:drop-shadow-2xl cursor-pointer overflow-hidden">
            <div class="inline-flex items-center justify-center gap-5 w-full p-5 bg-white">
                <p class="text-xl font-title">{{ $order_pending }}</p>
            </div>
            <div class="border-t bg-slate-100 p-3 text-center">
                <p class="text-slate-400 text-sm">Nb. de commandes en cours</p>
            </div>
        </div>
        <div class="border rounded-xl hover:bg-slate-100 hover:scale-105 duration-300 group hover:drop-shadow-2xl cursor-pointer overflow-hidden">
            <div class="inline-flex items-center justify-center gap-5 w-full p-5 bg-white">
                <p class="text-xl font-title">{{ $order_terminate }}</p>
            </div>
            <div class="border-t bg-slate-100 p-3 text-center">
                <p class="text-slate-400 text-sm">Nb. de commandes terminées</p>
            </div>
        </div>
        <div class="border rounded-xl hover:bg-slate-100 hover:scale-105 duration-300 group hover:drop-shadow-2xl cursor-pointer overflow-hidden">
            <div class="inline-flex items-center justify-center gap-5 w-full p-5 bg-white">
                <p class="text-xl font-title">{{ $user->group()->name }}</p>
            </div>
            <div class="border-t bg-slate-100 p-3 text-center">
                <p class="text-slate-400 text-sm">Groupe client</p>
            </div>
        </div>
        <div role="button" data-href="{{ route('fo.profile.favorite') }}" class="border rounded-xl hover:bg-slate-100 hover:scale-105 duration-300 group hover:drop-shadow-2xl cursor-pointer overflow-hidden">
            <div class="inline-flex items-center justify-center gap-5 w-full p-5 bg-white">
                <p class="text-xl font-title">{{ $favorites }}</p>
            </div>
            <div class="border-t bg-slate-100 p-3 text-center">
                <p class="text-slate-400 text-sm">Produits en favoris</p>
            </div>
        </div>
    </div>
    <div class="mt-5">
        <div class="inline-flex items-center justify-between w-full">
            <h2 class="font-bold font-title">Mes motos</h2>
            <button wire:click="$dispatch('openModal', {component: 'frontend.popups.profile.add-bike'})" class="btn-slate">Ajouter une moto</button>
        </div>
        @if($bikes->count() > 0)
            <div class="table-box mt-3">
                <table>
                    <thead>
                    <tr>
                        <th>Moto</th>
                        <th>Options</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bikes as $bike)
                        <tr class="group">
                            <td class="border-r">{{ $bike->name() }}</td>
                            <td><button wire:click="searchProducts({{ $bike->bike_id }})" class="hover:underline underline-offset-2 hover:text-blue-500">Voir les produits associés</button></td>
                            <td><button wire:click="deleteBike({{ $bike->bike_id }})" class="group-hover:visible invisible text-red-500"><i class="fa-regular fa-delete-left"></i></button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-center bg-slate-100 py-2 rounded-lg mt-3 text-slate-400">Vous n'avez pas encore ajouter de moto</p>
        @endif
    </div>
</div>
