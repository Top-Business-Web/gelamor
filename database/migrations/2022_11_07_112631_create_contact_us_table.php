<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactUsTable extends Migration
{

    public function up()
    {
        Schema::create('contact_us', function (Blueprint $table) {


            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('subject');
            $table->string('message');


            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();

        });
    }


    public function down()
    {
        Schema::dropIfExists('contact_us');
    }
}
