@extends('layouts.app')

@section('content-app')
    <div class="flex h-screen">
        <div class="flex-none">
            @livewire('components.template.back-sidebar', ['group' => $group, 'page' => $page])
        </div>
        <div class="flex-1 pl-backend">
            @yield('content-template')
        </div>
    </div>
@endsection
