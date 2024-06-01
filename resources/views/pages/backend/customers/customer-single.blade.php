@extends('layouts.backend')

@section('content')
    <div>
        <a href="{{ route('bo.customers') }}" class="btn-slate">Retour à la liste</a>
        <h1 class="font-title text-2xl font-bold">{{ $user->lastname }} {{ $user->firstname }}</h1>
    </div>
@endsection
