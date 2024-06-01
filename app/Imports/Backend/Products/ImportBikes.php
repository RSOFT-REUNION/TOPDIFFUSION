<?php

namespace App\Imports\Backend\Products;

use App\Models\Bikes;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportBikes implements ToCollection, WithStartRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row)
        {
            $bikes_exist = Bikes::where('brand', $row[0])
                ->where('model', $row[1])
                ->where('cylinder', $row[2])
                ->where('year', $row[3])
                ->first();
            if($bikes_exist == true) {
                $bike = Bikes::find($bikes_exist->id);
                $bike->brand = $row[0];
                $bike->model = $row[1];
                $bike->cylinder = $row[2];
                $bike->year = $row[3];
                $bike->save();
            } else {
                $bike = new Bikes;
                $bike->brand = $row[0];
                $bike->model = $row[1];
                $bike->cylinder = $row[2];
                $bike->year = $row[3];
                $bike->save();
            }
        }
    }

    public function startRow(): int
    {
        return 2;
    }
}
