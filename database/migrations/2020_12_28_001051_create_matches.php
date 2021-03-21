<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match', function (Blueprint $table) {
            $table->integer('id')->unsigned()->unique();
            $table->string('home_team');
            $table->string('away_team');
            $table->integer('match_venu')->unsigned();
            $table->string('main_referee');
            $table->string('first_lineman');
            $table->string('second_lineman');
            $table->date('date');
            $table->time('time');
            $table->primary('id');
            $table->foreign('match_venu')->references('id')->on('stadium')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('match');
    }
}
