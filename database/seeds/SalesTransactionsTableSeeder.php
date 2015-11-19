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
        // get count of products and Salespeople
        $pcount = DB::table('products')->count();
        $scount = DB::table('salespeople')->count();
        $faker = \Faker\Factory::create();
        for ($i=1; $i<=500; $i++) {
            $tdate = $faker->dateTimeThisCentury();
            $pid = $faker->numberBetween($min = 1, $max = $pcount);
            $sid = $faker->numberBetween($min = 1, $max = $scount);
            $quantity = ($faker->numberBetween($min = 1, $max = 10)) * 500;
            // what is the max discount for the selected product
            $product = DB::table('products')->where('id','=',$pid)->first();
            $maxDiscount = $product->max_discount;
            $discount = $faker->numberBetween($min = 0, $max = $maxDiscount);
            $comments = $faker->text($maxNbChars = 200);
            DB::table('sales_transactions')->insert([
                'id' => $i,
                'transaction_date' => $tdate,
                'product_id' => $pid,
                'salesperson_id' => $sid,
                'quantity' => $quantity,
                'discount' => $discount,
                'comments' => $comments,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
        }

    }
}
