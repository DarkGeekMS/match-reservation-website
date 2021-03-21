<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use Faker\Generator as Faker;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $i = 5;
        return [
            'id'         => $i++,
            'username'   => $this->faker->unique()->userName,
            'password'   => '$2y$10$EFyhgTaTJGLEtHg3ylrJ/eAIoEFZ/UZ4w3/dMF5CF4NteCsB/PcgS',
            'email'      => $this->faker->safeEmail,
            'first_name' => $this->faker->firstName,
            'last_name'  => $this->faker->lastName,
            'gender'     => rand(0, 1),
            'city'       => 'cairo',
            'birthdate'  => $this->faker->date,
            'role'       => rand(1, 2),

        ];
    }
}
