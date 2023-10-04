@extends('pages.frontend.profile.my-account-template')

@section('profile_template')
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h1>Mes demande SAV</h1>
            </div>
        </div>
    </div>
    {{-- @livewire('components.front.profile.profil-sav') --}}
    <div class="entry-content mt-5">
        <div class="flex flex-col gap-y-3 w-full">
            {{-- @foreach ($savGroup as $sav)
                <a class="flex flex-row items-center px-[30px] py-[20px] bg-gray-100 justify-between rounded-lg hover:shadow-lg hover:scale-102 duration-500 cursor-pointer" onclick="Livewire.emit('openModal', 'popups.front.profile.chat-sav-profile', {{ json_encode(['order' => $order, 'messageGroup' => $sav]) }})">
                    <i class="fa-solid fa-boxes-stacked text-xl"></i>
                    <h2>Commande</h2>
                    <h3>{{$sav->command_number}}</h3>
                    <h4>{{$sav->created_at}}</h4>
                    <h5>{!! $sav->getStateBadge() !!}</h5>
                    <h6>{{$order->total_amount}} €</h6>
                </a>
            @endforeach --}}
            @foreach ($savGroup as $sav)
                @php
                    $order = \App\Models\UserOrder::where('document_number', $sav->command_number)->first();
                @endphp

                <a class="flex flex-row items-center px-[30px] py-[20px] bg-gray-100 justify-between rounded-lg hover:shadow-lg hover:scale-102 duration-500 cursor-pointer" onclick="Livewire.emit('openModal', 'popups.front.profile.chat-sav-profile', {{ json_encode(['order' => $order, 'messageGroup' => $sav]) }})">
                    <i class="fa-solid fa-boxes-stacked text-xl"></i>
                    <h2>Commande</h2>
                    <h3>{{$sav->command_number}}</h3>
                    <h4>{{$sav->created_at}}</h4>
                    <h5>{!! $sav->getStateBadge() !!}</h5>
                    <h6>{{ $order ? $order->total_amount : 'N/A' }} €</h6>
                </a>
            @endforeach

        </div>
    </div>
@endsection
