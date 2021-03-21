<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // first insert admin users
        // add 4 admins
        DB::table('users')->insert([
            'id'         => 1, 
            'username'   => 'Remonda',
            'password'   => '$2y$10$EFyhgTaTJGLEtHg3ylrJ/eAIoEFZ/UZ4w3/dMF5CF4NteCsB/PcgS',
            'email'      => 'mondatalaat@gmail.com',
            'first_name' => 'remonda',
            'last_name'  => 'talaat',
            'gender'     => 1,
            'city'       => 'cairo',
            'birthdate'  => '1998-06-15',
            'role'       => 3,
            'verified'   => true
        ]);

        DB::table('users')->insert([
            'id'         => 2, 
            'username'   => 'Shawky',
            'password'   => '$2y$10$EFyhgTaTJGLEtHg3ylrJ/eAIoEFZ/UZ4w3/dMF5CF4NteCsB/PcgS',
            'email'      => 'mohamedshawky911@gmail.com',
            'first_name' => 'mohamed',
            'last_name'  => 'shawky',
            'gender'     => 0,
            'city'       => 'cairo',
            'birthdate'  => '1998-02-17',
            'role'       => 3,
            'verified'   => true
        ]);

        DB::table('users')->insert([
            'id'         => 3, 
            'username'   => 'Ramzy',
            'password'   => '$2y$10$EFyhgTaTJGLEtHg3ylrJ/eAIoEFZ/UZ4w3/dMF5CF4NteCsB/PcgS',
            'email'      => 'mohamedramzy@gmail.com',
            'first_name' => 'mohamed',
            'last_name'  => 'ramzy',
            'gender'     => 0,
            'city'       => 'cairo',
            'birthdate'  => '1998-06-20',
            'role'       => 3,
            'verified'   => true
        ]);

        DB::table('users')->insert([
            'id'         => 4, 
            'username'   => 'Double',
            'password'   => '$2y$10$EFyhgTaTJGLEtHg3ylrJ/eAIoEFZ/UZ4w3/dMF5CF4NteCsB/PcgS',
            'email'      => 'mohamedahmed@gmail.com',
            'first_name' => 'mohamed',
            'last_name'  => 'ahmed',
            'gender'     => 0,
            'city'       => 'cairo',
            'birthdate'  => '1998-08-21',
            'role'       => 3,
            'verified'   => true
        ]);

    }
}
