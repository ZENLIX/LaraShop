<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InstallStruct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('visitor_registry', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('ip', 32);
            $table->string('country', 4)->nullable();
            $table->integer('clicks')->unsigned()->default(0);
            $table->timestamps();
        });

                Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at');
        });
Schema::create('categories', function(Blueprint $table)
    {
        $table->increments('id');
        $table->string('name');
        $table->string('description');
        $table->string('cover')->nullable();
        $table->string('icon')->nullable();
        $table->string('urlhash'); // add index
        $table->integer('parent_id');
        $table->integer('sort_id');
        $table->timestamps();
    });

         Schema::create('products', function(Blueprint $table)
    {
        $table->increments('id');
        $table->string('name');

        $table->string('title');
        $table->string('keywords');
        $table->longText('description');
        $table->longText('description_full')->nullable();
        $table->string('values')->nullable();

        $table->string('cover')->nullable();
        $table->string('sku')->nullable();
        $table->string('price')->nullable();
        $table->string('price_old')->nullable();
        $table->string('label')->nullable();
        $table->enum('isset', ['true', 'false'])->default('true');
        $table->enum('visible', ['true', 'false'])->default('true');
        $table->string('urlhash'); // add index
        //$table->integer('parent_id');
        $table->integer('sort_id');
        $table->integer('categories_id');


        $table->timestamps();
    });

                  Schema::create('additional', function(Blueprint $table)
    {
        $table->increments('id');
        $table->string('name');
        $table->string('description');
        $table->string('price')->nullable();
        $table->timestamps();
    });

         Schema::create('recommendsProducts', function(Blueprint $table)
    {
        $table->increments('id');
        $table->integer('product_id');
        $table->integer('product_id_recommend');
$table->timestamps();

    });

    Schema::create('comments', function(Blueprint $table)
    {
        $table->increments('id');
        $table->integer('product_id');
        $table->string('name');
        $table->string('email');
        $table->longText('msg');
        $table->enum('approve', ['true', 'false'])->default('false');
        $table->timestamps();
    });

        Schema::create('clients', function(Blueprint $table)
    {
        $table->increments('id');
        $table->string('name');
        $table->string('email');
        $table->string('tel');
        $table->timestamps();
        //$table->string('last_adr');
    });

        Schema::create('orders', function(Blueprint $table)
    {
        $table->increments('id');
        $table->string('client_id');
        $table->string('delivery_city');
        $table->string('delivery_adr')->nullable();
        $table->string('delivery_np')->nullable();
        $table->enum('delivery_type', ['adr', 'np'])->default('np');
        $table->enum('pay_type', ['nal', 'privat24', 'privat_terminal', 'liqpay'])->default('privat24');
        $table->string('code'); // add index
        $table->string('ttn')->nullable();

        $table->longText('comment')->nullable();
        $table->enum('status', ['new', 'paid', 'sent'])->default('new');

        $table->timestamps();
    });
    

            Schema::create('order_items', function(Blueprint $table)
    {
        $table->increments('id');
        $table->string('order_id');
        $table->string('product_id');
        $table->integer('qty');
        $table->timestamps();
    });

        Schema::create('order_files', function(Blueprint $table)
    {
        $table->increments('id');
        $table->string('order_id');
        $table->string('name')->nullable();
        $table->string('hash')->nullable();
        $table->string('mime')->nullable();
        $table->string('extension')->nullable();
        $table->enum('status', ['tmp', 'success'])->default('tmp');
        $table->enum('image', ['true', 'false'])->default('false');
        $table->timestamps();
    });



        Schema::create('order_add', function(Blueprint $table)
    {
        $table->increments('id');
        $table->string('order_id');
        $table->string('additional_id');
        $table->timestamps();
    });


         Schema::create('NPCity', function(Blueprint $table)
    {
        $table->string('name');
        $table->string('ref');
    });

        Schema::create('NPUnit', function(Blueprint $table)
    {
        $table->string('name');
        $table->string('ref');
    });

        Schema::create('info', function(Blueprint $table)
    {
        $table->increments('id');
        $table->longText('text');
        $table->timestamps();
    });

        Schema::create('gallery', function(Blueprint $table)
    {
        $table->increments('id');
        $table->string('filename');
        $table->integer('sort_id');
        $table->timestamps();
    });

        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('queue');
            $table->longText('payload');
            $table->tinyInteger('attempts')->unsigned();
            $table->tinyInteger('reserved')->unsigned();
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
            $table->index(['queue', 'reserved', 'reserved_at']);
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
