<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->integer('gender');                         # 0 : male , 1 :female
            $table->string('address')->nullable();
            $table->string('city');
            $table->integer('role')->default(1);
            $table->date('birthdate');
            $table->boolean('verified')->default(false);
            $table->primary('id');
            $table->SoftDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
