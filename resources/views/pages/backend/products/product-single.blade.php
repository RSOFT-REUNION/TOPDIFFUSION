@extends('layouts.backend')

@section('content-template')
    @livewire('pages.back.products.product-single', ['product_id' => $product->id])
@endsection
