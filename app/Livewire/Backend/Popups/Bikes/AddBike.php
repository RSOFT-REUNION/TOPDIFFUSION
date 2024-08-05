<?php

namespace App\Livewire\Backend\Popups\Bikes;

use App\Models\ActivityLog;
use App\Models\Bikes;
use Livewire\Attributes\Rule;
use LivewireUI\Modal\ModalComponent;

class AddBike extends ModalComponent
{
    public $brand, $model, $cylinder, $year;

    #[Rule([
        'brand' => 'required|string',
        'model' => 'required|string',
        'cylinder' => 'required|string',
        'year' => 'required|string'
    ], message: [
        'brand.required' => 'La marque est obligatoire',
        'model.required' => 'Le modèle est obligatoire',
        'cylinder.required' => 'La cylindrée est obligatoire',
        'year.required' => 'L\'année est obligatoire'
    ])]

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addBike()
    {
        $this->validate();

        try {
            $bike = new Bikes;
            $bike->brand = strtoupper($this->brand);
            $bike->model = strtoupper($this->model);
            $bike->cylinder = strtoupper($this->cylinder);
            $bike->year = $this->year;
            if($bike->save()) {
                return to_route('bo.products.bikes')->with('success', 'La moto a été ajoutée avec succès');
            }
        } catch (\Exception $e) {
            $this->addError('error', $e->getMessage());

            // Log
            $log = new ActivityLog;
            $log->type = 'error';
            $log->key = 'bike.create';
            $log->title = 'Ajout d\'une moto';
            $log->description = 'Une erreur est survenue lors de l\'ajout de la moto ' . $this->brand . ' ' . $this->model . ' ' . $this->cylinder . ' ' . $this->year;
            $log->error = $e->getMessage();
            $log->support_notified = true;
            $log->save();

            return to_route('bo.products.bikes')->with('error', 'Une erreur est survenue lors de l\'ajout de la moto ' . $this->brand . ' ' . $this->model . ' ' . $this->cylinder . ' ' . $this->year);
        }
    }

    public function render()
    {
        return view('livewire.backend.popups.bikes.add-bike');
    }
}
