@extends('layouts.frontend')

@section('content-template')
    <main role="main">
        <div class="container mx-auto">
            <div class="text-center">
                <h1>TOP DIFFUSION</h1>
                <h3>PAGE CONFIDENTIAL</h3>
            </div>
            <div class="tiny-content my-20">
                {!! $pageContent->content !!}
            </div>
        </div>
    </main>
@endsection
