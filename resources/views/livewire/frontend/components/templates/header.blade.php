<div class="flex flex-col">
    <div class="flex-none py-2 bg-secondary"></div>
    <div class="grow bg-slate-100">
        <div class="container mx-auto">
            <div class="flex items-center justify-between py-3">
                {{-- Partie Gauche --}}
                <a href="{{ route('fo.home') }}"><img src="{{ asset('img/logos/Blue.svg') }}" width="200px"></a>

                {{-- Barre de recherche --}}
                <div class="relative">
                    <div class="textfield-search">
                        <label for="search"><i class="fa-solid fa-magnifying-glass"></i></label>
                        <input type="text" id="search" wire:model.live="search" placeholder="Rechercher un produit...">
                    </div>
                    @if(str($search)->length() > 2 && $search_results->count() > 0)
                        <div class="absolute mt-2 bg-white border drop-shadow-2xl p-3 w-full z-20 rounded-xl">
                            <ul>
                                @foreach($search_results as $result)
                                    <li>
                                        <a href="{{ route('fo.product.single', ['slug' => $result->slug]) }}">
                                            <div class="inline-flex items-center justify-between w-full hover:bg-slate-100 p-2 rounded-lg cursor-pointer">
                                                <div class="inline-flex items-center gap-5">
                                                    <img src="{{ asset('storage/products/covers/'. $result->cover) }}" width="50px" class="rounded-md"/>
                                                    <div>
                                                        <p class="font-bold">{{ $result->name }}</p>
                                                        <p class="text-sm text-slate-400">{{ $result->getBrand()->name }}</p>
                                                    </div>
                                                </div>
                                                <p class="font-title font-bold text-lg">{{ number_format($result->getUnitPrice(), 2, ',', ' ') }} €</p>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                {{-- Partie Droite --}}
                @if(!auth()->check())
                    <div class="inline-flex items-center relative" x-data="{connectMenu: false}" x-cloak @click.away="connectMenu = false">
                        <button @click="connectMenu = !connectMenu"  class="btn-primary" title="Connexion / Inscription"><i class="fa-solid fa-circle-user mr-3"></i>Connexion / Inscription</button>
                        <div x-show="connectMenu" x-transition class="absolute bg-white right-0 top-0 mt-14 w-[400px] z-10 drop-shadow-xl rounded-xl border overflow-hidden">
                            <div class="p-5">
                                <form wire:submit.prevent="login">
                                    @csrf
                                    <h2 class="font-bold text-lg mb-4">Connexion à votre compte</h2>
                                    <x-elements.inputs.textfield type="email" livewire="yes" name="email" label="Adresse e-mail" require="" class="" placeholder="Entrez votre adresse e-mail"/>
                                    <x-elements.inputs.textfield type="password" livewire="yes" name="password" label="Mot de passe" require="" class="mt-2" placeholder="Entrez votre mot de passe"/>
                                    <div class="text-right mt-2">
                                        <a wire:click="$dispatch('openModal', {component: 'frontend.popups.users.forgot-password'})" class="text-sm hover:underline underline-offset-4 hover:text-primary cursor-pointer">Mot de passe oublié ?</a>
                                    </div>
                                    <div class="">
                                        <button type="submit" class="btn-submit w-full mt-4" title="Se connecter">Se connecter</button>
                                    </div>
                                </form>
                            </div>
                            <div class="p-5 border-t">
                                <a href="{{ route('fo.register') }}" class="text-center block hover:underline underline-offset-4 hover:text-primary">Je ne possèdent pas encore de compte !</a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="inline-flex items-center relative gap-4">
                        <div class="relative">
                            @if($cart_count)
                                <a href="{{ route('fo.cart') }}" class="bg-slate-200 rounded-full py-2 hover:ring-1 ring-offset-2 px-4"><i class="fa-regular fa-cart-shopping"></i><span class="ml-3 font-title text-blue-500 font-bold">{{ $cart_count->getCartQuantityCount() }}</span></a>
                            @endif
                        </div>
                        @if(auth()->user()->type == 1)
                            <label class="inline-flex items-center cursor-pointer border-x px-2">
                                <input type="checkbox" value="" wire:click="selectPrices" @if($prices == 1) checked @endif class="sr-only peer">
                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Mes tarifs</span>
                            </label>
                        @endif
                        <div class="relative" x-data="{accountMenu: false}" x-cloak @click.away="accountMenu = false">
                            <button @click="accountMenu = !accountMenu" class="btn-primary"><i class="fa-regular fa-user mr-3"></i>Mon compte</button>
                            <div x-show="accountMenu" x-transition class="absolute bg-white z-20 border right-0 mt-2 w-[300px] rounded-xl drop-shadow-2xl">
                                <ul class="p-5">
                                    <li><a href="{{ route('fo.profile') }}" class="btn-sidebar"><div><i class="fa-regular fa-user text-slate-400 mr-3"></i>Mes informations</div></a></li>
                                    <li><a href="{{ route('fo.profile.favorite') }}" class="btn-sidebar"><div><i class="fa-regular fa-heart text-slate-400 mr-3"></i>Mes favoris</div></a></li>
                                </ul>
                                <ul class="p-5 border-t">
                                    <li><a wire:click="logout" class="btn-sidebar"><div><i class="fa-regular fa-arrow-right-from-bracket text-slate-400 mr-3"></i>Me déconnecter</div></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
    </div>
    <div class="flex-none bg-primary">
        {{-- Barre de menu --}}
        <div class="container mx-auto grid grid-cols-4 relative" x-data="{category: false}" x-cloak @click.away="category = false">
            <button @click="category = ! category" class="duration-300 bg-white/30 hover:bg-secondary hover:text-white py-4 font-bold"><i class="fa-solid fa-grid-2 mr-3"></i>Catégories produits</button>
{{--            <button class="duration-300 hover:bg-white/20 py-4 font-bold inline-flex items-center gap-3 justify-center w-full">--}}
{{--                <img src="{{ asset('img/icons/chain.svg') }}" width="24px"/>--}}
{{--                Kit chaine--}}
{{--            </button>--}}
{{--            <button class="duration-300 hover:bg-white/20 py-4 font-bold"><i class="fa-solid fa-tags mr-3"></i>Nos offres du moment</button>--}}
            <div x-show="category" x-transition class="absolute bg-white w-full top-0 mt-14 z-10 rounded-b-xl drop-shadow-2xl border overflow-hidden">
                <div class="flex">
                    <div class="flex-none w-[320px] border-r">
                        <ul>
                            @foreach($parent_categories as $parent)
                                <li><a wire:click="categorySelected({{ $parent->id }})" class="btn-list_category group">{{ $parent->name }}<i class="fa-regular fa-chevron-right text-slate-400 invisible group-hover:visible"></i></a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="flex-1">
                        @if($child_categories)
                            @if(count($child_categories) > 0)
                                <div class="p-5 grid grid-cols-3 gap-10">
                                    @foreach($child_categories as $child)
                                        <div>
                                            <a href="{{ route('fo.product.list.category', ['slug' => $child->slug]) }}" class="font-bold inline-flex items-center justify-between w-full group cursor-pointer duration-300 hover:text-primary">{{ $child->name }}<i class="fa-regular fa-chevron-right text-slate-400 invisible group-hover:visible"></i></a>
                                            <ul class="mt-3">
                                                @foreach($child_categories_2 as $sub_child)
                                                    @if($sub_child->parent_id_2 == $child->id)
                                                        <li><a href="{{ route('fo.product.list.category', ['slug' => $sub_child->slug]) }}" class="text-slate-400 duration-300 hover:text-primary inline-flex items-center justify-between w-full group">{{ $sub_child->name }}<i class="fa-regular fa-chevron-right text-slate-400 invisible group-hover:visible"></i></a></li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="flex h-full">
                                    <div class="m-auto">
                                        <div class="text-center mb-3">
                                            <i class="fa-duotone fa-icons fa-2xl"></i>
                                        </div>
                                        <p class="text-slate-400">Cette catégorie est vide</p>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="flex h-full">
                                <div class="m-auto">
                                    <div class="text-center mb-3">
                                        <i class="fa-duotone fa-icons fa-2xl"></i>
                                    </div>
                                    <p class="text-slate-400">Sélectionner une catégorie</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
