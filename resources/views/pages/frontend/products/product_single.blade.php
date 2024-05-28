@extends('layouts.frontend')

@section('content')
    @livewire('frontend.pages.products.product-single', ['product' => $product])
@endsection
