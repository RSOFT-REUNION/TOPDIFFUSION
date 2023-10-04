{{-- <div class="bg-red-500">
    @if (auth()->user()->notifications)
        <h1>MESSAGE</h1>
        {{ auth()->user()->unreadNotifications->count() }}
        @foreach(auth()->user()->unreadNotifications as $notification)
            <div class="w-52" wire:click="goToSingleSav({{ $notification->data['message_id'] }})">
                <h3 wire:click="markNotificationAsRead('{{ $notification->id }}')">{{ $notification->data['content'] }}</h3>
            </div>
        @endforeach
    @endif
</div> --}}
