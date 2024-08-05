@extends('layouts.backend')

@section('content')
    @livewire('backend.pages.products.product-add', ['type' => $type])
@endsection
