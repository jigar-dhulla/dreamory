<?php

namespace Database\Factories;

use App\Models\EventPhoto;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventPhotoFactory extends Factory
{
    protected $model = EventPhoto::class;

    public function definition(): array
    {
        return [
            'event_id' => Event::factory(),
            'photo_path' => 'events/gallery/' . $this->faker->uuid . '.jpg',
        ];
    }
}
