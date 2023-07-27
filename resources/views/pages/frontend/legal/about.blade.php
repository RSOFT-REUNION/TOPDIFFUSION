@extends('layouts.frontend')

@section('content-template')
    <main role="main">
        <div class="container mx-auto">
            <div class="text-center">
                <h1>TOP DIFFUSION</h1>
                <h3>PAGE A-PROPOS</h3>
            </div>
            <div class="tiny-content my-20">
                    {!! $pageContent->content !!}
                {{-- @else
                    @php
                        abort_if(empty($pageContent), 404);
                    @endphp
                @endif --}}
            </div>
        </div>
    </main>
@endsection
