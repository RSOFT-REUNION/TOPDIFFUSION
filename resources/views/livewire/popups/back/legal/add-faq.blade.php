<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h2><i class="fa-solid fa-plus mr-3"></i>Ajouter votre Question/Réponse</h2>
            </div>
            <div class="flex-none">
                <a wire:click="$emit('closeModal')" class="btn-icon block cursor-pointer"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>

    <form wire:submit='addFaqQuestion'>
        <div class="mx-7 my-5">
            <div class="textfield">
                <label for="question">Question<span class="text-red-500">*</span></label>
                <input type="text" id="question" placeholder="Entrez votre question" name="question" wire:model="question" class="@if($errors->has('question')) input-error @endif" value="{{ old('question') }}">
                @if($errors->has('question'))
                    <p class="text-error">{{ $errors->first('question') }}</p>
                @endif
            </div>
            <div class="textfield mt-2">
                <label for="reponse">Réponse<span class="text-red-500">*</span></label>
                <textarea type="text" id="reponse" rows="7" placeholder="Entrez votre réponse" name="reponse" wire:model="response" class="@if($errors->has('reponse')) input-error @endif" value="{{ old('reponse') }}"></textarea>
                @if($errors->has('reponse'))
                    <p class="text-error">{{ $errors->first('reponse') }}</p>
                @endif
            </div>
        </div>
        @if ($question && $response)
            <div class="flex my-5">
                <div class="mx-auto width-500">
                    <button type="submit" class="btn-secondary block w-full"><i class="fa-solid fa-plus mr-3"></i>Ajouter</button>
                </div>
            </div>
        @endif
    </form>
</div>
