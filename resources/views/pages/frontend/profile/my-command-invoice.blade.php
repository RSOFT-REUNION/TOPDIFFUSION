@extends('pages.frontend.profile.my-account-template')

@section('profile_template')

<div class="entry-header">
    <div class="flex items-center">
        <div class="flex-1">
            <h1>Commande & Factures</h1>
        </div>
    </div>
</div>
<div>
    <div id="entry-content">
        @if($orders->count() > 0)
            <div class="mt-5 table-box-outline">
                <table>
                    <thead>
                    <tr>
                        <th>N° de commande</th>
                        <th>Statut</th>
                        {{-- <th>Client</th> --}}
                        <th>Nb. produits</th>
                        <th>Montant total (TTC)</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr role="button" class="cursor-pointer hover:bg-blue-100" data-href="{{ route('front.orders.single', ['order' => $order->document_number]) }}">
                                <td>{{ $order->document_number }}</td>
                                <td>{!! $order->getStateBadgeGestion() !!}</td>
                                {{-- <td><a href="{{ route('back.user.single', ['user' => $order->User()->customer_code]) }}" class="font-bold hover:text-blue-500">{{ $order->User()->customer_code }}</a></td> --}}
                                <td>{{ $order->total_product }}</td>
                                <td>{{ $order->total_amount }} €</td>
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


@endsection