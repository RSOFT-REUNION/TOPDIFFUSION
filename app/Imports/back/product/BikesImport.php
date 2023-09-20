<?php

namespace App\Imports\back\product;

use App\Models\bike;
use Illuminate\Console\OutputStyle;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\WithStartRow;

class BikesImport implements ToCollection, WithBatchInserts, WithProgressBar, WithStartRow
{
    use Importable;
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row)
        {
            $bikes = bike::where('marque', $row[0])->where('cylindree', $row[1])->where('modele', $row[2])->where('annee', $row[3])->first();
            if($bikes) {
                // nothing
            } else {
                $bike = new bike;
                $bike->marque = strtoupper($row[0]);
                $bike->cylindree = strtoupper($row[1]);
                $bike->modele = strtoupper($row[2]);
                $bike->annee = strtoupper($row[3]);
                $bike->save();
            }
        }
    }

    public function batchSize(): int
    {
        // Implement batchSize() method.
        return 3000;
    }

    public function startRow(): int
    {
        // Implement startRow() method.
        return 2;
    }
}
