@extends('layouts.frontend')

@section('content-template')

<h1>FAVORIS</h1>

@foreach ($favoriteUser as $fav)
    <div>
        <li>{{ $fav->title }}</li>
    </div>
@endforeach



@endsection