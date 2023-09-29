<?php

namespace App\Http\Livewire\Popups\Back\Legal;

use App\Models\Faq;
use LivewireUI\Modal\ModalComponent;

class AddFaq extends ModalComponent
{
    public $question, $response;

    public function addFaqQuestion()
    {
        $newFaq = new Faq();
        $newFaq->question = $this->question;
        $newFaq->response = $this->response;

        if ($newFaq->save()) {
            session()->flash('message', 'Nouvelle question réponse ajouté.');
        } else {
            session()->flash('message', 'Erreur lors de l\'ajout. Veuillez réessayer');
        }
    }

    public function render()
    {
        return view('livewire.popups.back.legal.add-faq');
    }
}
