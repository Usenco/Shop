<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJacketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jackets', function (Blueprint $table) {
            $table->id();
            $table->integer("length_of_sleeve");//длина рукава
            $table->string("kind");//френч фрак блейзер
            $table->integer("count_of_buttons")->nullable();//количество пуговиц
            $table->string("lining")->nullable();//подкладка
            $table->string("number_of_feeds")->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jackets');
    }
}
