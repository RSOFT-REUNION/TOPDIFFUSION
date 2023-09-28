@extends('layouts.backend')

@section('content-template')
    <div class="pl-[330px] pr-[30px]">
        <div class="flex items-center mb-7 py-[20px] px-[30px]">
            <div class="flex-1">
                <h1 class="font-bold text-[28px]">A Propos</h1>
            </div>
        </div>

        <div class="flex flex-col gap-y-2">
            <div x-data="{ isOpen: false }">
                <div class="bg-gray-100 flex flex-row items-center justify-between p-5 rounded-lg mb-7" @click="isOpen = !isOpen">
                    <h2 class="font-bold text-xl">Version 1.0</h2>
                    <i :class="isOpen ? 'fa-solid fa-sort-up' : 'fa-solid fa-sort-down pb-2' "></i>
                </div>
                <div x-cloak class="border-l ml-5 mb-7" x-show="isOpen"
                     x-transition:enter="transition ease-out duration-500"
                     x-transition:enter-start="opacity-0 transform translate-y-1"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-transition:leave="transition ease-in duration-500"
                     x-transition:leave-start="opacity-100 transform translate-y-0"
                     x-transition:leave-end="opacity-0 transform translate-y-1">
                    <div class="bg-secondary rounded-lg p-10 flex flex-row items-center text-black ml-10">
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi dignissimos praesentium facere modi ea commodi voluptatem, ut porro harum vitae omnis culpa pariatur, at maiores quis accusamus et, autem totam! Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti, minima provident libero cupiditate repellat nobis sint, ad illo necessitatibus earum enim eum nemo dolor nulla, dignissimos fugiat cumque. Possimus, impedit?
                            Sapiente architecto eveniet reiciendis obcaecati cum, iste a laborum molestiae magnam amet quidem commodi. Exercitationem, vitae? Quos, sequi iure laboriosam recusandae aperiam asperiores nihil ab expedita voluptates assumenda dolorem impedit.
                            Obcaecati assumenda, et reprehenderit vel maxime rerum sapiente, repudiandae, error eum eius officiis blanditiis totam. Exercitationem quos consequuntur nihil. Vero ipsa labore magni consectetur dolorem soluta deserunt quidem nesciunt consequuntur?
                            Fuga possimus laudantium in incidunt ipsa consectetur adipisci necessitatibus at ratione ullam ex atque commodi doloremque aspernatur, cumque placeat labore fugiat, autem cum. Numquam natus non, dolor ipsa quis animi.</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-100 flex flex-row items-center justify-between p-5 rounded-lg mb-7">
                <h2 class="font-bold text-xl">Version 0.5</h2>
                <i class="fa-solid fa-sort-down pb-2"></i>
            </div>
        </div>
    </div>
@endsection
