@extends('layouts.frontend')

@section('content-template')
    <div id="product-list">
        @livewire('pages.front.product-list', ['slug' => $slug])
    </div>
@endsection
