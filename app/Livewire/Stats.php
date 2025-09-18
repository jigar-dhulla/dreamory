<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;

class Stats extends Component
{
    public function render()
    {
        $totalEvents = Event::count();
        $averageRating = Event::whereNotNull('overall_rating')->avg('overall_rating');
        $categoryStats = Event::selectRaw('category, COUNT(*) as count, AVG(overall_rating) as avg_rating')
            ->whereNotNull('category')
            ->groupBy('category')
            ->orderBy('count', 'desc')
            ->get();

        return view('livewire.stats', [
            'totalEvents' => $totalEvents,
            'averageRating' => $averageRating ? round($averageRating, 1) : 0,
            'categoryStats' => $categoryStats
        ]);
    }
}
