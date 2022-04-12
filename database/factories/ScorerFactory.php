<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Scorer>
 */
class ScorerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $total = $this->faker->numberBetween(15, 30);
        $home = $this->faker->numberBetween(0, 14);
        $away = $total - $home;

        return [
            'league' => $this->faker->randomNumber(),
            'season' => $this->faker->randomNumber(),
            'club_id' => $this->faker->randomNumber(),
            'player_id' => $this->faker->randomNumber(),
            'total' => $total,
            'home' => $home,
            'away' => $away,
            'photo' => $this->faker->imageUrl,
            'first_name' => $this->faker->userName(),
            'last_name' => $this->faker->userName(),
        ];
    }
}
