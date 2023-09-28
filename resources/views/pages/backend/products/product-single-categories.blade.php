@extends('layouts.backend')

@section('content-template')
    <div id="back_page_content">
        @livewire('pages.back.products.product-single-categories', ['categoryId' => $singleCat->id])
    </div>
@endsection
