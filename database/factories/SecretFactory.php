<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\secret>
 */
class SecretFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->randomElement([1,2,3,4]),
            'title' => fake()->sentence(2),
            'site' => fake()->url(),
            'username' => fake()->userName(),
            'password' => fake()->password(6,12),
            'notes' => fake()->paragraph()
        ];
    }
}
