<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // Creating Admin User
        $admin = User::create([
            'customer_code' => 'admin',
            'firstname' => 'admin',
            'lastname' => 'admin',
            'email' => 'admin@rsoft.re',
            'password' => Hash::make('password'),
            'verified' => 1,
            'rsoft_team' => 1,
            'grade' => 1,
            'team' => 1,
            'team_grade' => 1,
            'group_user' => 1,
        ]);


        //Creating Settings
        $settings = \App\Models\SettingGeneral::create([
        'site_name' => 'Top Diffusion',
        'main_email' => 'dev@rsoft.re',
        ]);
    }
}
