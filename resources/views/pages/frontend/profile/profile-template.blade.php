@extends('layouts.frontend')

@section('content')
    <div class="container mx-auto my-10">
        <div class="flex items-start gap-5">
            <div class="flex-none">
                <div class="w-[300px] bg-slate-100 border rounded-xl overflow-hidden">
                    <div class="border-b p-5">
                        <p class="font-title font-bold text-lg">{{ auth()->user()->lastname }} {{ auth()->user()->firstname }}</p>
                    </div>
                    <div class="p-3">
                        <ul>
                            <li><a href="{{ route('fo.profile') }}" class="duration-300 hover:bg-slate-200 mb-1 block px-3 py-2 rounded-lg font-medium"><i class="fa-regular fa-grid-2 mr-3 text-slate-400"></i>Mon tableau de bord</a></li>
                            <li><a href="{{ route('fo.profile.edit') }}" class="duration-300 hover:bg-slate-200 mb-1 block px-3 py-2 rounded-lg font-medium"><i class="fa-regular fa-user mr-3 text-slate-400"></i>Mes informations</a></li>
                            <li><a href="{{ route('fo.profile.orders') }}" class="duration-300 hover:bg-slate-200 block px-3 py-2 rounded-lg font-medium"><i class="fa-regular fa-boxes-packing mr-3 text-slate-400"></i>Mes commandes</a></li>
                            <li><a href="{{ route('fo.profile.favorite') }}" class="duration-300 hover:bg-slate-200 block px-3 py-2 rounded-lg font-medium"><i class="fa-regular fa-heart mr-3 text-slate-400"></i>Mes favoris</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="flex-1">
                @yield('profile-content')
            </div>
        </div>
    </div>

@endsection
