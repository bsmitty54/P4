<?php

use Illuminate\Database\Seeder;

class SalespeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i=1; $i<=1000; $i++) {
            // create the data
            $empID = $faker->creditCardNumber();
            $lastName = $faker->lastName();
            $firstName = $faker->firstName();
            $street1 = $faker->streetName();
            $city = $faker->city();
            $state = $faker->stateAbbr();
            $zip = $faker->postcode();
            $email = $faker->email();
            $hireDate = $faker->dateTimeThisCentury();
            DB::table('salespeople')->insert([
                'id' => $i,
                'employee_id' => $empID,
                'last_name' => $lastName,
                'first_name' => $firstName,
                'street1' => $street1,
                'city' => $city,
                'state' => $state,
                'zip_code' => $zip,
                'email' => $email,
                'hire_date' => $hireDate,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
        }

    }
}
