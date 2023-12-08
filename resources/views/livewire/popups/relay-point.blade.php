<div>
    {{-- Header --}}
    <div class="flex flex-row items-center justify-between bg-white border border-b border-gray-200 px-[30px] py-6">
        <div class="flex flex-row items-center gap-x-4">
            <i class="fa-solid fa-map-location-dot text-[20px]"></i>
            <h2 class="text-[20px]">Point relais</h2>
        </div>
        <button wire:click="$emit('closeModal')"><i class="fa-solid fa-xmark text-[20px]"></i></button>
    </div>

    {{-- Body --}}
    <div class="px-[20px]">
        {{-- Message de description --}}
        <div
            class="flex flex-row items-center justify-center bg-secondary bg-opacity-20 border border-secondary rounded-lg text-[16px] py-3 w-full my-9">
            <h3>Choisissez votre point de relais pour venir récupéré votre commande.</h3>
        </div>
        {{-- Choix Point relais --}}
        <div class="flex flex-col transition-all duration-500 gap-y-3">
            @foreach ($relays_points as $relay)
            <div class="flex flex-col {{ $relay->available ? 'bg-secondary border-primary text-primary' : 'bg-primary border-secondary text-secondary' }} w-full rounded-[8px] p-4 duration-500">
                    <div class="flex items-center">
                        <div class="flex flex-row items-center pr-4 my-3 border-r border-white">
                            <input type="radio" wire:model="selectedRelay" value="{{ $relay->id }}"
                                class="text-[20px]" name="choix" id="choix_{{ $relay->id }}">
                        </div>
                        <div class="flex flex-row items-center justify-between w-full ml-4">
                            <div class="flex items-center gap-x-3">
                                <i class="fa-solid fa-location-dot text-[20px]"></i>
                                <label for="choix_{{ $relay->id }}" class="select-none">{{ $relay->name }},
                                    {{ $relay->address }}</label>
                            </div>
                            <div
                                class="text-{{ $relay->available ? 'green' : 'red' }}-700 flex flex-row items-center justify-center bg-white rounded-[5px] py-3 px-4">
                                <h4>{{ $relay->available ? 'Disponible' : 'Pas disponible' }}</h4>
                            </div>
                        </div>
                    </div>
                    @if ($selectedRelay == $relay->id)
                        <div class="flex flex-col ml-10 duration-500 opacity-100 gap-y-3 max-h-96" id="selected">
                            <div class="flex flex-row items-center pt-4 mt-4 border-t gap-x-3 op border-primary">
                                <i class="fa-solid fa-clock text-[20px]"></i>
                                <h5>Horaire d'ouverture</h5>
                            </div>
                            <div class="flex">
                                <div class="w-1/2 border-r border-primary">
                                    @foreach (['Lundi', 'Mardi', 'Mercredi'] as $day)
                                        <div class="flex flex-row items-center gap-x-3">
                                            <span>{{ $day }}</span>
                                            <i class="fa-solid fa-arrow-right-long"></i>
                                            @if (isset($formattedOpeningHours[$day]))
                                                <span>{{ $formattedOpeningHours[$day] }}</span>
                                            @else
                                                <span>Aucune information</span>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                <div class="pl-5">
                                    @foreach (['Jeudi', 'Vendredi', 'Samedi'] as $day)
                                        <div class="flex flex-row items-center gap-x-3">
                                            <span>{{ $day }}</span>
                                            <i class="fa-solid fa-arrow-right-long"></i>
                                            @if (isset($formattedOpeningHours[$day]))
                                                <span>{{ $formattedOpeningHours[$day] }}</span>
                                            @else
                                                <span>Aucune information</span>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        <div class="flex flex-row justify-end w-full my-9">
            <button wire:click="chooseRelay"
                class="py-3 duration-500 rounded-md bg-secondary px-9 hover:bg-primary hover:text-white">Validé</button>
        </div>
    </div>
</div>
