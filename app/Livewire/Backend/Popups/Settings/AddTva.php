<?php

namespace App\Livewire\Backend\Popups\Settings;

use App\Models\ActivityLog;
use App\Models\TvaRate;
use Livewire\Attributes\Rule;
use LivewireUI\Modal\ModalComponent;

class AddTva extends ModalComponent
{
    public $name, $amount, $country, $state, $default;

    #[Rule([
        'name' => 'required|string',
        'amount' => 'required|numeric',
        'country' => 'required|string',
        'state' => 'required|string',
        'default' => 'nullable|boolean',
    ], message: [
        'name.required' => 'Le nom est obligatoire',
        'name.string' => 'Le nom doit être une chaîne de caractères',
        'amount.required' => 'Le montant est obligatoire',
        'amount.numeric' => 'Le montant doit être un nombre',
        'country.required' => 'Le pays est obligatoire',
        'country.string' => 'Le pays doit être une chaîne de caractères',
        'state.required' => 'L\'état est obligatoire',
        'state.string' => 'L\'état doit être une chaîne de caractères',
        'default.boolean' => 'La valeur par défaut doit être un booléen',
    ])]

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addTva()
    {
        $this->validate();

        try {
            $tva = new TvaRate;
            $tva->name = $this->name;
            $tva->rate = $this->amount;
            $tva->country = $this->country;
            $tva->state = $this->state;
            if($this->default) {
                $tva->default = 1;
            } else {
                $tva->default = 0;
            }
            if($tva->save()) {
                // Ajout dans les logs
                $log = new ActivityLog;
                $log->type = 'success';
                $log->key = 'tva.create';
                $log->title = 'Ajout de TVA';
                $log->description = 'Ajout de la TVA ' . $this->name;
                $log->save();

                return to_route('bo.setting.payment')->with('success', 'La TVA a bien été ajoutée');
            }
        } catch (\Exception $e) {
            // Ajout dans les logs
            $log = new ActivityLog;
            $log->type = 'error';
            $log->key = 'tva.create';
            $log->title = 'Ajout de TVA';
            $log->description = 'Erreur lors de l\'ajout de la TVA ' . $this->name;
            $log->error = $e->getMessage();
            $log->support_notified = true;
            $log->save();

            return to_route('bo.setting.payment')->with('error', 'Erreur lors de l\'ajout de la TVA');
        }
    }

    public function render()
    {
        return view('livewire.backend.popups.settings.add-tva');
    }
}
