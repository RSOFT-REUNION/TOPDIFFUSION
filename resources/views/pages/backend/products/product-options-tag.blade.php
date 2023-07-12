@extends('layouts.backend')

@section('content-template')
    <div id="back_page_content">
        @livewire('pages.back.products.product-view-group-tag', ['groupTag' => $grTag->id])
    </div>
@endsection
