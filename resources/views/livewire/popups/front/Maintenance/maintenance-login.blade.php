<div>
    <div id="popup">
        <div class="entry-header">
            <div class="flex items-center">
                <div class="flex-1">
                    <h2>Importer un fichier</h2>
                </div>
                <div class="flex-none">
                    <a wire:click="$emit('closeModal')" class="btn-icon block cursor-pointer"><i class="fa-solid fa-xmark"></i></a>
                </div>
            </div>
        </div>
        <div class="entry-content">
            @if($errors->has('error_input'))
                <p class="box-error mt-3"><i class="fa-solid fa-circle-exclamation mr-3"></i>{{ $errors->first('error_input') }}</p>
            @endif
            <div class="mt-2">
                <div class="container-box-content">
                    <form method="POST">
                        @csrf

                        <div class="textfield">
                            <label for="email">Adresse e-mail</label>
                            <input type="email" id="email" placeholder="Entrez votre adresse e-mail" name="email" value="{{ old('email') }}">
                        </div>
                        <div class="textfield mt-2">
                            <label for="password">Mot de passe</label>
                            <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" class="@if($errors->has('password')) input-error @endif">
                            @if($errors->has('password'))
                                <p class="text-error">{{ $errors->first('password') }}</p>
                            @endif
                        </div>
                        <div class="mt-3 mx-5 flex items-center">
                            <div class="flex-1">
                                <div class="textfield-checkbox">
                                    <input type="checkbox" id="remember" name="remember">
                                    <label for="remember">Se souvenir de moi</label>
                                </div>
                            </div>
                            <div class="flex-none">
                                <a href="" class="">Mot de passe oublié ?</a>
                            </div>
                        </div>

                        <div class=" mt-5">
                            <div class="w-full">
                                <button type="submit" class="btn-secondary block w-full"><i class="fa-solid fa-arrow-right-to-bracket mr-2"></i>Se connecter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
