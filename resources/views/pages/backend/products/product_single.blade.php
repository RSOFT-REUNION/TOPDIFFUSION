@extends('layouts.backend')

@section('content')
    @livewire('backend.pages.products.product-single', ['product_id' => $product_id])
@endsection
