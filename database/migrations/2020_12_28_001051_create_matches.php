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
        Schema::create('matches', function (Blueprint $table) {
            $table->integer('id')->unsigned()->unique();
            $table->string('home_team');
            $table->string('away_team');
            $table->integer('stadium_id')->unsigned();
            $table->string('main_referee');
            $table->string('first_lineman');
            $table->string('second_lineman');
            $table->primary('id');
            $table->foreign('stadium_id')->references('id')->on('stadium');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
}
