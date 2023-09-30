<?php

namespace App\Http\Livewire\Components\Back;

use App\Models\Faq;
use Livewire\Component;

class FaqItem extends Component
{
    public $faq, $page;
    public $editing = false;
    public $editingFaqId = null;
    public $editedQuestions = [];
    public $editedResponses = [];

    public $showAnswers = [];

    public $currentQuestion = "";
    public $currentResponse = "";

    public $showSuccessAlert = true;


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

//    Méthode pour démarrer l'édition d'une question/réponse
    public function startEditing($faqId)
    {
        $faq = Faq::findOrFail($faqId);
        $this->editingFaqId = $faqId;
        $this->currentQuestion = $faq->question;
        $this->currentResponse = $faq->response;
        $this->editing = true;
    }


//    Méthode pour arrêter et enregistrer les modifications
    public function stopEditing($faqID)
    {
        $faqId = $faqID;
        $faq = Faq::where('id', $faqId)->first(); // Recherchez le modèle Faq par ID

        if ($faq) { // Vérifiez si le modèle a été trouvé
            // Mettez à jour les données du modèle directement
            $faq->question = $this->currentQuestion; // Utilisez la valeur de currentQuestion
            $faq->response = $this->currentResponse; // Utilisez la valeur de currentResponse

            $faq->update();

            $this->editing = false;
            // Message de confirmation ou effectuez
            session()->flash('success', 'La FAQ a été mise à jour avec succès');
        } else {
            // Gérez le cas où le modèle Faq n'a pas été trouvé
            session()->flash('error', 'La FAQ avec l\'ID ' . $faqId . ' n\'a pas été trouvée.');
        }

    }

    public function deleteFaq ($faqID)
    {
        $faqId = $faqID;
        $faq = Faq::where('id', $faqId)->first(); // Recherchez le modèle Faq par ID
        if ($faq) {
            $faq->delete();
            session()->flash('success', 'La FAQ a été supprimé avec succès');
        } else {
            // Gérez le cas où le modèle Faq n'a pas été trouvé
            session()->flash('error', 'La FAQ avec l\'ID ' . $faqId . ' n\'a pas été trouvée.');
        }
    }

    public function render()
    {
        $data = [];
        $data['showQuestionResponse'] = Faq::all();
        return view('livewire.components.back.faq-item', $data);
    }
}
