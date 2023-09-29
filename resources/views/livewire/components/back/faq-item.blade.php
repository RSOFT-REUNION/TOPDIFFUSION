<div>
    @foreach ($showQuestionResponse as $faq)
        <div wire:click="toggleAnswer({{ $faq->id}})" class="bg-gray-100 rounded-md p-5 mt-5 hover:shadow-lg duration-500">
            <div class="flex flex-row justify-between cursor-pointer">
                <div class="flex flex-row items-center gap-x-5 group">
                    <i class="fa-solid {{ $showAnswers[$faq->id] ? 'fa-caret-down' : 'fa-caret-right' }} "></i>
                    <h2 class="font-bold text-xl">{{ $faq->question }}</h2>
                </div>
                @if ($page == 'faq')
                    {{ null }}
                @else
                    <div class="flex flex-row gap-x-5 items-center">
                        <a wire:click.stop="" class="cursor-pointer hover:bg-secondary duration-500 py-2 px-3 rounded-full"><i class="fa-solid fa-pencil"></i></a>
                        <a wire:click.stop="" class="cursor-pointer hover:bg-secondary duration-500 py-2 px-3 rounded-full"><i class="fa-solid fa-trash"></i></a>
                    </div>
                @endif
            </div>
            @if($showAnswers[$faq->id])
                <div class="flex flex-row justify-end mt-5 border-l pl-10 ml-1">
                    <div class="bg-secondary rounded-md p-5">
                        {{ $faq->response }}
                    </div>
                </div>
            @endif
        </div>
    @endforeach
</div>