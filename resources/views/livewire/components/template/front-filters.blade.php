@if ($page !== 'about' && $page !== 'faq' && $page !== 'confidential' && $page !== 'legal' && $page !== 'produit')
    <div class="front-filters inline-flex items-center">
        <object data="{{ asset('img/icons/motorcycle-of-big-size-black-silhouette.svg') }}" width="40px" class="mr-5"></object>

        <div class="textfield-filter">
            <select wire:model="selectedBrand">
                <option value="">Marque</option>
                @foreach (array_unique($motor_brands) as $id => $brand)
                    <option value="{{ $brand }}">{{ $brand }}</option>
                @endforeach
            </select>
        </div>

        <div class="textfield-filter ml-2">
            <select class="@if(!$selectedBrand) cursor-not-allowed @endif" @if(!$selectedBrand) disabled @endif wire:model="selectedCylindree">
                <option value="">Cylindrée</option>
                @foreach (array_unique($motor_cylindree) as $id => $cylindree)
                    <option value="{{ $cylindree }}">{{ $cylindree }}</option>
                @endforeach
            </select>
        </div>

        <div class="textfield-filter ml-2">
            <select class="@if(!$selectedCylindree) cursor-not-allowed @endif" @if(!$selectedCylindree) disabled @endif wire:model="selectedModele">
                <option value="">Modèle</option>
                @foreach (array_unique($motor_modele) as $id => $modele)
                    <option value="{{ $modele }}">{{ $modele }}</option>
                @endforeach
            </select>
        </div>

        <div class="textfield-filter ml-2">
            <select class="@if(!$selectedModele) cursor-not-allowed @endif" @if(!$selectedModele) disabled @endif wire:model="selectedYear">
                <option value="">Année</option>
                @foreach (array_unique($motor_year) as $id => $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
        </div>

        <div class="ml-2">
            <button class="btn-secondary @if(!$selectedYear) cursor-not-allowed @endif"  @if(!$selectedYear) disabled @endif wire:click="search"><i class="fa-solid fa-magnifying-glass mr-2"></i>Rechercher</button>
        </div>
    </div>
@endif
