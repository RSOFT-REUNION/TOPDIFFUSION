    <div class="px-10">
        <div class="flex flex-rows border-b py-5">
            <div class="my-2 mr-2">
                <a onclick="window.history.back()" class="bg-gray-200 dark:bg-gray-700 px-5 py-2 rounded-lg cursor-pointer">
                    <i class="fa-solid fa-arrow-left-long"></i>
                </a>
            </div>
            <div class="flex flex-row justify-between ml-2">
                <div class="text-4xl font-bold">
                    <h1>Ticket</h1>
                </div>
            </div>
        </div>

        <div class="flex flex-row justify-between m-14">
            <div class="flex flex-col gap-6 w-3/4">
                @foreach ($messages as $message)
                    <div class="flex @if(auth()->user()->id == $message->user_id) justify-end @else justify-start @endif mr-10">
                        <div class="@if(auth()->user()->id == $message->user_id)  bg-yellow-100 dark:bg-yellow-700  @else bg-gray-100 dark:bg-gray-900 @endif rounded-lg w-3/4 h-28">
                            <div class=" flex flex-col justify-center p-4">
                                <div class="border-b pb-2">
                                    <h1 class="text-lg font-bold">Envoyé le {{ $message->getCreatedAt() }} | par @if(auth()->user()->id == $message->user_id) vous @else {{ $message->getCreatedBy()->firstname }} {{ $message->getCreatedBy()->lastname }} @endif</h1>
                                </div>
                                <div class="pt-2">
                                    <span class="font-medium">{{ $message->message }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="flex @if(auth()->user()->team) justify-start @else justify-end @endif mr-10">
                    <div class="@if(auth()->user()->id == $ticket->user_id) bg-yellow-100 dark:bg-yellow-700 @else bg-gray-100 dark:bg-gray-900 @endif rounded-lg w-3/4 h-28">
                        <div class=" flex flex-col justify-center p-4">
                            <div class="border-b pb-2">
                                <h1 class="text-lg font-bold">Envoyé le {{ $ticket->getCreatedAt() }} | par @if(auth()->user()->id == $ticket->user_id) vous @else {{ $ticket->getCreatedBy()->firstname }} {{ $ticket->getCreatedBy()->lastname }} @endif</h1>
                            </div>
                            <div class="pt-2">
                                <span class="font-medium">{{ $ticket->message }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col w-1/4 flex-nowrap">
                <div class="bg-gray-100 rounded-lg dark:bg-gray-900">
                    <div class="p-4">
                        <div class="border-b pb-3">
                            <span class="text-secondary dark:text-red-800 font-bold text-3xl">Informations</span>
                        </div>
                        <div class="mt-4">
                            <p>Code client : {{ $user->customer_code }}</p>
                            <p class="pt-2">Sujet : {{ $ticket->getSubject() }}</p>
                            @if ($ticket->facture_number)
                                <p class="pt-2">Numéro de facture : {{ $ticket->facture_number }}</p>
                            @endif
                            <p class="pt-2">Date de la demande : {{ $ticket->getCreatedAt() }}</p>
                            <div class="flex pt-2">
                                <p class="mr-2">Status : {!! $ticket->getStateBadge() !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @if (!$ticket->closed)
                    <div class="mt-4">
                        <a onclick="Livewire.emit('openModal', 'pages.front.sav.add-message', {{ json_encode(['ticket' => $ticket->id, 'user' => auth()->user()->id]) }})" class="flex bg-gray-100 w-full items-center justify-center rounded-[5px] h-[40px] cursor-pointer mr-2.5 dark:bg-gray-900">
                            <i class="fa-solid fa-plus mr-3 h-5 w-5"></i>
                            <h2 class="text-xl font-bold">Ajouter un message</h2>
                        </a>
                    </div>
                    @if (auth()->user()->team)
                        @livewire('components.sav.btn-cloture', ['ticket' => $ticket, 'label' => 'Mettre le ticket en cours', 'icon' => 'hourglass-start', 'wire' => 'inProgress', 'class' => 'rounded-[5px] h-[40px] mr-2.5 bg-gray-100 dark:bg-gray-900'])
                        @livewire('components.sav.btn-cloture', ['ticket' => $ticket, 'label' => 'Clôturé', 'icon' => 'check', 'wire' => 'cloture', 'class' => 'rounded-[5px] h-[40px] mr-2.5 bg-gray-100 dark:bg-gray-900'])
                    @endif

                @else
                    @if (auth()->user()->team)
                        @livewire('components.ticket.btn-cloture', ['ticket' => $ticket, 'label' => 'Rouvrir le ticket', 'icon' => 'arrow-rotate-left', 'wire' => 'reOpen', 'class' => 'rounded-[5px] h-[40px] mr-2.5 bg-gray-100 dark:bg-gray-900'])
                    @endif
                @endif
            </div>
        </div>
    </div>
