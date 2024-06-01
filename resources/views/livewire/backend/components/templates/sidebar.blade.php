<div class="w-[300px] border-r flex flex-col h-screen fixed bg-slate-100">
    @if($group_page === 'backend')
        <div class="flex-none">
            {{-- Logo --}}
            <div class="force-center py-3">
                <img src="{{ asset('img/logos/Blue.svg') }}" width="70%">
            </div>
        </div>
        <div class="grow border-t p-2">
            <ul>
                <li><x-elements.buttons.btn-sidebar1 route="{{ route('bo.dashboard') }}" page="{{ $page }}" my-page="dashboard" class="" icon="grid-2" label="Tableau de bord" count=""/></li>
            </ul>
            <h2 class="my-3 ml-3 text-slate-400 text-sm">Activité</h2>
            <ul>
                <li><x-elements.buttons.btn-sidebar1 route="{{ route('bo.customers') }}" page="{{ $page }}" my-page="customers" class="" icon="user" label="Clients" count="{{ $customers }}"/></li>
                <li><x-elements.buttons.btn-sidebar1 route="{{ route('bo.orders') }}" page="{{ $page }}" my-page="orders" class="" icon="boxes-packing" label="Commandes" count=""/></li>
                <li><x-elements.buttons.btn-sidebar1 route="{{ route('bo.products.list') }}" page="{{ $page }}" my-page="products" class="" icon="boxes-stacked" label="Produits" count=""/></li>
            </ul>
{{--            <h2 class="my-3 ml-3 text-slate-400 text-sm">Personnalisation</h2>--}}
            <h2 class="my-3 ml-3 text-slate-400 text-sm">Réglages</h2>
            <ul>
                <li><x-elements.buttons.btn-sidebar1 route="{{ route('bo.setting.team') }}" page="{{ $page }}" my-page="teams" class="" icon="users" label="Équipes" count=""/></li>
                <li><x-elements.buttons.btn-sidebar1 route="{{ route('bo.setting.shipping') }}" page="{{ $page }}" my-page="shipping" class="" icon="truck-fast" label="Livraison" count=""/></li>
                <li><x-elements.buttons.btn-sidebar1 route="{{ route('bo.setting.payment') }}" page="{{ $page }}" my-page="payment" class="" icon="euro-sign" label="Paiement" count=""/></li>
{{--                <li><x-elements.buttons.btn-sidebar1 route="{{ route('bo.setting') }}" page="{{ $page }}" my-page="settings" class="" icon="sliders" label="Réglages" count=""/></li>--}}
            </ul>
        </div>
    @elseif($group_page == 'customers')
        <div class="flex-none inline-flex items-center gap-5 p-5">
            <a href="{{ route('bo.dashboard') }}" class="border py-3 px-4 rounded-lg hover:bg-slate-200 duration-300" title="Retour au tableau de bord"><i class="fa-solid fa-arrow-left"></i></a>
            <h2 class="font-title font-bold text-xl">Clients</h2>
        </div>
        <div class="grow border-t p-2">
            <ul>
                <li><x-elements.buttons.btn-sidebar1 route="{{ route('bo.customers') }}" page="{{ $page }}" my-page="users" class="" icon="grid-2" label="Clients" count="{{ $customers }}"/></li>
                <li><x-elements.buttons.btn-sidebar1 route="{{ route('bo.customers.group') }}" page="{{ $page }}" my-page="group" class="" icon="users-between-lines" label="Groupes client" count="{{ $groups }}"/></li>
            </ul>
        </div>
    @elseif($group_page == 'products')
        <div class="flex-none inline-flex items-center gap-5 p-5">
            <a href="{{ route('bo.dashboard') }}" class="border py-3 px-4 rounded-lg hover:bg-slate-200 duration-300" title="Retour au tableau de bord"><i class="fa-solid fa-arrow-left"></i></a>
            <h2 class="font-title font-bold text-xl">Produits</h2>
        </div>
        <div class="grow border-t p-2">
            <ul>
                <li><x-elements.buttons.btn-sidebar1 route="{{ route('bo.products.list') }}" page="{{ $page }}" my-page="products" class="" icon="box-open-full" label="Produits" count="{{ $products }}"/></li>
                <li><x-elements.buttons.btn-sidebar1 route="{{ route('bo.products.stock') }}" page="{{ $page }}" my-page="stocks" class="" icon="boxes-stacked" label="Stocks" count="{{ $stocks }}"/></li>
                <li><x-elements.buttons.btn-sidebar1 route="{{ route('bo.products.categories') }}" page="{{ $page }}" my-page="categories" class="" icon="layer-group" label="Catégories produits" count="{{ $product_categories }}"/></li>
                <li><x-elements.buttons.btn-sidebar1 route="{{ route('bo.products.brands') }}" page="{{ $page }}" my-page="brands" class="" icon="gem" label="Marques" count="{{ $product_brands }}"/></li>
                <li><x-elements.buttons.btn-sidebar1 route="{{ route('bo.products.bikes') }}" page="{{ $page }}" my-page="bikes" class="" icon="motorcycle" label="Motos" count="{{ $bikes }}"/></li>
                <li><x-elements.buttons.btn-sidebar1 route="{{ route('bo.products.attributes') }}" page="{{ $page }}" my-page="attributes" class="" icon="grid-2-plus" label="Attributs" count="{{ $attributes }}"/></li>
            </ul>
        </div>
    @endif
    {{--<div class="flex-none border-t p-3">
        <x-elements.buttons.btn-sidebar2 label="Contacter le support" :route="route('fo.home')" class="" icon="headset" />
    </div>--}}
    <div class="flex-none border-t p-3">
        <x-elements.buttons.btn-sidebar2 label="Retourner au site" :route="route('fo.home')" class="" icon="arrow-left" />
    </div>
</div>
