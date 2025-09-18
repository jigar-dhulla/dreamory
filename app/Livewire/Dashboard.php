<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $totalEvents = Event::count();
        $averageRating = Event::whereNotNull('overall_rating')->avg('overall_rating');
        $recentEvents = Event::latest()->limit(5)->get();

        // For MVP, we'll use static values for Dreams/Bucket List stats
        $dreamsAchieved = 12; // This will be dynamic later
        $bucketListItems = 23; // This will be dynamic later

        return view('livewire.dashboard', [
            'totalEvents' => $totalEvents,
            'dreamsAchieved' => $dreamsAchieved,
            'bucketListItems' => $bucketListItems,
            'averageRating' => $averageRating ? round($averageRating, 1) : 0,
            'recentEvents' => $recentEvents,
        ]);
    }
}
