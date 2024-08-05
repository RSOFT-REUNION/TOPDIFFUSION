@extends('layouts.app')

@section('title')
    | Administration
@endsection

@section('content-app')
    @include('components.elements.popup-alerts_backend')
    <div class="flex">
        <div class="flex-none">
            {{-- Sidebar --}}
            @livewire('backend.components.templates.sidebar', ['group_page' => $group_page, 'page' => $page])
        </div>
        <div class="flex-1 p-5 ml-[300px]">
            {{-- Content --}}
            @yield('content')
        </div>
    </div>
@endsection
