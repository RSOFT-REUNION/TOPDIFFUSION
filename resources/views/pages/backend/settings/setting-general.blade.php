@extends('layouts.backend')

@section('content-template')
    <div id="back_page_content">
        @livewire('pages.back.settings.general', ['CarrouselHome' => $CarrouselHome])
    </div>
@endsection
