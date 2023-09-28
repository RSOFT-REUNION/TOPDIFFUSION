<div>
    <form wire:submit.prevent="createGroupUser">
        @csrf
        <div cart_resume class="textfield">
            <label for="title">Nom de Groupe Utilisateurs <span class="text-red-500">*</span></label>
            <input type="text" id="name" wire:model="name" placeholder="Entrez un titre de catégorie" class="@if($errors->has('name')) input-error @endif" value="{{ old('name') }}">
        </div>
        <div class="textfield mt-2">
            <label for="discount_percentage">Pourcentage de remise (%) <span class="text-red-500">*</span></label>
            <input type="text" wire:model="discount_percentage" id="discount_percentage" placeholder="Entrez une remise en pourcentage" class="@if($errors->has('discount_percentage')) input-error @endif" pattern="[0-9]+(\.[0-9]+)?" min="0" max="90" value="{{ old('discount_percentage') }}" />
        </div>
        <label for="isDefault">Groupe par défaut :</label>
        <input type="checkbox" wire:model="isDefault" id="isDefault">
        <div class="mt-10">
            <button type="submit" class="btn-secondary block w-full">Ajouter</button>
        </div>
    </form>
</div>
