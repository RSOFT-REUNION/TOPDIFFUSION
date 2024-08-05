<div>
    <x-templates.header-popup label="Ajouter une moto" icon=""/>
    <div class="p-5">
        <form wire:submit.prevent="submit">
            @csrf
            <div class="">
                <div class="container mx-auto">
                    <div class="bg-white rounded-xl p-3">
                        <div class="inline-flex items-center w-full">
                            <div class="textfield-kit">
                                {{-- Marques --}}
                                <select wire:model.live="kit_brand">
                                    <option value="">Marque</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand }}">{{ $brand }}</option>
                                    @endforeach
                                </select>
                                {{-- Marques --}}
                                <select wire:model.live="kit_cylinder" class="border-l">
                                    <option value="">Cylindrée</option>
                                    @if($cylinders)
                                        @foreach($cylinders as $cylinder)
                                            <option value="{{ $cylinder }}">{{ $cylinder }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                {{-- Marques --}}
                                <select wire:model.live="kit_model" class="border-l">
                                    <option value="">Modèle</option>
                                    @if($models)
                                        @foreach($models as $model)
                                            <option value="{{ $model }}">{{ $model }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                {{-- Marques --}}
                                <select wire:model.live="kit_year" class="border-x">
                                    <option value="">Année</option>
                                    @if($years)
                                        @foreach($years as $year)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                {{-- Boutton d'envoi --}}
                                <button type="submit">Configurer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
