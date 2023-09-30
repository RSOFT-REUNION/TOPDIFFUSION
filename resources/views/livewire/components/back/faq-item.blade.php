<div>
    @foreach ($showQuestionResponse as $faq)
            <div wire:click.stop="toggleAnswer({{ $faq->id }})" class="bg-gray-100 rounded-md p-5 mt-5 hover:shadow-lg duration-500">
                <div class="flex flex-row justify-between cursor-pointer">
                    <div class="flex flex-row items-center gap-x-5 group">
                        <i class="fa-solid {{ $showAnswers[$faq->id] ? 'fa-caret-down' : 'fa-caret-right' }} "></i>
                        @if($editing && $faq->id === $editingFaqId)
                            <input wire:click.stop class="font-bold text-xl" wire:model="currentQuestion" type="text" value="{{ $currentQuestion }}">

{{--                            <button wire:click="stopEditing({{ $faq->id }})">Enregistrer</button>--}}
                        @else
                            <h2 class="font-bold text-xl">{{ $faq->question }}</h2>
                        @endif
                    </div>
                    @if ($page == 'faq')
                        {{ null }}
                    @else
                        <div wire:click.stop class="flex flex-row gap-x-5 items-center">
                            @if($editing && $faq->id === $editingFaqId)
                                <button wire:click="stopEditing({{ $faq->id }})" class="cursor-pointer hover:bg-secondary duration-500 py-2 px-3 rounded-full"><i class="fa-solid fa-check fa-lg"></i></button>
                            @else
                            <a wire:click.stop="startEditing({{ $faq->id }})" class="cursor-pointer hover:bg-secondary duration-500 py-2 px-3 rounded-full"><i class="fa-solid fa-pencil"></i></a>
                            @endif
                            <a wire:click.stop="deleteFaq({{ $faq->id }})" class="cursor-pointer hover:bg-secondary duration-500 py-2 px-3 rounded-full"><i class="fa-solid fa-trash"></i></a>
                        </div>
                    @endif
                </div>
                @if($showAnswers[$faq->id])
                    <div class="flex flex-row justify-end mt-5 border-l pl-10 ml-1">
                        <div wire:click.stop class="bg-secondary rounded-md p-5 w-full">
                            @if($editing && $faq->id === $editingFaqId)
                                <input wire:model="currentResponse" type="text" value="{{ $currentResponse }}">
                            @else
                                {{ $faq->response }}
                            @endif
                        </div>
                    </div>
                @endif
            </div>
    @endforeach
    @include('components.flash-messages')
</div>
