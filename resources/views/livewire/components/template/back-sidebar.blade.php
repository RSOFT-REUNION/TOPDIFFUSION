<div id="back_sidebar" class="h-screen">
    <div class="flex flex-col h-screen">
        <div class="flex-none force-center mt-3">
            <img src="{{ asset('img/logos/Blue.svg') }}" width="150px">
        </div>
        <div id="sidebar_entry-content" class="flex-1">
            @if ($group == 'home')
                <ul>
                    <li><a href="{{ route('back.dashboard') }}" class="btn-sidebar"><i
                                class="fa-solid fa-house-chimney mr-3"></i>Tableau de bord</a></li>
                    <li><a href="{{ route('back.dashboard') }}" class="btn-sidebar"><i
                                class="fa-solid fa-chart-column mr-3"></i>Statistiques</a></li>
                    <h2>Mon activité</h2>
                    <li><a href="{{ route('back.user.list') }}" class="btn-sidebar"><i
                                class="fa-solid fa-users mr-3"></i>Clients</a></li>
                    <li><a href="{{ route('back.product.list') }}" class="btn-sidebar"><i
                                class="fa-solid fa-cubes-stacked mr-3"></i>Produits</a></li>
                    <li><a href="{{ route('back.product.list') }}" class="btn-sidebar"><i
                                class="fa-solid fa-file-contract mr-3"></i>Commandes</a></li>
                    <li><a href="{{ route('back.product.list') }}" class="btn-sidebar"><i
                                class="fa-solid fa-comments mr-3"></i>S.A.V</a></li>
                    <h2>Mon site</h2>
                    <li><a href="{{ route('bouton.test') }}" class="btn-sidebar"><i
                                class="fa-solid fa-pager mr-3"></i>Pages</a></li>
                    <h2>Paramètres</h2>
                    <li><a href="{{ route('back.setting') }}" class="btn-sidebar"><i
                                class="fa-solid fa-sliders mr-3"></i>Réglages</a></li>
                    <li><a href="{{ route('back.product.list') }}" class="btn-sidebar"><i
                                class="fa-solid fa-people-group mr-3"></i>Équipes</a></li>
                    <li><a href="{{ route('back.product.list') }}" class="btn-sidebar"><i
                                class="fa-solid fa-circle-info mr-3"></i>À propos</a></li>
                </ul>
            @elseif($group == 'legal')
                <!--modif pages menu -->
                <ul>
                    <li><a href="{{ route('back.dashboard') }}" class="btn-sidebar border-b border-gray-300 mb-3"><i
                                class="fa-solid fa-arrow-left mr-3"></i>Retour</a></li>
                    <li><a href="{{ route('about') }}"
                            class="btn-sidebar @if ($page == 'about') btn-sidebar-active @endif">A-Propos</a>
                    </li>
                    <li><a href="{{ route('legal') }}"
                            class="btn-sidebar @if ($page == 'legal') btn-sidebar-active @endif">Mentions
                            Legales</a></li>
                    <li><a href="{{ route('confidential') }}"
                            class="btn-sidebar @if ($page == 'confidential') btn-sidebar-active @endif">Politique De
                            Confidentialite</a></li>
                    <li><a href="{{ route('faq') }}"
                            class="btn-sidebar @if ($page == 'faq') btn-sidebar-active @endif">Faq</a></li>
                </ul>
            @elseif($group == 'products')
                <!-- Products menus -->
                <ul>
                    <li><a href="{{ route('back.dashboard') }}" class="btn-sidebar border-b border-gray-300 mb-3"><i
                                class="fa-solid fa-arrow-left mr-3"></i>Retour</a></li>
                    <li><a href="{{ route('back.product.list') }}"
                            class="btn-sidebar @if ($page == 'list') btn-sidebar-active @endif"><i
                                class="fa-solid fa-cubes-stacked mr-3"></i>Produits</a></li>
                    <li><a href="{{ route('back.product.stocks') }}"
                            class="btn-sidebar @if ($page == 'stocks') btn-sidebar-active @endif"><i
                                class="fa-solid fa-boxes-stacked mr-3"></i>Stocks</a></li>
                    <li><a href="{{ route('back.product.categories') }}"
                            class="btn-sidebar @if ($page == 'categories') btn-sidebar-active @endif"><i
                                class="fa-solid fa-layer-group mr-3"></i>Catégories</a></li>
                    <li><a href="{{ route('back.product.bikes') }}"
                            class="btn-sidebar @if ($page == 'bikes') btn-sidebar-active @endif"><i
                                class="fa-solid fa-motorcycle mr-3"></i>Motos</a></li>
                    <li><a href="{{ route('back.product.bikes') }}"
                            class="btn-sidebar @if ($page == 'discounts') btn-sidebar-active @endif"><i
                                class="fa-solid fa-tags mr-3"></i>Promotions</a></li>
                    <li><a href="{{ route('back.product.brands') }}"
                            class="btn-sidebar @if ($page == 'brands') btn-sidebar-active @endif"><i
                                class="fa-solid fa-crown mr-3"></i>Marques</a></li>
                    <li><a href="{{ route('back.product.options') }}"
                            class="btn-sidebar @if ($page == 'options') btn-sidebar-active @endif"><i
                                class="fa-solid fa-sliders mr-3"></i>Options</a></li>
                </ul>
            @elseif($group == 'users')
                <!-- Users menus -->
                <ul>
                    <li><a href="{{ route('back.dashboard') }}" class="btn-sidebar border-b border-gray-300 mb-3"><i
                                class="fa-solid fa-arrow-left mr-3"></i>Retour</a></li>
                    <li><a href="{{ route('back.user.list') }}"
                            class="btn-sidebar @if ($page == 'list') btn-sidebar-active @endif"><i
                                class="fa-solid fa-users mr-3"></i>Clients</a></li>
                </ul>
            @elseif($group == 'settings')
                <!-- Settings menus -->
                <ul>
                    <li><a href="{{ route('back.dashboard') }}" class="btn-sidebar border-b border-gray-300 mb-3"><i
                                class="fa-solid fa-arrow-left mr-3"></i>Retour</a></li>
                    <li><a href="{{ route('back.setting') }}"
                            class="btn-sidebar @if ($page == 'general') btn-sidebar-active @endif"><i
                                class="fa-solid fa-sliders mr-3"></i>Réglages généraux</a></li>
                    <li><a href="{{ route('back.setting.payment') }}"
                            class="btn-sidebar mt-1 @if ($page == 'payment') btn-sidebar-active @endif"><i
                                class="fa-solid fa-credit-card mr-3"></i>Paiement & taxes</a></li>
                    <h2>Réglages avancée</h2>
                    <li><a href="{{ route('back.setting.avanced') }}"
                            class="btn-sidebar @if ($page == 'avance') btn-sidebar-active @endif"><i
                                class="fa-solid fa-gear mr-3"></i>Réglages généraux</a></li>
                    <li><a href="{{ route('back.setting.perform') }}"
                            class="btn-sidebar @if ($page == 'performance') btn-sidebar-active @endif"><i
                                class="fa-solid fa-gauge-simple-high mr-3"></i>Performances</a></li>
                </ul>
            @endif
        </div>
        <div id="sidebar_entry-footer" class="flex-none">
            <div class="inline-flex items-center justify-around w-full">
                <a href="{{ route('front.home') }}" class="btn-icon block mr-2" title="Retourner sur le site"><i
                        class="fa-solid fa-person-walking-arrow-loop-left"></i></a>
                <a href="" class="btn-icon block mr-2" title="Notifications"><i
                        class="fa-solid fa-bell"></i></a>
                <a href="" class="btn-icon block" title="Se déconnecter"><i
                        class="fa-solid fa-arrow-right-to-bracket"></i></a>
            </div>
        </div>
    </div>
</div>