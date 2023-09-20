<?php

namespace App\Imports\back\product;

use App\Models\ProductCategory;
use Illuminate\Console\OutputStyle;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CategoriesImport implements ToCollection, WithBatchInserts, WithProgressBar, WithStartRow
{
    use Importable;
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row)
        {
            $categories = ProductCategory::where('title', $row[0])->first();
            if($categories) {
                // nothing
            } else {
                $characters = ["é", "è", "ê", "ë", "à", "'", " ", "_", "&", "ç", "ù", "\"", "î", "ï"];
                $correct_characters = ["e", "e", "e", "e", "a", "", "-", "-", "", "c", "u", "", "i", "i"];

                $cat = new ProductCategory;
                $cat->title = $row[0];
                if($row[1] != null) {
                    $cat->slug = strtolower(str_replace($characters, $correct_characters, $row[1]));
                } else {
                    $cat->slug = strtolower(str_replace($characters, $correct_characters, $row[0]));
                }
                $cat->description = $row[2];
                $cat->cover = $row[3];
                $cat->level = $row[4];
                if($row[6] != null) {
                    $cat->professionnal = $row[6];
                } else {
                    $cat->professionnal = 0;
                }
                if($cat->save()) {
                    if($row[5] != null) {
                        $parentCategory = ProductCategory::where('slug', $row[1])->first()->id;
                        $category = ProductCategory::where('id', $cat->id)->first();
                        $category->parent_id = $parentCategory;
                        $category->update();
                    }
                }
            }
        }
    }

    public function startRow(): int
    {
        return 2;
    }

    public function batchSize(): int
    {
        // Implement batchSize() method.
        return 3000;
    }
}
