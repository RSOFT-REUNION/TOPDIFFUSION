<?php

namespace App\Livewire\Backend\Popups\Bikes;

use App\Imports\Backend\Products\ImportBikes;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Maatwebsite\Excel\Facades\Excel;

class AddBikesImport extends ModalComponent
{
    use WithFileUploads;

    public $file;

    #[Rule([
        'file' => 'required|file|mimes:csv,txt'
    ], message: [
        'file.required' => 'Le fichier est obligatoire.',
        'file.file' => 'Le fichier doit être un fichier.',
        'file.mimes' => 'Le fichier doit être un fichier de type :values.',
    ])]

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function importBikes()
    {
        $this->validate();

        try{
            Excel::import(new ImportBikes, $this->file);

            // LOG
            $log = new ActivityLog;
            $log->type = 'success';
            $log->key = 'bike.import';
            $log->title = 'Importation des motos';
            $log->description = 'Importation des motos';
            $log->save();

            return to_route('bo.products.bikes')->with('success', 'Importation des motos effectuée avec succès !');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $this->addError('file', $e->getMessage());

            // LOG
            $log = new ActivityLog;
            $log->type = 'error';
            $log->key = 'bike.import';
            $log->title = 'Erreur lors de l\'importation des motos';
            $log->description = 'Erreur lors de l\'importation des motos';
            $log->error= $e->getMessage();
            $log->save();

            return to_route('bo.products.bikes')->with('error', 'Erreur lors de l\'importation des motos');
        }
    }

    public function render()
    {
        return view('livewire.backend.popups.bikes.add-bikes-import');
    }
}
