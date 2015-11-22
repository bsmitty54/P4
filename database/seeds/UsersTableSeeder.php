<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
            'id' => 1,
            'last_name' => 'Harvard',
            'first_name' => 'Jill',
            'email' => 'jill@harvard.edu',
            'password' => \Hash::make('helloworld'),
            'role' => 'End User',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);
        DB::table('users')->insert([
            'id' => 2,
            'last_name' => 'Harvard',
            'first_name' => 'Jamal',
            'email' => 'jamal@harvard.edu',
            'password' => \Hash::make('helloworld'),
            'role' => 'Administrator',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);
        $faker = \Faker\Factory::create();
        for ($i = 3; $i<=50; $i++) {
            $lastName = $faker->lastName();
            $firstName = $faker->firstName();
            $email = $faker->email();
            $password = 'helloworld';
            $role = 'End User';
            if ($i % 4 == 0) {
                $role = 'Administrator';
            }
            DB::table('users')->insert([
                'id' => $i,
                'last_name' => $lastName,
                'first_name' => $firstName,
                'email' => $email,
                'password' => \Hash::make('helloworld'),
                'role' => $role,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
        }
    }
}
