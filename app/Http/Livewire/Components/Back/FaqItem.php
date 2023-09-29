<?php

namespace App\Http\Livewire\Components\Back;

use App\Models\Faq;
use Livewire\Component;

class FaqItem extends Component
{
    public $faq, $page;

    public $showAnswers = [];


    public function mount()
    {
        // Initialisez le tableau $showAnswers avec toutes les FAQs masquées par défaut
        $faqIds = Faq::pluck('id')->toArray();
        $this->showAnswers = array_fill_keys($faqIds, false);
    }

    public function toggleAnswer($faqId)
    {
        // Basculez la visibilité de la réponse pour cette FAQ en utilisant l'ID de la question
        $this->showAnswers[$faqId] = !$this->showAnswers[$faqId];
    }

    public function render()
    {
        $data = [];
        $data['showQuestionResponse'] = Faq::all();
        return view('livewire.components.back.faq-item', $data);
    }
}
