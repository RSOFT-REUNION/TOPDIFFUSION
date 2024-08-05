<div>
    <div class="inline-flex items-center gap-5">
        <h1 class="font-bold font-title text-xl">Liste des commandes</h1>
        <span class="text-sm border py-1 px-2 rounded-full">{{ $orders_count }}</span>
    </div>
    <div class="grid grid-cols-4 gap-5 mt-5">
        <div class="border rounded-xl hover:bg-slate-100 hover:scale-105 duration-300 group hover:drop-shadow-2xl cursor-pointer overflow-hidden">
            <div class="inline-flex items-center justify-center gap-5 w-full p-5 bg-white">
                <p class="text-xl font-title">{{ $orders_pending->count() }}</p>
            </div>
            <div class="border-t bg-slate-100 p-3 text-center">
                <p class="text-slate-400 text-sm">Nb. commandes en cours</p>
            </div>
        </div>
        <div class="border rounded-xl hover:bg-slate-100 hover:scale-105 duration-300 group hover:drop-shadow-2xl cursor-pointer overflow-hidden">
            <div class="inline-flex items-center justify-center gap-5 w-full p-5 bg-white">
                <p class="text-xl font-title">{{ $orders_terminate->count() }}</p>
            </div>
            <div class="border-t bg-slate-100 p-3 text-center">
                <p class="text-slate-400 text-sm">Nb. commandes terminées</p>
            </div>
        </div>
        <div class="border rounded-xl hover:bg-slate-100 hover:scale-105 duration-300 group hover:drop-shadow-2xl cursor-pointer overflow-hidden">
            <div class="inline-flex items-center justify-center gap-5 w-full p-5 bg-white">
                <p class="text-xl font-title">{{ number_format($orders_pending->sum('total'), 2, ',', ' ') }} €</p>
            </div>
            <div class="border-t bg-amber-100 p-3 text-center">
                <p class="text-amber-600 text-sm">Montant des commandes en cours</p>
            </div>
        </div>
        <div class="border rounded-xl hover:bg-slate-100 hover:scale-105 duration-300 group hover:drop-shadow-2xl cursor-pointer overflow-hidden">
            <div class="inline-flex items-center justify-center gap-5 w-full p-5 bg-white">
                <p class="text-xl font-title">{{ number_format($orders_terminate->sum('total'), 2, ',', ' ') }} €</p>
            </div>
            <div class="border-t bg-green-100 p-3 text-center">
                <p class="text-green-600 text-sm">Montant des commandes passées</p>
            </div>
        </div>
    </div>
    <div class="table-box mt-5">
        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>Référence</th>
                <th>Client</th>
                <th>Montant TTC</th>
                <th>Mode de paiement</th>
                <th>Status</th>
                <th>Date</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr role="button" data-href="{{ route('bo.orders.single', $order->id) }}" class="group cursor-pointer">
                    <td class="text-slate-400">{{ $order->id }}</td>
                    <td class="text-slate-400 border-r">{{ $order->code }}</td>
                    <td>{{ $order->getUserName() }}</td>
                    <td class="font-bold font-title">{{ number_format($order->total, '2', ',', ' ') }} €</td>
                    <td>{{ $order->getPaymentMethod() }}</td>
                    <td>{!! $order->getState() !!}</td>
                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                    <td>
                        <i class="fa-solid fa-arrow-right group-hover:visible invisible text-blue-500"></i>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
