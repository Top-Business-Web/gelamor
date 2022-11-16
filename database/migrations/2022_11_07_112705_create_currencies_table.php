<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{

    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {


            $table->bigIncrements('id');
            $table->string('name_ar');
            $table->string('name_en');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('currencies');
    }
}
