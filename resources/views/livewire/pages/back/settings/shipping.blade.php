<div>
    <div id="entry-header" class="flex items-center">
        <div class="flex-1">
            <h1>Livraison</h1>
        </div>
    </div>
    <div id="entry-content">
        <p class="bg-red-100 border border-red-200 text-red-500 px-5 py-2 rounded-md">
            Vous devez noter que les frais de livraison ne sont pas applicables pour les professionnels
        </p>
        <div class="container-box-page mt-5">
            <div class="entry-header">
                <h2>Configuration de la livraison</h2>
            </div>
            <div class="entry-content">
                <div class="flex flex-row justify-between items-center border-b border-gray-200 pb-4 mt-4">
                    <div>
                        <h2>Frais de port et d'emballage</h2>
                        <p class="text-[13px] text-[#808080]">Vous pouvez définir un montant pour les frais de port et
                            l'emballage des produits.</p>
                    </div>
                    <form wire:submit.prevent="updateShippingPrice" class="inline-flex items-center">
                        @csrf
                        <div class="">
                            <input type="number" step="0.1" wire:model="shipping_price"
                                placeholder="Entrez un montant"
                                class="focus:outline-none p-3 rounded-lg w-80 bg-gray-200 border border-gray-300 text-sm">
                        </div>
                        @if ($setting->shipping_price != $shipping_price)
                            <button type="submit" class="ml-2 bg-[#FBBC34] px-4 py-2.5 rounded-lg"><i
                                    class="fa-solid fa-floppy-disk"></i></button>
                        @endif
                    </form>
                </div>

                <div class="flex flex-row justify-between items-center border-b border-gray-200 pb-4 mt-4">
                    <div>
                        <h2>Montant maximum pour une livraison payante</h2>
                        <p class="text-[13px] text-[#808080]">Vous pouvez définir un montant maximum pour qu'une
                            commande ait le droit à la livraison gratuite</p>
                    </div>
                    <form wire:submit.prevent="updateShippingLimit" class="inline-flex items-center">
                        @csrf
                        <div class="">
                            <input type="number" step="0.1" wire:model="shipping_limit"
                                placeholder="Entrez un montant"
                                class="focus:outline-none p-3 rounded-lg w-80 bg-gray-200 border border-gray-300 text-sm">
                        </div>
                        @if ($setting->shipping_limit != $shipping_limit)
                            <button type="submit" class="ml-2 bg-[#FBBC34] px-4 py-2.5 rounded-lg"><i
                                    class="fa-solid fa-floppy-disk"></i></button>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        {{-- Formulaire d'ajout de point relais --}}
        <div class="container-box-page mt-5">
            <div class="entry-header">
                <h2>Configuration des point relais</h2>
            </div>
            <div class="mx-4 mt-7">
                <div class="mt-2 flex items-center border-b border-gray-200 pb-4">
                    <div class="flex-1">
                        <h3 class="font-normal">Ajout d'un Point Relais</h3>
                        <p class="text-gray-500 text-sm">Créer les différents point relais disponible.</p>
                    </div>
                    <div class="flex-none">
                        <a wire:click="$emit('openModal', 'popups.back.setting.add-relay-point')" class="btn-secondary block cursor-pointer">Ajouter</a>
                    </div>
                </div>
                @if ($relays_points->isNotEmpty())
                    <div class="mt-4 flex items-center border-b border-gray-200 pb-4">
                        <div class="flex-1">
                            <h3 class="font-normal">Point Relais actuellement configuré</h3>
                            <p class="text-gray-500 text-sm">Ici vous pouvez voir vos point relais les modifier et les supprimers.</p>
                        </div>
                    </div>
                    <div class="flex flex-row justify-center items-center bg-black bg-opacity-60">
                        <div class="rounded-xl w-1/2 bg-white my-10">
                            <div class="flex flex-row items-center justify-between border-b border-gray-200 px-[30px] py-6">
                                <div class="flex flex-row items-center gap-x-4">
                                    <i class="fa-solid fa-map-location-dot text-[20px]"></i>
                                    <h2 class="text-[20px]">Point relais</h2>
                                </div>
                                <button><i class="fa-solid fa-xmark text-[20px]"></i></button>
                            </div>
                            {{-- Choix Point relais --}}
                            <div class="flex flex-col transition-all duration-500 gap-y-3 m-[40px]">
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
                                                        {{ $relay->address }}
                                                    </label>
                                                </div>
                                                <div class="flex flex-row items-center gap-x-5">
                                                    <div class="text-{{ $relay->available ? 'green' : 'red' }}-700 flex flex-row items-center justify-center bg-white rounded-[5px] py-3 px-4">
                                                        <h4>{{ $relay->available ? 'Disponible' : 'Pas disponible' }}</h4>
                                                    </div>
                                                    <div class="flex flex-row gap-x-5">
                                                        <button wire:click="$emit('openModal', 'popups.back.setting.update-relay-point', {{ json_encode(['id' => $relay->id]) }})">
                                                            <i class="fa-solid fa-pen"></i>
                                                        </button>
                                                        <button wire:click="deleteRelayPoint({{$relay->id}})">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </div>
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
                            {{-- <div class="flex flex-row justify-end w-full my-9">
                                <button wire:click="chooseRelay"
                                    class="py-3 duration-500 rounded-md bg-secondary px-9 hover:bg-primary hover:text-white">Validé</button>
                            </div> --}}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if (session()->has('success'))
        <div class="bg-green-500 py-5 fixed bottom-5 right-5 rounded-lg px-6" id="confirmation-success">
            {{ session('success') }}
        </div>
        <script>
            $(document).ready(function() {
                setTimeout(function() {
                    $('#confirmation-success').fadeOut();
                }, 2000);
            });
        </script>
    @endif
</div>
