@if ($page !== 'about' && $page !== 'faq' && $page !== 'confidential' && $page !== 'legal')
    <div class="front-filters inline-flex items-center">
        <object data="{{ asset('img/icons/motorcycle-of-big-size-black-silhouette.svg') }}" width="40px"
            class="mr-5"></object>
        <div class="textfield-filter">
            <select wire:model="motor_brand">
                <option value="">Marque</option>
            </select>
        </div>
        <div class="textfield-filter ml-2">
            <select wire:model="motor_cylindree">
                <option value="">Cylindrée</option>
            </select>
        </div>
        <div class="textfield-filter ml-2">
            <select wire:model="motor_modele">
                <option value="">Modèle</option>
            </select>
        </div>
        <div class="textfield-filter ml-2">
            <select wire:model="motor_year">
                <option value="">Année</option>
            </select>
        </div>
        <div class="ml-2">
            <button class="btn-secondary"><i class="fa-solid fa-magnifying-glass mr-2"></i>Rechercher</button>
        </div>
    </div>
@endif
