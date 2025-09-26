<?php

namespace App\Livewire;

use App\Models\BucketListItem;
use App\Models\Event;
use Livewire\Component;

class Stats extends Component
{
    public function render()
    {
        // Event Statistics
        $totalEvents = Event::count();
        $averageRating = Event::whereNotNull('overall_rating')->avg('overall_rating');
        $categoryStats = Event::selectRaw('category, COUNT(*) as count, AVG(overall_rating) as avg_rating')
            ->whereNotNull('category')
            ->groupBy('category')
            ->orderBy('count', 'desc')
            ->get();

        // Bucket List Statistics
        $totalDreams = BucketListItem::count();
        $completedDreams = BucketListItem::completed()->count();
        $pendingDreams = BucketListItem::pending()->count();
        $highPriorityDreams = BucketListItem::highPriority()->count();
        $linkedDreams = BucketListItem::whereNotNull('linked_event_id')->count();

        $dreamCategoryStats = BucketListItem::selectRaw('category, COUNT(*) as count, SUM(CASE WHEN is_completed = 1 THEN 1 ELSE 0 END) as completed_count')
            ->whereNotNull('category')
            ->groupBy('category')
            ->orderBy('count', 'desc')
            ->get();

        $completionRate = $totalDreams > 0 ? round(($completedDreams / $totalDreams) * 100, 1) : 0;

        return view('livewire.stats', [
            'totalEvents' => $totalEvents,
            'averageRating' => $averageRating ? round($averageRating, 1) : 0,
            'categoryStats' => $categoryStats,
            'totalDreams' => $totalDreams,
            'completedDreams' => $completedDreams,
            'pendingDreams' => $pendingDreams,
            'highPriorityDreams' => $highPriorityDreams,
            'linkedDreams' => $linkedDreams,
            'dreamCategoryStats' => $dreamCategoryStats,
            'completionRate' => $completionRate,
        ]);
    }
}
