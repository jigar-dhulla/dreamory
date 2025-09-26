<?php

namespace App\Livewire;

use App\Models\BucketListItem;
use App\Models\Event;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $totalEvents = Event::count();
        $averageRating = Event::whereNotNull('overall_rating')->avg('overall_rating');
        $recentEvents = Event::latest()->limit(5)->get();

        // Real bucket list statistics
        $totalDreams = BucketListItem::count();
        $dreamsAchieved = BucketListItem::completed()->count();
        $pendingDreams = BucketListItem::pending()->count();
        $recentCompletedDreams = BucketListItem::completed()->latest('completed_at')->limit(3)->get();

        return view('livewire.dashboard', [
            'totalEvents' => $totalEvents,
            'dreamsAchieved' => $dreamsAchieved,
            'totalDreams' => $totalDreams,
            'pendingDreams' => $pendingDreams,
            'averageRating' => $averageRating ? round($averageRating, 1) : 0,
            'recentEvents' => $recentEvents,
            'recentCompletedDreams' => $recentCompletedDreams,
        ]);
    }
}
