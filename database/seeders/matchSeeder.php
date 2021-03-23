<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class matchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('matches')->insert([
            'id'             => 1, 
            'home_team'      => 'real madrid',
            'away_team'      => 'barcelona',
            'match_venu'     => 1,
            'main_referee'   => 'Mike Dean',
            'first_linesman' => 'Paul Rees',
            'second_linesman'=> 'Paul Evans',
            'date'           => '2021-06-15',
            'time'           => '20:00:00'
        ]);
        
        DB::table('matches')->insert([
            'id'             => 2, 
            'home_team'      => 'bayern',
            'away_team'      => 'barcelona',
            'match_venu'     => 4,
            'main_referee'   => 'Anthony Taylor',
            'first_linesman' => 'John Flynn',
            'second_linesman'=> 'Nicholas Cooper',
            'date'           => '2021-08-21',
            'time'           => '20:00:00'
        ]);

        DB::table('matches')->insert([
            'id'             => 3, 
            'home_team'      => 'liverpool',
            'away_team'      => 'barcelona',
            'match_venu'     => 3,
            'main_referee'   => 'Lee Mason',
            'first_linesman' => 'Justin Amey',
            'second_linesman'=> 'Robert Atkin',
            'date'           => '2021-03-24',
            'time'           => '20:00:00'
        ]);

        DB::table('matches')->insert([
            'id'             => 4, 
            'home_team'      => 'liverpool',
            'away_team'      => 'chelsea',
            'match_venu'     => 1,
            'main_referee'   => 'Andre Marriner',
            'first_linesman' => 'Matthew Bristow',
            'second_linesman'=> 'Paul Graham',
            'date'           => '2021-11-10',
            'time'           => '20:00:00'
        ]);
    }
}
