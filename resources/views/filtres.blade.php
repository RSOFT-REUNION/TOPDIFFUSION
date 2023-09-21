@extends('layouts.frontend')

@section('content-template')
    @if (count($bikesInfos) === 0)
        <h1>Pas de donnés trouvé</h1>
    @else
        @foreach ($bikesInfos as $bike)
            <div>
                <p>ID : {{ $bike['id'] }}</p>
                <p>Marque : {{ $bike['title'] }}</p>
                @if($bike['cover'])
                    <img src="{{ asset('storage/images/products/'. $bike['cover']) }}">
                @else
                    <h1>Pas d'image disponible</h1>
                @endif
                <p>Description : {{ $bike['short_description'] }}</p>
                <p>Active : {{ $bike['active'] }}</p>
                <p>Marque : {{ $bike['brand_id'] }}</p>
            </div>
        @endforeach
    @endif
@endsection