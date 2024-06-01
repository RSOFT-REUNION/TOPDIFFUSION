@extends('pages.frontend.profile.profile-template')

@section('profile-content')
    <h1 class="font-title font-bold text-xl">Mes commandes</h1>
    <div class="table-box mt-5">
        <table>
            <thead>
            <tr>
                <th>N°</th>
                <th>Référence</th>
                <th>Date</th>
                <th>Montant</th>
                <th>Nb. produits</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr role="button" data-href="{{ route('fo.profile.orders.single', ['id' => $order->id]) }}" class="cursor-pointer">
                    <td class="text-slate-400">{{ $order->id }}</td>
                    <td class="border-r text-slate-400">{{ $order->code }}</td>
                    <td class="font-title">{{ $order->created_at->format('d/m/Y') }}</td>
                    <td class="font-bold font-title">{{ number_format($order->total, 2, ',', ' ') }} €</td>
                    <td class="font-title">{{ $order->getProductCount() }}</td>
                    <td>{!! $order->getState() !!}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
