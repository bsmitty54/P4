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
        DB::table('products')->insert([
            'id' => 1,
            'product_id' => '12345678',
            'product_name' => 'Apple TV',
            'category_id' => '1',
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
            'category_id' => '1',
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
            'category_id' => '1',
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
            'category_id' => '1',
            'price' => 59.00,
            'max_discount' => 5,
            'active' => 1,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);
        DB::table('products')->insert([
            'id' => 5,
            'product_id' => '98129812',
            'product_name' => 'Cheap Stick',
            'category_id' => '1',
            'price' => 29.00,
            'max_discount' => 5,
            'active' => 0,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);
        DB::table('products')->insert([
            'id' => 6,
            'product_id' => '54547676999',
            'product_name' => 'New Stick',
            'category_id' => '1',
            'price' => 55.00,
            'max_discount' => 12,
            'active' => 1,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);


    }
}
