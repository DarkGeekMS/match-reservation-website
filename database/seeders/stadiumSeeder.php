<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stadium;
use Illuminate\Support\Facades\DB;


class stadiumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stadium')->insert([
            'id'           => 1, 
            'rows_number'  => 50,
            'seats_number' => 100
        ]);

        DB::table('stadium')->insert([
            'id'           => 2, 
            'rows_number'  => 70,
            'seats_number' => 90
        ]);

        DB::table('stadium')->insert([
            'id'           => 3, 
            'rows_number'  => 30,
            'seats_number' => 150
        ]);

        DB::table('stadium')->insert([
            'id'           => 4, 
            'rows_number'  => 50,
            'seats_number' => 120
        ]);

        DB::table('stadium')->insert([
            'id'           => 5, 
            'rows_number'  => 60,
            'seats_number' => 100
        ]);
    }
}
