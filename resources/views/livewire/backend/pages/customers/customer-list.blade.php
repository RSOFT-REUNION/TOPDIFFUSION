<div>
    <div class="inline-flex items-center justify-between w-full">
        <h1 class="font-title font-bold text-2xl">Clients</h1>
    </div>
    <div class="mt-5">
        @if($customers->count() > 0)
            <div class="table-box">
                <table>
                    <thead>
                    <tr>
                        <th class="w-[20px]">#</th>
                        <th>Nom</th>
                        <th>Groupe</th>
                        <th>Entreprise</th>
                        <th>Statistiques</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $customer)
                        <tr class="group cursor-pointer" wire:click="$dispatch('openModal', { component: 'backend.popups.users.show-user', arguments: { user_id: {{ $customer->id }} } })">
                            <td class="text-sm text-slate-400">{{ $customer->id }}</td>
                            <td>
                                <div>
                                    <p>{{ $customer->lastname }} {{ $customer->firstname }}</p>
                                    <p class="text-sm text-slate-400">{{ $customer->email }}</p>
                                </div>
                            </td>
                            <td>{{ $customer->group()->name }}</td>
                            <td>
                                @if($customer->company())
                                    <div class="inline-flex items-center gap-3 w-full">
                                        <i class="fa-solid fa-circle animate-pulse text-xs text-red-500"></i>
                                        <div>
                                            <p class="">{{ $customer->company()->name }}</p>
                                            <p class="text-sm text-slate-400">{{ $customer->company()->commercial_name }}</p>
                                        </div>
                                    </div>
                                @else
                                    --
                                @endif
                            </td>
                            <td>--</td>
                            <td><p class="text-blue-500 duration-300 invisible group-hover:visible">Modifier le groupe</p></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-center bg-slate-100 py-3 rounded-xl text-slate-400">Vous n'avez pas encore de client</p>
        @endif
    </div>
</div>
