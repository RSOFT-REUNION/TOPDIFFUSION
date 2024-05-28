@extends('layouts.frontend')

@section('content')
    @livewire('frontend.pages.products.product-list-bike', ['bike' => $bike])
@endsection
