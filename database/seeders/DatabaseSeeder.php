<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Http\Livewire\Pages\Back\Products\Brands;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            UserSeeder::class,
            ProductCategorySeeder::class,
            BikesSeeder::class,
            BrandsSeeder::class,
            ProductSeeder::class,
        ]);


        //Creating Settings
        $settings = \App\Models\SettingGeneral::create([
        'site_name' => 'Top Diffusion',
        'main_email' => 'dev@rsoft.re',
        ]);
    }
}
