<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->integer('ticket_number')->unique();              // must be unique to every reservation
            $table->integer('match_id')->unsigned();
            $table->integer('fan_id')->unsigned()->nullable();
            $table->integer('seat_number');
            $table->integer('row_number');
            $table->primary(['row_number' , 'seat_number', 'match_id' ]);
            //$table->foreign('match_id')->references('id')->on('matches')->onDelete('cascade');
            $table->foreign('fan_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
