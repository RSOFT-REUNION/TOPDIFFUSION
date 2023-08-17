<div id="front-header">
    <div class="entry-top">
        <div class="container mx-auto">
            <div class="flex items-center">
                <div class="flex-none">
                    <!-- LOGO -->
                    <a href="{{ route('front.home') }}"><img src="{{ asset('img/logos/Blue.svg') }}" width="250px"></a>
                </div>
                <div class="flex-grow text-center">
                    <!-- SEARCH BAR -->
                    <div class="width-500 mx-auto">
                        @livewire('components.template.search-front')
                    </div>
                </div>
                <div class="flex-none inline-flex items-center">
                    <!-- BUTTONS -->
                    @if(auth()->guest())
                        <a href="{{ route('front.login') }}" class="btn-outline mr-3"><i class="fa-solid fa-arrow-right-to-bracket mr-2"></i>Connexion</a>
                        <a href="{{ route('front.register') }}" class="btn-secondary"><i class="fa-solid fa-user-plus mr-2"></i>Créer un compte</a>
                    @else
                        <a href="" class="btn-icon mr-2" title="Favoris"><i class="fa-solid fa-heart"></i></a>
                        <a href="" class="btn-icon mr-2" title="Panier"><i class="fa-solid fa-cart-shopping"></i></a>
                        @if(auth()->user()->professionnal === 1 && auth()->user()->verified === 1)
                            @livewire('components.front-professionnal-switch')
                        @endif
                        <a href="{{ route('front.profile') }}" class="btn-secondary" title="Mon compte">Mon compte</a>
                        <a href="{{ route('logout') }}" class="btn-icon ml-2" title="Panier"><i class="fa-solid fa-arrow-right-to-bracket"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="entry-middle">
        <div class="container mx-auto">
            @livewire('components.template.front-menu')
        </div>
    </div>
    <div class="entry-bottom">
        <div class="container mx-auto flex flex-row justify-center">
            @livewire('components.template.front-filters')
        </div>
    </div>

</div>
