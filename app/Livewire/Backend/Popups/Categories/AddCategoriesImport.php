<?php

namespace App\Livewire\Backend\Popups\Categories;

use App\Imports\Backend\Products\ImportCategories;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Maatwebsite\Excel\Facades\Excel;

class AddCategoriesImport extends ModalComponent
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

    public function importCategories()
    {
        $this->validate();

        try{
            Excel::import(new ImportCategories, $this->file);

            // LOG
            $log = new ActivityLog;
            $log->type = 'success';
            $log->key = 'categories.import';
            $log->title = 'Importation des catégories';
            $log->description = 'Importation des catégories';
            $log->save();

            return to_route('bo.products.categories')->with('success', 'Importation des catégories effectuée avec succès !');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $this->addError('file', $e->getMessage());

            // LOG
            $log = new ActivityLog;
            $log->type = 'error';
            $log->key = 'categories.import';
            $log->title = 'Erreur lors de l\'importation des catégories';
            $log->description = 'Erreur lors de l\'importation des catégories';
            $log->error= $e->getMessage();
            $log->save();

            return to_route('bo.products.categories')->with('error', 'Erreur lors de l\'importation des catégories');
        }
    }

    public function render()
    {
        return view('livewire.backend.popups.categories.add-categories-import');
    }
}
