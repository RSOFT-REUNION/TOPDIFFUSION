<div id="front-footer">
    <div class="entry-top">
        <div class="container mx-auto">
            <div class="grid grid-cols-4 gap-5">
                <div>
                    <h2>TOP DIFFUSION</h2>
                    <ul class="mt-7">
                        <li><a href="{{ route('front.about') }}">A propos de nous</a></li>
                        <li><a href="{{ route('front.legal') }}">Informations légales</a></li>
                        <li><a href="{{ route('front.confidential') }}">Politique de confidentialité des données</a></li>
                    </ul>
                </div>
                <div>
                    <h2>Liens rapide</h2>
                    <ul class="mt-7">
                        <li>Liste des produits</li>
                        @if (auth()->guest())
                            <li>Connexion à mon compte</li>
                            <li>Inscription</li>
                        @else
                            <li class="hover:cursor-pointer"><a href="{{ route('front.profile') }}">Mon compte</a></li>
                            <li class="hover:cursor-pointer"><a href="{{ route('logout') }}">Me déconnecter</a></li>
                        @endif
                        <li><a href="{{ route('front.faq') }}">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h2>Nous joindre</h2>
                    <ul class="mt-7">
                        <li><i class="fa-solid fa-phone mr-2"></i>0262 00 00 00</li>
                        <li><i class="fa-solid fa-at mr-2"></i>email-contact@test.com</li>
                    </ul>
                </div>
                <div>
                    <h2>Rester connecté !</h2>
                    <ul class="mt-7">
                        <li><i class="fa-brands fa-facebook mr-2"></i>Facebook</li>
                        <li><i class="fa-brands fa-instagram mr-2"></i>Instagram</li>
                        <li><i class="fa-brands fa-twitter mr-2"></i>Twitter</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="entry-bottom">
        <div class="flex items-center">
            <div class="flex-1">
                <p>TOP DIFFUSION - 2023 | Créer par RSOFT REUNION. Tous droits sont réservés.</p>
            </div>
            <div class="flex-none inline-flex items-center">
                <!-- PAYMENT METHOD -->
                <i class="fa-brands fa-cc-mastercard fa-2x mr-2"></i>
                <i class="fa-brands fa-cc-visa fa-2x"></i>
                @if (!auth()->guest() && auth()->user()->team == 1)
                    <a href="{{ route('back.dashboard') }}"
                        class="ml-2 border border-black px-2 py-1 rounded-lg hover:bg-black hover:text-white duration-300">Espace
                        d'administration</a>
                @endif
            </div>
        </div>
    </div>
</div>