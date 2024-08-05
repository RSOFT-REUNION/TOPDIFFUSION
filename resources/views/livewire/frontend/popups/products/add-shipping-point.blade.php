<div>
    <x-templates.header-popup label="Livraison à un point relais" icon=""/>
    <form wire:submit="addShipping" class="p-5">
        <div class="table-box-outline">
            <table>
                <thead>
                <tr>
                    <th></th>
                    <th>Nom</th>
                    <th>Adresse</th>
                </tr>
                </thead>
                <tbody>
                @foreach($points as $point)
                    <tr>
                        <td><input type="radio" name="point" id="point_{{ $point->id }}" wire:model="point" value="{{ $point->id }}"></td>
                        <td class="font-bold"><label for="point_{{ $point->id }}">{{ $point->name }}</label></td>
                        <td><label for="point_{{ $point->id }}">{{ $point->address }}@if($point->address_bis), {{ $point->address_bis }} @endif , {{ $point->city }} ({{ $point->zip_code }})</label></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-5">
            <button type="submit" class="btn btn-primary w-full">Valider</button>
        </div>
    </form>
</div>
