<?php

namespace App\Livewire\Frontend\Popups\Profile;

use App\Models\ActivityLog;
use App\Models\Bikes;
use App\Models\UserBike;
use LivewireUI\Modal\ModalComponent;

class AddBike extends ModalComponent
{
    public $kit_brand, $kit_model, $kit_cylinder, $kit_year;
    public $brands;
    public $models;
    public $cylinders;
    public $years;

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function mount()
    {
        $this->brands = Bikes::groupBy('brand')->pluck('brand');
    }

    public function updatedKitBrand($value)
    {
        $this->cylinders = Bikes::where('brand', $value)
            ->groupBy('cylinder')
            ->pluck('cylinder');
        $this->models = null;
        $this->years = null;
        $this->kit_model = null;
        $this->kit_year = null;
        $this->kit_cylinder = null;
    }

    public function updatedKitCylinder($value)
    {
        $this->models = Bikes::where('brand', $this->kit_brand)
            ->where('cylinder', $value)
            ->groupBy('model')
            ->pluck('model');
        $this->years = null;
        $this->kit_model = null;
        $this->kit_year = null;
    }

    public function updatedKitModel($value)
    {
        $this->years = Bikes::where('brand', $this->kit_brand)
            ->where('cylinder', $this->kit_cylinder)
            ->where('model', $value)
            ->groupBy('year')
            ->pluck('year');
        $this->kit_year = null;
    }

    public function submit()
    {
        $this->validate([
            'kit_brand' => 'required',
            'kit_model' => 'required',
            'kit_cylinder' => 'required',
            'kit_year' => 'required',
        ]);

        // Fonction de submit
        try {
            $bike = new UserBike;
            $bike->user_id = auth()->user()->id;
            $bike->bike_id = Bikes::where('brand', $this->kit_brand)
                ->where('model', $this->kit_model)
                ->where('cylinder', $this->kit_cylinder)
                ->where('year', $this->kit_year)
                ->first()->id;
            if($bike->save()) {
                // Log
                $log = new ActivityLog;
                $log->type = 'success';
                $log->key = 'user.add.bike';
                $log->title = 'Moto ajoutée';
                $log->description = 'L\'utilisateur ' . auth()->user()->code . ' a ajouté une moto à son profil';
                $log->save();

                return to_route('fo.profile')->with('success', 'Moto ajoutée avec succès');
            }

        } catch (\Exception $e) {
            // Ajout des erreurs dans les logs
            logger($e->getMessage());

            $log = new ActivityLog;
            $log->type = 'error';
            $log->key = 'user.add.bike';
            $log->title = 'Erreur lors de l\'ajout de la moto';
            $log->description = 'Une erreur est survenue lors de l\'ajout de la moto pour l\'utilisateur ' . auth()->user()->code;
            $log->error = $e->getMessage();
            $log->support_notified = true;
            $log->save();

            return to_route('fo.profile')->with('error', 'Une erreur est survenue lors de l\'ajout de la moto');
        }
    }

    public function render()
    {
        return view('livewire.frontend.popups.profile.add-bike');
    }
}
