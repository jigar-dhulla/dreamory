<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'name' => $this->faker->sentence(3),
            'category' => $this->faker->randomElement($categories),
            'location' => $this->faker->city() . ', ' . $this->faker->country(),
            'date_attended' => $this->faker->date(),
            'overall_rating' => $this->faker->numberBetween(1, 5),
            'photo_path' => 'events/' . Str::random(10) . '.jpg',
            'notes' => $this->faker->paragraph,
        ];
    }
}
