@extends('pages.frontend.profile.my-account-template')

@section('profile_template')
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h1>Mes demande SAV</h1>
            </div>
        </div>
    </div>
    <div class="entry-content mt-5">
        @if ($sav)
            <div class="flex flex-col gap-y-3 w-full">
                @foreach ($savGroup as $sav)
                    @php
                        $order = \App\Models\UserOrder::where('document_number', $sav->command_number)->first();
                    @endphp

                    <a class="flex flex-row items-center px-[30px] py-[20px] bg-gray-100 justify-between rounded-lg hover:shadow-lg hover:scale-102 duration-500 cursor-pointer"
                        onclick="Livewire.emit('openModal', 'popups.front.profile.chat-sav-profile', {{ json_encode(['order' => $order, 'messageGroup' => $sav]) }})">
                        <i class="fa-solid fa-boxes-stacked text-xl"></i>
                        <h2>Commande</h2>
                        <h3>{{ $sav->command_number }}</h3>
                        <h4>{{ $sav->created_at }}</h4>
                        <h5>{!! $sav->getStateBadge() !!}</h5>
                        <h6>{{ $order ? $order->total_amount : 'N/A' }} €</h6>
                    </a>
                @endforeach
            </div>
        @else
            <div class="w-full flex flex-col bg-gray-100 rounded-lg justify-center items-center py-4">
                <h2>Pas de demande de SAV pour l'instant</h2>
            </div>
        @endif
    </div>
@endsection
