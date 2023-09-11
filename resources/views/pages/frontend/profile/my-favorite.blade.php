@extends('pages.frontend.profile.my-account-template')

@section('profile_template')

@foreach ($favoriteUser as $fav)
    <div>
        <li>{{ $fav->title }}</li>
    </div>
@endforeach

@endsection