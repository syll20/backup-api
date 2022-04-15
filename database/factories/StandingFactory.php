<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Standing>
 */
class StandingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'league' => $this->faker->randomNumber(),
            'season' => $this->faker->randomNumber(),
            'club_id' => $this->faker->randomNumber(),
            'name' => $this->faker->userName(),
            'location' => $this->faker->randomElement([0 => 'home', 1 => 'away', 2 => 'total']),
            'rank' => $this->faker->numberBetween(1,20),
            'points' => $this->faker->numberBetween(0, 100),
            'played' => $this->faker->numberBetween(1, 38),
            'win' => $this->faker->numberBetween(1, 38),
            'draw' => $this->faker->numberBetween(1, 38),
            'lose' => $this->faker->numberBetween(1, 38),
            'goals_for' => $this->faker->numberBetween(1, 100),
            'goals_against' => $this->faker->numberBetween(1, 100),
            'goals_diff' => $this->faker->numberBetween(1, 100),
            'last5' => $this->faker->randomElements(['W', 'D', 'L'], 5, true);
        ];  
    }
}
