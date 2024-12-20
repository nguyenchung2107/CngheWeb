<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Thêm dòng này
use Faker\Factory as Faker;

class ComputersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 50; $i++) {
            DB::table('computers')->insert([
                'computer_name' => $faker->word . '-' . $faker->randomNumber(3),
                'model' => $faker->word . ' ' . $faker->randomNumber(3),
                'operating_system' => $faker->randomElement(['Windows 10 Pro', 'Windows 11', 'Linux Ubuntu']),
                'processor' => 'Intel Core i' . $faker->randomElement([3, 5, 7, 9]) . '-' . $faker->randomNumber(4),
                'memory' => $faker->numberBetween(4, 64),
                'available' => $faker->boolean,
            ]);
        }
    }
}
