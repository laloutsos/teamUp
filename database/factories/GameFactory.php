<?php

namespace Database\Factories;

use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends Factory<Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->paragraphs(2, true),
            'bet' => $this->faker->numberBetween(100, 1000),
            'tags' => implode(', ', $this->faker->words(3)),
            'game_type' => $this->faker->randomElement(['Football', 'Basketball', 'Volleyball']),
            'competitive' => $this->faker->boolean(),
            'more_information' => $this->faker->sentences(2, true),
            'city' => $this->faker->city(),
            'exact_location' => $this->faker->city(),
            'contact_email' => $this->faker->safeEmail(),
            'contact_phone' => $this->faker->phoneNumber(),

            'team_name' => $this->faker->company(),
            'team_description' => $this->faker->paragraph(),
            'team_logo' => null,

        ];
    }
}
