<div>
    <x-templates.header-popup label="Mot de passe oublié" icon="question" />
    <div class="p-5">
        <p>
            Vous avez oublié votre mot de passe et vous êtes sur le point d'effectuer une demande de réinitialisation de
            votre mot de passe. Pour celà, entrez votre adresse e-mail et poursuivait les instructions indiquées dans le mail.
        </p>
        <form wire:submit.prevent="" class="mt-5">
            @csrf
            <x-elements.inputs.textfield label="Adresse e-mail" placeholder="Entrez votre adresse e-mail" name="email" type="email" class="" require="" livewire="" />
            <x-elements.buttons.btn-submit label="Envoyer" class="mt-5 w-full" icon=""/>
        </form>
    </div>

</div>
