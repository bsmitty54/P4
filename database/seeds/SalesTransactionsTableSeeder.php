<?php

use Illuminate\Database\Seeder;

class SalesTransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sales_transactions')->insert([
            'id' => 1,
            'transaction_date' => '2015-02-15',
            'product_id' => 1,
            'salesperson_id' => 1,
            'quantity' => 1000,
            'discount' => 5,
            'comments' => 'Local TV store reordered',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);
        DB::table('sales_transactions')->insert([
            'id' => 2,
            'transaction_date' => '2015-03-15',
            'product_id' => 1,
            'salesperson_id' => 2,
            'quantity' => 5000,
            'discount' => 3,
            'comments' => 'Monthly Walmart Order',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);
        DB::table('sales_transactions')->insert([
            'id' => 3,
            'transaction_date' => '2015-04-01',
            'product_id' => 2,
            'salesperson_id' => 2,
            'quantity' => 6000,
            'discount' => 4,
            'comments' => 'Best Buy Monthly Order',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);
        DB::table('sales_transactions')->insert([
            'id' => 4,
            'transaction_date' => '2015-04-10',
            'product_id' => 3,
            'salesperson_id' => 3,
            'quantity' => 1500,
            'discount' => 7,
            'comments' => 'Increased discount for Best Buy based on monthy quantities',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);
    }
}
