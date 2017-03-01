<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Customers;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        Customers::truncate();

        foreach (range(1,100) as $i) {
            Customers::create([
                'name' => $faker->firstname,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber
            ]);
        }
    }
}
