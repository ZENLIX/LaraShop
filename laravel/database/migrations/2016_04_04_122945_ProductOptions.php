<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductOptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

         Schema::create('options', function(Blueprint $table)
    {
        $table->increments('id');
        $table->string('name');
        $table->string('price')->nullable();
        $table->timestamps();

    });


         Schema::create('product_options', function(Blueprint $table)
    {
        $table->increments('id');
        $table->string('product_id');
        $table->string('option_id')->nullable();
        $table->timestamps();

    });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
