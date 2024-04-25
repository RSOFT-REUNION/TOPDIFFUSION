@extends('layouts.backend')

@section('content-template')
    <div id="back_page_content">
        <div id="entry-header" class="flex items-center mb-10">
            <div class="flex-1">
                <h1>F.A.Q</h1>
            </div>
            <div class="flex-none inline-flex items-center">
                <a onclick="Livewire.emit('openModal', 'popups.back.legal.add-faq')" class="btn-secondary cursor-pointer"><i class="fa-solid fa-plus mr-3"></i>Ajouter votre Question/Réponse</a>
            </div>
        </div>

                {{-- @foreach ($faq as $faqs)
            @livewire('components.back.faq-item', ['faq' => $faqs])
        @endforeach --}}

        @livewire('components.back.faq-item')
        {{-- @livewire('components.back.faq-item') --}}
    </div>

@endsection
