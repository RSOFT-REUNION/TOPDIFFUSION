<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Hash;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        ProductCategory::create([
            'title' => 'VETEMENTS et EQUIPEMENTS PILOTE',
            'level' => '1',
            'slug' => 'vetements-equipements-pilote',
        ]);

        ProductCategory::create([
            'title' => 'CASQUES',
            'level' => '2',
            'parent_id' => 1,
            'slug' => 'casques',
        ]);

        ProductCategory::create([
            'title' => 'CASQUE JET',
            'level' => '3',
            'parent_id' => 2,
            'slug' => 'casque-jet',
        ]);

        ProductCategory::create([
            'title' => 'CASQUE MODULABLE',
            'level' => '3',
            'parent_id' => 2,
            'slug' => 'casque-modulable',
        ]);

        ProductCategory::create([
            'title' => 'CASQUE INTEGRAL',
            'level' => '3',
            'parent_id' => 2,
            'slug' => 'casque-integral',
        ]);

        ProductCategory::create([
            'title' => 'GARAGE et OUTILS',
            'level' => '1',
            'slug' => 'garage-outils',
        ]);

        ProductCategory::create([
            'title' => 'PNEUS et CHAMBRES',
            'level' => '1',
            'slug' => 'pneus-chambres',
        ]);

        ProductCategory::create([
            'title' => 'PNEUS AV',
            'level' => '2',
            'parent_id' => 7,
            'slug' => 'pneus-av',
        ]);

        ProductCategory::create([
            'title' => 'PNEUS AR',
            'level' => '2',
            'parent_id' => 7,
            'slug' => 'pneus-ar',
        ]);

        ProductCategory::create([
            'title' => 'CHAMBRES A AIR',
            'level' => '2',
            'parent_id' => 7,
            'slug' => 'chambres-air',
        ]);

        ProductCategory::create([
            'title' => 'VELOS',
            'level' => '1',
            'slug' => 'velos',
        ]);

        ProductCategory::create([
            'title' => 'Divers',
            'level' => '2',
            'parent_id' => 6,
            'slug' => 'divers',
        ]);
    }
}
