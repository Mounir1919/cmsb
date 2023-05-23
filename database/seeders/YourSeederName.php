<?php
namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class YourSeederName extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            $ransalary=mt_rand(1000,90000);
            DB::table('posts')->insert([
                'name' => $faker->name,
                'salary' => $ransalary,
                'age' => $faker->numberBetween(0,90),
                'image'=>$faker->imageUrl()
            ]);
        }
    }
    
}

