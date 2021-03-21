<?php

namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class ReservationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reservation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $matches = DB::table('match')->pluck('id')->all();
        $users   = DB::table('users')->pluck('id')->all();
        static $i = 1;
        return [
            'match_id'      => $match,
            'fan_id'        => $users[array_rand($users)],
            'ticket_number' => $i++,

        ];
    }
}
