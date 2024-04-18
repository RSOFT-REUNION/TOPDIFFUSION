<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MyProduct;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        MyProduct::create([
            'active' => 1,
            'state' => 1,
            'title' => 'Casque Jet LS2 OF562 Airflow',
            'slug' => 'casque-jet-ls2-of562-airflow',
            'type' => 1,
            'kit_element' => null,
            'cover' => 'casque-jet-ls2-of562-airflow.jpg',
            'category_id' => 3,
            'brand_id' => 1,
            'short_description' => 'Casque Jet LS2 OF562 Airflow',
            'long_description' => 'Casque Jet LS2 OF562 Airflow',
        ]);

        MyProduct::create([
            'active' => 1,
            'state' => 1,
            'title' => 'Casque Shark',
            'slug' => 'casque-shark',
            'type' => 1,
            'kit_element' => null,
            'cover' => 'casque-shark.jpg',
            'category_id' => 4,
            'brand_id' => 2,
            'short_description' => 'Casque Shark',
            'long_description' => 'Casque Shark',
        ]);

        MyProduct::create([
            'active' => 1,
            'state' => 1,
            'title' => 'Chaine AFAM a428mx g124',
            'slug' => 'chaine-afam-a428mx-g124',
            'type' => 1,
            'kit_element' => null,
            'cover' => 'chaine-afam-a428mx-g124.webp',
            'category_id' => 12,
            'brand_id' => 3,
            'short_description' => 'Chaine AFAM a428mx g124',
            'long_description' => 'Chaine AFAM a428mx g124',
        ]);

        MyProduct::create([
            'active' => 1,
            'state' => 1,
            'title' => 'Couronne',
            'slug' => 'couronne',
            'type' => 1,
            'kit_element' => null,
            'cover' => 'couronne.jpg',
            'category_id' => 12,
            'brand_id' => 4,
            'short_description' => 'Couronne',
            'long_description' => 'Couronne',
        ]);

        MyProduct::create([
            'active' => 1,
            'state' => 1,
            'title' => 'Disque Brembo',
            'slug' => 'disque-brembo',
            'type' => 1,
            'kit_element' => null,
            'cover' => 'disque-brembo-1.jpg',
            'category_id' => 12,
            'brand_id' => 5,
            'short_description' => 'Disque Brembo',
            'long_description' => 'Disque Brembo',
        ]);

        MyProduct::create([
            'active' => 1,
            'state' => 1,
            'title' => 'Disque de frein rouge',
            'slug' => 'disque-de-frein-rouge',
            'type' => 1,
            'kit_element' => null,
            'cover' => 'disque-de-frein-rouge.jpg',
            'category_id' => 12,
            'brand_id' => 6,
            'short_description' => 'Disque de frein rouge',
            'long_description' => 'Disque de frein rouge',
        ]);

        MyProduct::create([
            'active' => 1,
            'state' => 1,
            'title' => 'Element de kit chaine',
            'slug' => 'element-de-kit-chaine',
            'type' => 1,
            'kit_element' => null,
            'cover' => 'element-de-kit-chaine—chaine-.jpg',
            'category_id' => 12,
            'brand_id' => 1,
            'short_description' => 'Element de kit chaine',
            'long_description' => 'Element de kit chaine',
        ]);

        MyProduct::create([
            'active' => 1,
            'state' => 1,
            'title' => 'Pignon AFAM',
            'slug' => 'pignon-afam',
            'type' => 1,
            'kit_element' => null,
            'cover' => 'pignon-afam.jpg',
            'category_id' => 12,
            'brand_id' => 1,
            'short_description' => 'Pignon AFAM',
            'long_description' => 'Pignon AFAM',
        ]);

        MyProduct::create([
            'active' => 1,
            'state' => 1,
            'title' => 'Pneu sport',
            'slug' => 'pneu-sport',
            'type' => 1,
            'kit_element' => null,
            'cover' => 'pneu-sport.jpg',
            'category_id' => 8,
            'brand_id' => 1,
            'short_description' => 'Pneu sport',
            'long_description' => 'Pneu sport',
        ]);

        MyProduct::create([
            'active' => 1,
            'state' => 1,
            'title' => 'Pneus n°2',
            'slug' => 'pneus-n°2',
            'type' => 1,
            'kit_element' => null,
            'cover' => 'pneus-n°2.jpg',
            'category_id' => 9,
            'brand_id' => 1,
            'short_description' => 'Pneus n°2',
            'long_description' => 'Pneus n°2',
        ]);



    }
}
