<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\GroupUser;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        GroupUser::create(['title' => 'Administrateurs',]);
        GroupUser::create(['title' => 'Particuliers',]);
        GroupUser::create(['title' => 'Professionnels',]);


    // Admin RSOFT
        User::create([
            'customer_code' => 'RSOFT',
            'firstname' => 'admin',
            'lastname' => 'admin',
            'email' => 'dev@rsoft.re',
            'password' => Hash::make('password'),
            'verified' => 1,
            'rsoft_team' => 1,
            'grade' => 1,
            'team' => 1,
            'team_grade' => 1,
            'group_user' => 1,
        ]);

        // ADMIN client BAVARIA
        User::create([
            'customer_code' => 'BAVARIA',
            'firstname' => 'topdiffusion',
            'lastname' => 'admin',
            'email' => 'test@topdiffusion.re',
            'password' => Hash::make('Top1234'),
            'verified' => 1,
            'rsoft_team' => 1,
            'grade' => 1,
            'team' => 1,
            'team_grade' => 1,
            'group_user' => 1,
        ]);

        // Utilisateur particulier 1
        User::create([
            'customer_code' => 'particulier1',
            'firstname' => 'Jean',
            'lastname' => 'Hoareau',
            'email' => 'test1@part.re',
            'password' => Hash::make('Top1234'),
            'verified' => 1,
            'rsoft_team' => 0,
            'grade' => 0,
            'team' => 0,
            'team_grade' => 0,
            'group_user' => 2,
        ]);

        // Utilisateur particulier 2
        User::create([
            'customer_code' => 'particulier2',
            'firstname' => 'Paul',
            'lastname' => 'Hoareau',
            'email' => 'test2@part.re',
            'password' => Hash::make('Top1234'),
            'verified' => 0,
            'rsoft_team' => 0,
            'grade' => 0,
            'team' => 0,
            'team_grade' => 0,
            'group_user' => 2,
        ]);

        // Utilisateur professionnel
        User::create([
            'customer_code' => 'professionnel1',
            'firstname' => 'Elon',
            'lastname' => 'Musk',
            'email' => 'test@pro.re',
            'password' => Hash::make('Top1234'),
            'verified' => 1,
            'rsoft_team' => 0,
            'grade' => 0,
            'team' => 0,
            'team_grade' => 0,
            'group_user' => 3,
        ]);
    }
}

