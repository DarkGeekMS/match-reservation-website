<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class MatchFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Match::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $staduims = DB::table('stadium')->pluck('id')->all();
        $homeTeam = $this->faker->homeTeam;
        do {
            $awayTeam = $this->faker->unique()->awayTeam;
        } while ($awayTeam ==  $homeTeam);

        static $i = 1;
        return [
            'id'             => $i++,
            'home_team'      => $homeTeam,
            'away_team'      => $awayTeam,
            'match_venu'     => $staduims[array_rand($staduims)],
            'main_referee'   => $this->faker->mainRefree,
            'first_lineman'  => $this->faker->firstLineman,
            'second_lineman' => $this->faker->secondLineman,
        ];
    }
}
