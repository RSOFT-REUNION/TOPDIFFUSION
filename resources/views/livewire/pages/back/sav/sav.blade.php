<div class="h-screen">
    <div class="flex items-center mb-7 py-[20px] px-[30px]">
        <div class="flex-1">
            <h1 class="font-bold text-[28px]">SAV</h1>
        </div>
    </div>
    <div class="flex flex-row h-5/6 gap-x-5">
        <div class="flex flex-col bg-[#f0f0f0] w-96 rounded-lg overflow-y-auto">
            <div class="p-4">
                <a wire:click="toggleState('state')"
                    class="bg-secondary dark:bg-blue-800 hover:shadow-md duration-300 rounded-lg py-5 mb-5 text-black px-4 text-xl font-semibold flex justify-between gap-4 items-center cursor-pointer">
                    <div class="flex gap-3 items-center">
                        <h1>SAV en cours</h1>
                    </div>
                    <i class="fa-solid  {{ $state ? 'fa-angle-down' : 'fa-angle-up'}}"></i>
                    {{-- <i class="fa-solid @if ($state) fa-angle-up @else fa-angle-down @endif"></i> --}}
                </a>
                {{-- block au click --}}
                @if ($state)
                    <div class="flex flex-col">
                        @foreach ($ticketInProgress as $tk)
                            <div class="mb-5 cursor-pointer">
                                <div wire:click="getMessage({{ $tk->id }})"
                                    class="flex flex-row justify-between p-4 bg-gray-300 hover:shadow-lg duration-300 hover:bg-opacity-70 dark:bg-gray-800 rounded-md">
                                    <div class="flex flex-col">
                                        <p>Code client : {{ $tk->user->customer_code }}</p>
                                        <p class="pt-2">Sujet : {{ $tk->getSubject() }}</p>
                                        @if ($tk->facture_number)
                                            <p class="pt-2">Numéro de Commande : {{ $tk->command_number }}</p>
                                        @endif
                                        <p class="pt-2">Date de la demande : {{ $tk->getCreatedAt() }}</p>
                                        <div class="flex pt-2">
                                            <p class="mr-2">Status : {!! $tk->getStateBadge() !!}</p>
                                        </div>
                                    </div>
                                    @if ($tick)
                                        @if ($tick->id == $tk->id)
                                            <div wire:click.stop wire:click="stateMenu({{ $tk->id }})">
                                                <i wire:click.stop wire:click="stateMenu({{ $tk->id }})"
                                                    class="fa-solid fa-ellipsis-vertical pl-5 @if ($test == $tk->id) dark:text-red-700 text-secondary @endif"></i>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                                @if ($test == $tk->id)
                                    @if (!$tk->closed)
                                        <div class="">
                                            @livewire('components.sav.btn-cloture', ['ticket' => $tick, 'label' => 'Mettre le ticket en cours', 'icon' => 'hourglass-start', 'wire' => 'inProgressAdmin', 'class' => 'bg-gray-300 dark:bg-gray-800 rounded-md py-2'])
                                            @livewire('components.sav.btn-cloture', ['ticket' => $tick, 'label' => 'Clôturé', 'icon' => 'check', 'wire' => 'clotureAdmin', 'class' => 'bg-gray-300 dark:bg-gray-800 rounded-md py-2'])
                                        </div>
                                    @endif
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
                <a wire:click="toggleState('state2')"
                    class="bg-secondary dark:bg-blue-800 hover:shadow-md duration-300 rounded-lg py-5 mb-5 text-black px-4 text-xl font-semibold flex justify-between gap-4 items-center cursor-pointer">
                    <div class="flex gap-3 items-center">
                        <h1>Historique</h1>
                    </div>
                    <i class="fa-solid {{ $state2 ? 'fa-angle-down' : 'fa-angle-up'}}"></i>
                    {{-- <i class="fa-solid @if ($state2) fa-angle-up @else fa-angle-down @endif"></i> --}}
                </a>
                {{-- block au click --}}
                @if ($state2)
                    <div class="flex flex-col">
                        @foreach ($history as $his)
                            <div class="mb-5 cursor-pointer">
                                <div wire:click="getMessage({{ $his->id }})"
                                    class="flex flex-row justify-between p-4 bg-gray-300 hover:shadow-lg duration-300 hover:bg-opacity-70 dark:bg-gray-800 rounded-md">
                                    <div class="flex flex-col">
                                        <p>Code client : {{ $his->user->customer_code }}</p>
                                        <p class="pt-2">Sujet : {{ $his->getSubject() }}</p>
                                        @if ($his->facture_number)
                                            <p class="pt-2">Numéro de Commande : {{ $his->facture_number }}</p>
                                        @endif
                                        <p class="pt-2">Date de la demande : {{ $his->getCreatedAt() }}</p>
                                        <div class="flex pt-2">
                                            <p class="mr-2">Status : {!! $his->getStateBadge() !!}</p>
                                        </div>
                                    </div>
                                    @if ($tick)
                                        @if ($tick->id == $his->id)
                                            <div wire:click.stop wire:click="stateMenu({{ $his->id }})">
                                                <i wire:click.stop wire:click="stateMenu({{ $his->id }})"
                                                    class="fa-solid fa-ellipsis-vertical pl-5 @if ($test == $his->id) dark:text-red-700 text-secondary @endif"></i>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                                @if ($test == $his->id)
                                    @livewire('components.sav.btn-cloture', ['ticket' => $tick, 'label' => 'Réouvrir le ticket', 'icon' => 'arrow-rotate-left', 'wire' => 'reOpenAdmin', 'class' => 'bg-gray-300 dark:bg-gray-800 rounded-md py-2'])
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        @livewire('components.notifications.notifications')
        <div class=" flex-1 h-full">
            <div class="flex flex-col h-full">
                <div class="h-full overflow-y-auto">
                    <div class="flex flex-col gap-6 h-full">
                        @if ($messages)
                            @foreach ($messages as $message)
                                <div class="flex @if (auth()->user()->id == $message->user_id) justify-end @else justify-start @endif mr-10">
                                    <div class="@if (auth()->user()->id == $message->user_id) bg-secondary  @else bg-[#f0f0f0] @endif rounded-lg w-3/4 h-28">
                                        <div class=" flex flex-col justify-center p-4">
                                            <div class="border-b pb-2">
                                                <h1 class="text-lg font-bold">Envoyé le {{ $message->getCreatedAt() }}
                                                    | par @if (auth()->user()->id == $message->user_id)
                                                        vous
                                                    @else
                                                        {{ $message->getCreatedBy()->firstname }}
                                                        {{ $message->getCreatedBy()->lastname }}
                                                    @endif
                                                </h1>
                                            </div>
                                            <div class="pt-2">
                                                <span class="font-medium">{{ $message->message }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="flex @if (auth()->user()->team) justify-start @else justify-end @endif mr-10">
                                <div class="@if (auth()->user()->id == $tick->user_id) bg-yellow-100 dark:bg-yellow-700 @else bg-gray-100 dark:bg-gray-900 @endif rounded-lg w-3/4 h-28">
                                    <div class=" flex flex-col justify-center p-4">
                                        <div class="border-b pb-2">
                                            <h1 class="text-lg font-bold">Envoyé le {{ $tick->getCreatedAt() }} | par
                                                @if (auth()->user()->id == $tick->user_id)
                                                    vous
                                                @else
                                                    {{ $tick->getCreatedBy()->firstname }}
                                                    {{ $tick->getCreatedBy()->lastname }}
                                                @endif
                                            </h1>
                                        </div>
                                        <div class="pt-2">
                                            <span class="font-medium">{{ $tick->message }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                @if ($messages)
                    <div class="border-t border-gray-200 dark:border-gray-700 flex">
                        <form wire:submit.prevent="messageInput" class="w-full">
                            <input type="text" id="submit"
                                @if (!$messages) disabled @elseif($tick->closed) disabled @endif
                                wire:model="message_input"
                                class="py-4 @if (!$messages) cursor-not-allowed @elseif($tick->closed) cursor-not-allowed @else hover:tracking-wider @endif pl-4 w-full outline-none border-none duration-300 dark:bg-inherit dark:text-white"
                                placeholder="Entrez le message à envoyer..">
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
