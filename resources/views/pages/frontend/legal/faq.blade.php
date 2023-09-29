@extends('layouts.frontend')

@section('content-template')
    <main role="main">
        <div class="flex flex-col items-center">
            <div class="w-full bg-primary">
                <div class="p-24 flex flex-row justify-between items-center">
                    <div class="text-white gap-y-2 flex flex-col">
                        @if ($formattedDate)
                            <p class="text-xl">Mis à jours : {{ $formattedDate }} </p>
                        @endif
                        <h1 class="text-4xl font-bold">FAQ</h1>
                    </div>
                    <div class="text-white text-9xl">
                        <i class="fa-solid fa-comments"></i>
                    </div>
                </div>
            </div>
            @if (true)
                <div class="w-full px-20 py-10">
                    @livewire('components.back.faq-item', ['page' => $page])
                </div>
            @else
                @php
                    abort_if(empty($pageContent->content), 404);
                @endphp
            @endif
        </div>
    </main>
@endsection
