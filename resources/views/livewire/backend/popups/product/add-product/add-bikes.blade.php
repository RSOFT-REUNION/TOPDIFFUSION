<div>
    <x-templates.header-popup label="Ajouter des motos" icon=""/>
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
                                <button type="submit">Ajouter à la liste</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @if($bike_selected)
            <div class="mt-5 table-box">
                <table>
                    <thead>
                    <tr>
                        <th>Marque</th>
                        <th>Cylindrée</th>
                        <th>Modèle</th>
                        <th>Année</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bike_selected as $index => $bike)
                        <tr class="group">
                            <td>{{ $bike['brand'] }}</td>
                            <td>{{ $bike['cylinder'] }}</td>
                            <td>{{ $bike['model'] }}</td>
                            <td>{{ $bike['year'] }}</td>
                            <td>
                                <button wire:click="deleteBike({{ $index }})" class="group-hover:visible invisible text-red-500"><i class="fa-regular fa-delete-left"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        <div class="mt-5 text-right">
            <button wire:click="addBikes" class="btn-primary">Ajouter les motos au produit</button>
        </div>
    </div>
</div>
