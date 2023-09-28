<?php

namespace App\Http\Livewire\Components\Back;

use Livewire\Component;

class FaqItem extends Component
{
    public $faq, $page;
    public $showAnswer = false;

    public function toggleAnswer()
    {
        $this->showAnswer = !$this->showAnswer;
    }

    public function render()
    {
        return view('livewire.components.back.faq-item');
    }
}
