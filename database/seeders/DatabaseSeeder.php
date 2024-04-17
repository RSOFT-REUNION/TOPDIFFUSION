<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        ]);


        //Creating Settings
        $settings = \App\Models\SettingGeneral::create([
        'site_name' => 'Top Diffusion',
        'main_email' => 'dev@rsoft.re',
        ]);
    }
}
