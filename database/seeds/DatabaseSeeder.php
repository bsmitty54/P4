<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(ProductsTableSeeder::class);
        $this->call(SalespeopleTableSeeder::class);
        $this->call(SalesTransactionsTableSeeder::class);

        Model::reguard();
    }
}