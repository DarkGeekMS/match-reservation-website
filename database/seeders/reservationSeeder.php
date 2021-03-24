<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class reservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reservations')->insert([
            'ticket_number' => 1, 
            'match_id'      => 1,
            'fan_id'        => 1,
            'row_number'    => 1,
            'seat_number'   => 5
        ]);

        DB::table('reservations')->insert([
            'ticket_number' => 2, 
            'match_id'      => 1,
            'fan_id'        => 2,
            'row_number'    => 6,
            'seat_number'   => 1
        ]);

        DB::table('reservations')->insert([
            'ticket_number' => 3, 
            'match_id'      => 1,
            'fan_id'        => 3,
            'row_number'    => 2,
            'seat_number'   => 40
        ]);

        DB::table('reservations')->insert([
            'ticket_number' => 4, 
            'match_id'      => 2,
            'fan_id'        => 1,
            'row_number'    => 2,
            'seat_number'   => 5
        ]);

        DB::table('reservations')->insert([
            'ticket_number' => 5, 
            'match_id'      => 3,
            'fan_id'        => 4,
            'row_number'    => 3,
            'seat_number'   => 10
        ]);

        DB::table('reservations')->insert([
            'ticket_number' => 6, 
            'match_id'      => 2,
            'fan_id'        => 2,
            'row_number'    => 3,
            'seat_number'   => 12
        ]);

        DB::table('reservations')->insert([
            'ticket_number' => 7, 
            'match_id'      => 3,
            'fan_id'        => 3,
            'row_number'    => 2,
            'seat_number'   => 50
        ]);

        DB::table('reservations')->insert([
            'ticket_number' => 8, 
            'match_id'      => 3,
            'fan_id'        => 1,
            'row_number'    => 6,
            'seat_number'   => 19
        ]);

        DB::table('reservations')->insert([
            'ticket_number' => 9, 
            'match_id'      => 4,
            'fan_id'        => 1,
            'row_number'    => 4,
            'seat_number'   => 80
        ]);
    }
}
