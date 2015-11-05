<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalespeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salespeople', function (Blueprint $table) {

        # Increments method will make a Primary, Auto-Incrementing field.
        # Most tables start off this way
        $table->increments('id');

        # This generates two columns: `created_at` and `updated_at` to
        # keep track of changes to a row
        $table->timestamps();

        # The rest of the fields...
        $table->string('employee_id',15);
        $table->string('last_name',30);
        $table->string('first_name',20);
        $table->string('street1',30);
        $table->string('street2',30);
        $table->string('city',20);
        $table->string('state',2);
        $table->string('zip_code',9);
        $table->string('email',30);
        $table->date('hire_date');
        $table->date('termination_date');

        

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('salespeople');
    }
}
