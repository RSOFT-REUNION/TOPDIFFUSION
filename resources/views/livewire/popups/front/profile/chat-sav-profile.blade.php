<div>
    <div class="flex flex-row items-center justify-between py-5 px-6 border-b-2 border-gray-200">
        <div class="flex flex-row items-center text-xl font-bold">
            <h1 class="border-r-2 border-gray-200 pr-5">Commande : {{ $order['document_number'] }}</h1>
            <span class="border-r-2 border-gray-200 pr-5 pl-5">
                @switch($messageGroup['state'])
                    @case(1)
                        <span class="text-sm px-2 py-1 rounded-full font-bold" style="color: #d7a700"><i class="fa-solid fa-circle mr-2"></i>Envoyé au support</span>
                        @break
                    @case(2)
                        <span class="text-sm px-2 py-1 rounded-full font-bold" style="color: orangered"><i class="fa-solid fa-circle mr-2" style="color: orangered"></i>En cours de traitemant</span>
                        @break
                    @case(3)
                        <span class="text-sm px-2 py-1 rounded-full font-bold" style="color: green"><i class="fa-solid fa-circle mr-2" style="color: green"></i>Traité</span>
                        @break
                    @case(4)
                        <span class="text-sm px-2 py-1 rounded-full font-bold" style="color: dodgerblue"><i class="fa-solid fa-circle mr-2" style="color: dodgerblue"></i>Clôturé</span>
                        @break
                @endswitch
            </span>
            <span class="pl-5">Prix : {{ $order['total_amount'] }} €</span>
        </div>
        <div class="hover:bg-gray-200 duration-500 cursor-pointer px-2.5 py-1 rounded-full" onclick="Livewire.emit('closeModal')">
            <i class="fa-solid fa-xmark"></i>
        </div>
    </div>

    {{-- Pour afficher les message --}}
    <div class="h-[500px] p-4 flex flex-col gap-y-3 overflow-y-auto"
            x-data="{}"
            x-init="$el.scrollTop = $el.scrollHeight"
            wire:listen="messageSent"
            x-on:messageSent.window="$el.scrollTop = $el.scrollHeight">
        @foreach ($message as $messages)
            @php
                $user = \App\Models\User::where('id', $messages->user_id)->first();
            @endphp
            <div class="flex flex-row @if(auth()->user()->id == $messages->user_id) justify-end @else justify-start @endif">
                <div class="flex flex-col @if(auth()->user()->id == $messages->user_id) items-end @endif gap-y-2 w-1/2">
                    <h2 class="font-bold @if(auth()->user()->id == $messages->user_id) mr-16 @else ml-16  @endif">{{ $user->firstname }} {{ $user->lastname }}</h2>
                    <div class="flex flex-row gap-x-3 items-start">
                        @if(auth()->user()->id == $messages->user_id)
                            <div class="bg-primary text-white rounded-lg p-5">
                                <p>{{ $messages->message }}</p>
                                <div class="flex flex-row justify-end items-center">
                                    <h3 class=" text-xs">{{ $messages->created_at->diffForHumans() }}</h3>
                                </div>
                            </div>
                            <div class="font-bold text-xl px-3.5 py-2 bg-secondary rounded-full">{{ strtoupper(substr($user->firstname, 0, 1)) }}</div>
                        @else
                            <div class="font-bold text-xl px-3.5 py-2 bg-secondary rounded-full">B</div>
                            <div class="@if(auth()->user()->id == $messages->user_id) bg-primary text-white @else bg-gray-100 text-black @endif rounded-lg p-5">
                                <p>{{ $messages->message }}</p>
                                <div class="flex flex-row justify-end items-center">
                                    <h3 class=" text-xs">{{ $messages->created_at->diffForHumans() }}</h3>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach

        {{-- @if ()

        @endif --}}
        {{-- @foreach ($message as $messages)
        @if (auth()->user()->id == $messages->user_id)
        <div class="flex flex-row justify-start">
            <div class="flex flex-col gap-y-2 w-1/2">
                <h2 class="font-bold ml-16">Bruno VERPET</h2>
                <div class="flex flex-row gap-x-3 items-start">
                    <div class="font-bold text-xl px-3.5 py-2 bg-secondary rounded-full">B</div>
                    <div class="bg-gray-100 rounded-lg p-5">
                        <p>Lorem ipsum dolor sit amet consectetur. At integer vitae mi ipsum eu fames netus sapien blandit. Ipsum aliquam nibh viverra sodales quis semper et ullamcorper. Egestas elit aliquet rhoncus elementum nisl at eu molestie sed. Massa consectetur amet posuere volutpat phasellus faucibus.</p>
                        <div class="flex flex-row justify-end items-center">
                            <h3 class=" text-xs">2j</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach --}}

        {{-- @foreach ($message as $messages)
            @if (auth()->user()->id == $messages->user_id)
                @php
                    $user = \App\Models\User::where('id', $messages->user_id)->first();
                @endphp
                <div class="flex flex-row justify-end">
                    <div class="flex flex-col items-end gap-y-2 w-1/2">
                        <h2 class="font-bold mr-16">{{ $user->firstname }} {{ $user->lastname }}</h2>
                        <div class="flex flex-row gap-x-3 items-start">
                            <div class="bg-primary text-white rounded-lg p-5">
                                <p>{{ $messages->message }}</p>
                                <div class="flex flex-row justify-end items-center">
                                    <h3 class=" text-xs">{{ $messages->created_at->diffForHumans() }}</h3>
                                </div>
                            </div>
                            <div class="font-bold text-xl px-3.5 py-2 bg-secondary rounded-full">A</div>
                        </div>
                    </div>
                </div>
                @else
                <div class="flex flex-row justify-start">
                    <div class="flex flex-col gap-y-2 w-1/2">
                        <h2 class="font-bold ml-16">{{ $user->firstname }} {{ $user->lastname }}</h2>
                        <div class="flex flex-row gap-x-3 items-start">
                            <div class="font-bold text-xl px-3.5 py-2 bg-secondary rounded-full">B</div>
                            <div class="bg-gray-100 rounded-lg p-5">
                                <p>{{ $messages->message }}.</p>
                                <div class="flex flex-row justify-end items-center">
                                    <h3 class=" text-xs">{{ $messages->created_at->diffForHumans() }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach --}}

    </div>

    <div class="flex flex-row items-center justify-center bg-primary h-[120px] w-full border-t-2 border-gray-200">
        <div class="bg-white flex flex-row items-center justify-center w-3/5 rounded-xl">
            <div class="bg-secondary px-1.5 py-[2px] ml-6 flex justify-center items-center rounded-full cursor-pointer">
                <i class="fa-solid fa-plus text-sm"></i>
            </div>
            <form wire:submit.prevent="messageInput" class="flex flex-row w-full">
                <input class="w-full pl-4 py-4 outline-none hover:tracking-wider duration-500" autocomplete="off" type="text" name="chat" id="chat" placeholder="Entrez votre message ou sélectionner une image" wire:model="message_input">
                <button type="submit" class="mr-6 text-2xl cursor-pointer">
                    <i class="fa-solid fa-location-arrow"></i>
                </button>
            </form>
        </div>
    </div>
</div>
