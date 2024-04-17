<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create();

        $admin = User::create([
            'customer_code' => 'admin',
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

        $admin = User::create([
            'customer_code' => 'Bavaria',
            'firstname' => 'topdiffusion',
            'lastname' => 'admin',
            'email' => 'test@test.re',
            'password' => Hash::make('top1234'),
            'verified' => 1,
            'rsoft_team' => 1,
            'grade' => 1,
            'team' => 1,
            'team_grade' => 1,
            'group_user' => 1,
        ]);
    }
}
