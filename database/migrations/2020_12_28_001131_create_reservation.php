<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation', function (Blueprint $table) {
            $table->integer('ticket_number');
            $table->integer('match_id')->unsigned();
            $table->integer('fan_id')->unsigned();
            $table->integer('seat_number');
            $table->integer('row_number');
            $table->primary('ticket_number');
            $table->foreign('match_id')->references('id')->on('matches')->onDelete('cascade');
            $table->foreign('fan_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservation');
    }
}
