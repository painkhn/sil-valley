<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Computer>
 */
class ComputerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word . ' PC',
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 500, 5000),
            'image' => null,
        ];
    }
}
