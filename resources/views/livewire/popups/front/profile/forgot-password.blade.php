<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h2>Réinitialisation de mon mot de passe</h2>
            </div>
            <div class="flex-none">
                <a wire:click="$emit('closeModal')" class="btn-icon block cursor-pointer"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>

    <div class="entry-content">
        <p class="text-slate-400">Vous avez oublié votre mot de passe et vous êtes sur le point d'effectuer une demande de réinitialisation de votre mot de passe. Pour celà, entrez votre adresse e-mail et poursuivait les instructions indiquées dans le mail.</p>
        <form wire:submit.prevent="sendEmail" class="mt-5">
            @csrf
            <div class="textfield">
                <label for="email">Votre adresse e-mail</label>
                <input type="email" id="email" wire:model="email" placeholder="Entrez votre adresse e-mail" value="{{ $email }}">
                @error('email')
                    <p class="text-error">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-5 text-center">
                <button type="submit" class="btn-secondary">Envoyer une demande de reinitialisation</button>
            </div>
        </form>
    </div>
</div>
