@extends('layouts.frontend')

@section('content-template')
    <div id="product-page">
        <div class="container mx-auto">
            @livewire('front.product-page', ['product_id' => $product->id])
        </div>
    </div>
@endsection
