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
        DB::table('salespeople')->insert([
            'id' => 1,
            'employee_id' => '123-12-1212',
            'last_name' => 'Jones',
            'first_name' => 'Paul',
            'street1' => '100 Main St',
            'city' => 'Reading',
            'state' => 'MA',
            'zip_code' => '01210',
            'email' => 'pjones@tvsticks.com',
            'hire_date' => '2012-12-01',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);
        DB::table('salespeople')->insert([
            'id' => 2,
            'employee_id' => '555-44-3333',
            'last_name' => 'Watson',
            'first_name' => 'John',
            'street1' => '100 Quannapowitt Pkwy',
            'city' => 'Wakefield',
            'state' => 'MA',
            'zip_code' => '01266',
            'email' => 'jwatson@tvsticks.com',
            'hire_date' => '2014-1-01',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);
        DB::table('salespeople')->insert([
            'id' => 3,
            'employee_id' => '999-99-9876',
            'last_name' => 'Sullivan',
            'first_name' => 'Tom',
            'street1' => '161 Cornish St',
            'city' => 'Weymouth',
            'state' => 'MA',
            'zip_code' => '01289',
            'email' => 'tsullivan@tvsticks.com',
            'hire_date' => '2015-02-10',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);
        DB::table('salespeople')->insert([
            'id' => 4,
            'employee_id' => '000-00-0099',
            'last_name' => 'Brady',
            'first_name' => 'Tom',
            'street1' => '1 Patriot Way',
            'street2' => 'Suite 100',
            'city' => 'Foxboro',
            'state' => 'MA',
            'zip_code' => '01244',
            'email' => 'tbrady@tvsticks.com',
            'hire_date' => '2015-02-10',
            'termination_date' => '2015-09-30',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);
        DB::table('salespeople')->insert([
            'id' => 5,
            'employee_id' => '876-54-9876',
            'last_name' => 'Trump',
            'first_name' => 'Donald',
            'street1' => '1 Rockefeller Ave',
            'street2' => 'Apt 1A',
            'city' => 'New York',
            'state' => 'NY',
            'zip_code' => '01100',
            'email' => 'dtrump@tvsticks.com',
            'hire_date' => '2015-01-20',
            'termination_date' => '2015-10-30',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);
    }
}
