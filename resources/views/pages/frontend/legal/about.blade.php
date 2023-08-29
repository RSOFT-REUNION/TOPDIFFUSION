@extends('layouts.frontend')

@section('content-template')
    <main role="main">
        <div class="flex flex-col items-center">
            <div class="w-full bg-primary">
                <div class="p-24 flex flex-row justify-between items-center">
                    <div class="text-white gap-y-2 flex flex-col">
                        <p class="text-xl">Mis à jours : {{ $formattedDate }}</p>
                        <h1 class="text-4xl font-bold">A PROPOS</h1>
                    </div>
                    <div class="text-white text-9xl">
                        <i class="fa-solid fa-address-card"></i>
                    </div>
                </div>
            </div>
            <div class="tiny-content my-20 mx-28">
                @if ($pageContent->content)
                    {!! $pageContent->content !!}
                @else
                    @php
                        abort_if(empty($pageContent->content), 404);
                    @endphp
                @endif
            </div>
        </div>
    </main>
@endsection
