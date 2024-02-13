<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Title>
 */
class TitleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sort_title' => fake()->unique()->words(rand(3,7), true),
            'display_title' => fake()->randomElement(['',fake()->unique()->words(rand(3,7), true)]),
            'abbreviation' => fake()->unique()->countryISOAlpha3(),
        ];
    }
}
