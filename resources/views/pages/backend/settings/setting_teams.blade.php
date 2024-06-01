@extends('layouts.backend')

@section('content')
    <div class="inline-flex items-center justify-between w-full">
        <h1 class="font-title font-bold text-xl">Équipe</h1>
        <button onclick="Livewire.dispatch('openModal', {component: 'backend.popups.settings.add-team-user'})" class="btn-slate">Ajouter un membre à l'équipe</button>
    </div>
    <div class="mt-5 table-box">
        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>Personne</th>
                <th>Type</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($teams as $team)
                <tr class="group">
                    <td class="border-r">{{ $team->id }}</td>
                    <td class="">
                        <div>
                            <p class="font-bold">{{ $team->lastname }} {{ $team->firstname }}</p>
                            <p class="text-slate-400">{{ $team->email }}</p>
                        </div>
                    </td>
                    <td>{!! $team->getTypeBadge() !!}</td>
                    <th>
                        @if($team->id !== auth()->user()->id)
                            <a href="{{ route('bo.setting.team.delete', ['id' => $team->id]) }}" class="text-red-500 group-hover:visible invisible"><i class="fa-regular fa-delete-left"></i></a>
                        @endif
                    </th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
