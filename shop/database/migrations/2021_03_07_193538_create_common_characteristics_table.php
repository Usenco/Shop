<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommonCharacteristicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('common_characteristics', function (Blueprint $table) {
            $table->id();

            $table->string("color");
            $table->string("print")->nullable();// клеточка линия узоры
            $table->string("type")->nullable();//вечернии на свидание утренние рабочие
            $table->integer("size");
            $table->integer("model");//фасон
            $table->string("season")->nullable();
            $table->string("type_of_textile");// тип ткани

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
        Schema::dropIfExists('common_characteristics');
    }
}
