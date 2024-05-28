@extends('layouts.app')

@section('content-app')
    @include('components.elements.popup-alerts')
    <div class="flex flex-col min-h-screen">
        <header class="flex-none">
            {{-- HEADER --}}
            @livewire('frontend.components.templates.header')
        </header>
        <main class="grow">
            @yield('content')
        </main>
        <footer class="flex-none">
            {{-- FOOTER --}}
            @include('components.templates.frontend.footer')
        </footer>
    </div>
@endsection
