<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\EventPhoto;

class EventPhotoSeeder extends Seeder
{
    public function run(): void
    {
        // For each event, add 2-4 photos
        Event::all()->each(function ($event) {
            EventPhoto::factory()->count(rand(2, 4))->create([
                'event_id' => $event->id,
            ]);
        });
    }
}
