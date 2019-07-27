<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimetablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timetables', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->timestamps();
            $table->dateTime('start_day');
            $table->dateTime('start_middle_rest');
            $table->dateTime('end_middle_rest');
            $table->dateTime('end_day');
            $table->integer('time_length');
            $table->integer('gap_length');
            $table->bigInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return voidc
     */
    public function down()
    {
        Schema::dropIfExists('timetables');
    }
}
