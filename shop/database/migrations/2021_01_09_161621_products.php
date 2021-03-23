<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->float('price');
            $table->date('arrived_time');
            $table->date('left_time');
            $table->string('keywords');
            $table->integer('mark')->useCurrent(5);
            $table->integer('reviews')->useCurrent(0);
            $table->integer('idCategory');
            $table->string('mainimg');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
