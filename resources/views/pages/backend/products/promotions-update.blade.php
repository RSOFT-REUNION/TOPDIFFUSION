@extends('layouts.backend')

@section('content-template')
    <div id="back_page_content">
        @livewire('pages.back.products.promotions-update', ['id' => $id])
    </div>
@endsection