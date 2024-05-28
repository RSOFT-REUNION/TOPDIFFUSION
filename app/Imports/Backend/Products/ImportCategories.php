<?php

namespace App\Imports\Backend\Products;

use App\Models\ProductCategory;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportCategories implements ToCollection, WithStartRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row)
        {
            $slug = Str::slug($row[0]);
            $categories_exist = ProductCategory::where('slug', $slug)->first();
            if($categories_exist == true) {
                $category = ProductCategory::find($categories_exist->id);
                $category->name = $row[0];
                $category->slug = $slug;
                $category->description = $row[1];
                $category->icon = $row[2];
                if($row[3]) {
                    // Identifier la catégorie parente
                    $parent = ProductCategory::where('name', $row[3])->first();
                    if($parent->parent_id) {
                        $category->parent_id = $parent->parent_id;
                        $category->parent_id_2 = $parent->id;
                    } else {
                        $category->parent_id = $parent->id;
                    }
                }
                $category->save();
            } else {
                $category = new ProductCategory;
                $category->name = $row[0];
                $category->slug = $slug;
                $category->description = $row[1];
                $category->icon = $row[2];
                if($row[3]) {
                    // Identifier la catégorie parente
                    $parent = ProductCategory::where('name', $row[3])->first();
                    if($parent->parent_id) {
                        $category->parent_id = $parent->parent_id;
                        $category->parent_id_2 = $parent->id;
                    } else {
                        $category->parent_id = $parent->id;
                    }
                }
                $category->save();
            }
        }
    }

    public function startRow(): int
    {
        return 2;
    }
}
