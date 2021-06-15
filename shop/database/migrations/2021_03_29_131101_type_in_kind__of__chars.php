<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TypeInKindOfChars extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kind__of__chars', function (Blueprint $table) {
            $table->string("type_feald");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kind__of__chars', function (Blueprint $table) {
            $table->dropIfExists("type_feald");
        });
    }
}
