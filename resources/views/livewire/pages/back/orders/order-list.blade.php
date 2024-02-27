<div>
    <div id="entry-header" class="flex items-center">
        <div class="flex-1">
            <h1>Commandes</h1>
        </div>
        <div class="flex-none inline-flex items-center">
            {{-- --}}
        </div>
    </div>

    <div id="entry-content">
        @if($orders->count() > 0)
            <div class="grid grid-cols-4 gap-5">
                <div class="grid-item-button text-green-700">
                    <div class="flex items-center">
                        <div class="flex-none mr-4">
                            <i class="fa-solid fa-file-arrow-up fa-2x"></i>
                        </div>
                        <div class="flex-1 ml-4">
                            <h3>123</h3>
                            <p>Commandes à traité</p>
                        </div>
                    </div>
                </div>
                <div class="grid-item-button">
                    <div class="flex items-center">
                        <div class="flex-none mr-4">
                            <i class="fa-solid fa-file-lines fa-2x"></i>
                        </div>
                        <div class="flex-1 ml-4">
                            <h3>{{ $orders->count() }}</h3>
                            <p>Commandes au total</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5 table-box-outline">
                <table>
                    <thead>
                    <tr>
                        <th>N° de commande</th>
                        <th>Statut</th>
                        <th>Client</th>
                        <th>Nb. produits</th>
                        <th>Montant total (TTC)</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr role="button" class="cursor-pointer hover:bg-blue-100" data-href="{{ route('back.orders.single', ['order' => $order->document_number]) }}">
                                <td>{{ $order->document_number }}</td>
                                <td>{!! $order->getStateBadgeGestion() !!}</td>
                                <td><a href="{{ route('back.user.single', ['user' => $order->User()->customer_code]) }}" class="font-bold hover:text-blue-500">{{ $order->User()->customer_code }}</a></td>
                                <td>{{ $order->total_product }}</td>
                                <td class="font-bold">{{ number_format($order->total_amount, '2', ',', ' ') }} €</td>
                                <td>{{ $order->getCreatedDate() }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="empty-text">Vous n'avez aucune commande</p>
        @endif
    </div>
</div>
