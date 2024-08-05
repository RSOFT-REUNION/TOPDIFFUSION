@extends('pages.frontend.profile.profile-template')

@section('profile-content')
    <div class="">
        <h1 class="font-title font-bold text-xl">Mes favoris</h1>
        <div class="grid grid-cols-3 gap-5 mt-5">
            @foreach($favorites as $favorite)
                @livewire('frontend.components.products.thumbnails', ['product' => $favorite->product()])
            @endforeach
        </div>
    </div>
@endsection
