<div>
    <div class="mt-4">
        <a href="{{ route('back.product.options') }}" class="btn-back"><i class="fa-solid fa-arrow-left mr-3"></i>Retour</a>
    </div>
    <div class="flex mt-10">
        <div class="flex-none width-300 mr-2 border-r border-gray-200 pr-2">
            <form wire:submit.prevent="add">
                @csrf
                <p>Vous êtes sur le point d'ajouter un tag pour le groupe <b>{{ $grouptag->title }}</b></p>
                <div class="textfield mt-3">
                    <label for="title">Titre<span class="text-red-500">*</span></label>
                    <input type="text" id="title" wire:model="title" placeholder="Entrez un nom de groupe" class="@if($errors->has('title')) input-error @endif" value="{{ old('title') }}">
                    @if($errors->has('title'))
                        <p class="text-error">{{ $errors->first('title') }}</p>
                    @endif
                </div>
                @if($grouptag->type == 1)
                    <div class="textfield mt-2">
                        <label for="key">Clé<span class="text-red-500">*</span></label>
                        <input type="text" id="key" wire:model="key" placeholder="Entrez une clé" class="@if($errors->has('key')) input-error @endif" value="{{ old('key') }}">
                        @if($errors->has('key'))
                            <p class="text-error">{{ $errors->first('key') }}</p>
                        @endif
                    </div>
                @else
                    <div class="textfield-color mt-2">
                        <label for="key">Couleur<span class="text-red-500">*</span></label>
                        <input type="color" id="key" wire:model="key" class="@if($errors->has('key')) input-error @endif" value="#000000">
                        @if($errors->has('key'))
                            <p class="text-error">{{ $errors->first('key') }}</p>
                        @endif
                    </div>
                @endif
                <div class="mt-5">
                    <button class="btn-secondary block w-full" type="submit">Ajouter</button>
                </div>
            </form>
        </div>
        <div class="flex-1 ml-2">
            @if($tags->count() == 0)
                <p class="empty-text">Vous n'avez pas encore ajouté de tags pour ce groupe</p>
            @else
                <div class="table-box-outline">
                    <table>
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Titre</th>
                            @if($grouptag->type == 1)
                                <th>Clé</th>
                            @else
                                <th>Couleur</th>
                            @endif
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($tags as $tag)
                                <tr>
                                    <td>{{ $tag->id }}</td>
                                    <td>{{ $tag->title }}</td>
                                    @if($grouptag->type == 1)
                                        <td>{{ $tag->key }}</td>
                                    @else
                                        <td><i class="fa-solid fa-circle" style="color: {{ $tag->key }}"></i></td>
                                    @endif
                                    <td><a href="" class="hover:text-red-500"><i class="fa-solid fa-trash"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
