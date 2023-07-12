<?php

namespace App\Http\Livewire\Popups\Back\Products;

use App\Imports\back\product\BikesImport;
use App\Models\importFile;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class ImportBikes extends ModalComponent
{
    use WithFileUploads;
    public $file;

    public function import()
    {
        $name = \Illuminate\Support\Str::random(10);
        $import = new importFile;
        $import->file_name = $name;
        $import->file = $name. '' . $this->file->extension();
        $import->import_type = 2;
        if($import->save())
        {
            if((new BikesImport)->import($this->file)) {
                return redirect()->route('back.product.bikes');
            } else {
                $import->errors = 1;
                $import->update();
                return redirect()->route('back.product.bikes');
            }

        }
    }

    public function render()
    {
        return view('livewire.popups.back.products.import-bikes');
    }
}
