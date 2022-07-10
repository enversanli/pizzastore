<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($x = 0; $x < 10; $x++) {
            $name = $faker->name;
            DB::table('products')->insert([
                'key' => Str::slug($name),
                'name' => $name,
                'price' => $faker->numberBetween(5, 20),
                'image' => 'https://img.freepik.com/fotos-kostenlos/draufsicht-der-peperoni-pizza-mit-pilzwuersten-paprika-olive-und-mais-auf-schwarzem-holz_141793-2158.jpg?w=2000'
            ]);
        }


    }
}
