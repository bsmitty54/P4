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
        DB::table('products')->insert([
            'id' => 7,
            'product_id' => '5454878799',
            'product_name' => 'MultiStreamer',
            'category_id' => '1',
            'price' => 79.00,
            'max_discount' => 8,
            'active' => 1,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);
        DB::table('products')->insert([
            'id' => 8,
            'product_id' => '888666444222',
            'product_name' => 'Winter Coat',
            'category_id' => '2',
            'price' => 189.00,
            'max_discount' => 10,
            'active' => 1,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);
        DB::table('products')->insert([
            'id' => 9,
            'product_id' => '98127634',
            'product_name' => 'Sping Jacket',
            'category_id' => '2',
            'price' => 119.00,
            'max_discount' => 12,
            'active' => 1,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);
        DB::table('products')->insert([
            'id' => 10,
            'product_id' => 'MP987654',
            'product_name' => 'Mens Dress Pants',
            'category_id' => '2',
            'price' => 35.00,
            'max_discount' => 5,
            'active' => 1,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);
        DB::table('products')->insert([
            'id' => 11,
            'product_id' => 'MS21212121',
            'product_name' => 'Mens Casual Shirt',
            'category_id' => '2',
            'price' => 29.00,
            'max_discount' => 3,
            'active' => 1,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);
        DB::table('products')->insert([
            'id' => 12,
            'product_id' => 'HW1234567',
            'product_name' => 'Ballpeen Hammer',
            'category_id' => '3',
            'price' => 19.00,
            'max_discount' => 3,
            'active' => 1,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);
        DB::table('products')->insert([
            'id' => 13,
            'product_id' => 'HW9876543',
            'product_name' => 'Phillips Head Screwdriver',
            'category_id' => '3',
            'price' => 14.99,
            'max_discount' => 0,
            'active' => 1,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);
        DB::table('products')->insert([
            'id' => 14,
            'product_id' => 'HW9999999',
            'product_name' => 'Hacksaw',
            'category_id' => '3',
            'price' => 24.99,
            'max_discount' => 1,
            'active' => 1,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);
        DB::table('products')->insert([
            'id' => 15,
            'product_id' => 'HW12123434',
            'product_name' => 'Bandsaw',
            'category_id' => '3',
            'price' => 89.99,
            'max_discount' => 3,
            'active' => 1,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

    }
}
