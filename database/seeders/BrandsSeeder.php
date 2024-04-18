<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductBrand;

class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        ProductBrand::create([
            'title' => 'afam',
            'picture' => 'afam.png',
        ]);

        ProductBrand::create([
            'title' => 'alessi',
            'picture' => 'alessi.png',
        ]);

        ProductBrand::create([
            'title' => 'bosh',
            'picture' => 'bosh.png',
        ]);

        ProductBrand::create([
            'title' => 'brembo',
            'picture' => 'brembo.png',
        ]);

        ProductBrand::create([
            'title' => 'chevrolet',
            'picture' => 'chevrolet.png',
        ]);

        ProductBrand::create([
            'title' => 'klober',
            'picture' => 'klober.png',
        ]);

        ProductBrand::create([
            'title' => 'mercedes',
            'picture' => 'mercedes.png',
        ]);

        ProductBrand::create([
            'title' => 'nike',
            'picture' => 'nike.png',
        ]);

        ProductBrand::create([
            'title' => 'pirelli',
            'picture' => 'pirelli.png',
        ]);

        ProductBrand::create([
            'title' => 'shark',
            'picture' => 'shark.png',
        ]);

        ProductBrand::create([
            'title' => 'sony',
            'picture' => 'sony.png',
        ]);

        ProductBrand::create([
            'title' => 'suzuki',
            'picture' => 'suzuki.png',
        ]);


    }
}
