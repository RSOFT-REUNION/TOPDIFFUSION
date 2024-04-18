<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\bike;
use Illuminate\Support\Facades\Hash;

class BikesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // desired format of data
        bike::create(['marque'=> 'ADIVA SCOOTERS','cylindree' => '400','modele'=> 'AD 400','annee'=> '2009']);
        bike::create(['marque'=> 'ADIVA SCOOTERS','cylindree' => '400','modele'=> 'AD 400','annee'=> '2010']);
        bike::create(['marque'=> 'ADIVA SCOOTERS','cylindree' => '400','modele'=> 'AD 400','annee'=> '2011']);
        bike::create(['marque'=> 'ADLY','cylindree' => '50','modele'=> 'NB 50 Noble','annee'=> '2008']);
        bike::create(['marque'=> 'ADLY','cylindree' => '50','modele'=> 'NB 50 Noble','annee'=> '2009']);
        bike::create(['marque'=> 'ADLY','cylindree' => '50','modele'=> 'NB 50 Noble','annee'=> '2010']);
        bike::create(['marque'=> 'ADLY','cylindree' => '50','modele'=> 'P 50 Panther','annee'=> '2002']);
        bike::create(['marque'=> 'ADLY','cylindree' => '50','modele'=> 'P 50 Panther','annee'=> '2003']);
        bike::create(['marque'=> 'ADLY','cylindree' => '50','modele'=> 'P 50 Panther','annee'=> '2004']);
        bike::create(['marque'=> 'ADLY','cylindree' => '50','modele'=> 'P 50 Panther','annee'=> '2005']);
        bike::create(['marque'=> 'ADLY','cylindree' => '50','modele'=> 'P 50 Panther','annee'=> '2006']);
        bike::create(['marque'=> 'ADLY','cylindree' => '50','modele'=> 'P 50 Panther','annee'=> '2007']);
        bike::create(['marque'=> 'ADLY','cylindree' => '50','modele'=> 'P 50 Panther','annee'=> '2008']);
        bike::create(['marque'=> 'ADLY','cylindree' => '50','modele'=> 'P 50 Panther','annee'=> '2009']);
    }
}
