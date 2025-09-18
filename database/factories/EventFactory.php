<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = ['Food & Dining', 'Music', 'Travel', 'Activities', 'Culture', 'Other'];

        return [
            'name' => fake()->sentence(3),
            'category' => fake()->randomElement($categories),
            'location' => fake()->city() . ', ' . fake()->country(),
            'date_attended' => fake()->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
            'overall_rating' => fake()->numberBetween(1, 5),
            'photo_path' => null, // Will be handled by file uploads later
            'notes' => fake()->optional(0.7)->paragraph(2),
        ];
    }
}
