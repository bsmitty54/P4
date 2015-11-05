<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sales_transactions')->delete();
        DB::table('salespeople')->delete();
        DB::table('products')->delete();
        DB::table('products')->insert([
            'id' => 1,
            'product_id' => '12345678',
            'product_name' => 'Apple TV',
            'price' => 99.00,
            'max_discount' => 10,
            'active' => 1,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);
        DB::table('products')->insert([
            'id' => 2,
            'product_id' => '12121212',
            'product_name' => 'Roku Stick',
            'price' => 49.00,
            'max_discount' => 5,
            'active' => 1,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);
        DB::table('products')->insert([
            'id' => 3,
            'product_id' => '234234234',
            'product_name' => 'Google Chromecast',
            'price' => 69.00,
            'max_discount' => 7,
            'active' => 1,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);
        DB::table('products')->insert([
            'id' => 4,
            'product_id' => '55554444',
            'product_name' => 'Amazon Fire Stick',
            'price' => 59.00,
            'max_discount' => 5,
            'active' => 1,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);
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
