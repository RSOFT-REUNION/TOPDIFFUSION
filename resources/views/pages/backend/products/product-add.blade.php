@extends('layouts.backend')

@section('content-template')
    <div id="back_page_content">
        @livewire('pages.back.products.product-add', ['product_id' => $product->id])
    </div>
@endsection
