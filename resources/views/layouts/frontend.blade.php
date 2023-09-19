@extends('layouts.app')

@section('content-app')
    <div id="frontend-page" class="flex flex-col h-screen">

        <div class="flex-none">
            @livewire('popups.front.maintenance.maintenance')
            <!-- HEADER FRONT -->
            @include('components.templates.front-header')
        </div>
        <div class="grow">
            <!-- CONTENT FRONT -->
            @yield('content-template')
        </div>
        <div class="flex-none">
            <!-- FOOTER FRONT -->
            @include('components.templates.front-footer')
        </div>
    </div>

@endsection

@section('meta-script')

@endsection
