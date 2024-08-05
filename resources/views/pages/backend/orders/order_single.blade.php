@extends('layouts.backend')

@section('content')
    @livewire('backend.pages.orders.order-single', ['order_id' => $order_id])
@endsection
