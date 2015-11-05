<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_transactions', function (Blueprint $table) {

        # Increments method will make a Primary, Auto-Incrementing field.
        # Most tables start off this way
        $table->increments('id');

        # This generates two columns: `created_at` and `updated_at` to
        # keep track of changes to a row
        $table->timestamps();

        # The rest of the fields...
        $table->date('transaction_date');
        $table->integer('product_id')->unsigned();
        $table->integer('salesperson_id')->unsigned();
        $table->integer('quantity');
        $table->integer('discount');
        $table->text('comments');


        });

        Schema::table('sales_transactions', function($table) {
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('salesperson_id')->references('id')->on('salespeople');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sales_transactions');
    }
}
