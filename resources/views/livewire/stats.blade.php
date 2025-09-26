<div style="background-color: var(--color-background);" class="min-h-screen">
    <!-- Header -->
    <div style="background-color: var(--color-surface);" class="p-4 border-b" style="border-color: var(--color-border);">
        <h2 class="text-xl font-semibold" style="color: var(--color-text-primary);">Your Stats</h2>
    </div>

    <div class="p-5">
        <!-- Overview Stats -->
        <div class="grid grid-cols-2 gap-3 mb-6">
            <div style="background-color: var(--color-surface);" class="rounded-xl p-4 text-center">
                <div class="text-2xl font-bold mb-1" style="color: var(--color-text-primary);">{{ $totalEvents }}</div>
                <div class="text-xs" style="color: var(--color-text-secondary);">Total Events</div>
            </div>
            <div style="background-color: var(--color-surface);" class="rounded-xl p-4 text-center">
                <div class="text-2xl font-bold mb-1" style="color: var(--color-text-primary);">{{ $averageRating }}</div>
                <div class="text-xs" style="color: var(--color-text-secondary);">Avg Rating</div>
            </div>
            <div style="background-color: var(--color-surface);" class="rounded-xl p-4 text-center">
                <div class="text-2xl font-bold mb-1" style="color: var(--color-text-primary);">{{ $totalDreams }}</div>
                <div class="text-xs" style="color: var(--color-text-secondary);">Total Dreams</div>
            </div>
            <div style="background-color: var(--color-surface);" class="rounded-xl p-4 text-center">
                <div class="text-2xl font-bold mb-1" style="color: var(--color-text-primary);">{{ $completionRate }}%</div>
                <div class="text-xs" style="color: var(--color-text-secondary);">Completion Rate</div>
            </div>
        </div>

        <!-- Dreams Overview -->
        <div style="background-color: var(--color-surface);" class="rounded-xl p-4 mb-6">
            <h3 class="text-lg font-semibold mb-4" style="color: var(--color-text-primary);">🌟 Dreams Overview</h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="text-center">
                    <div class="text-xl font-bold text-green-600">{{ $completedDreams }}</div>
                    <div class="text-xs" style="color: var(--color-text-secondary);">Achieved</div>
                </div>
                <div class="text-center">
                    <div class="text-xl font-bold text-blue-600">{{ $pendingDreams }}</div>
                    <div class="text-xs" style="color: var(--color-text-secondary);">Pending</div>
                </div>
                <div class="text-center">
                    <div class="text-xl font-bold text-orange-600">{{ $highPriorityDreams }}</div>
                    <div class="text-xs" style="color: var(--color-text-secondary);">High Priority</div>
                </div>
                <div class="text-center">
                    <div class="text-xl font-bold text-purple-600">{{ $linkedDreams }}</div>
                    <div class="text-xs" style="color: var(--color-text-secondary);">Linked to Events</div>
                </div>
            </div>
        </div>

        <!-- Event Categories -->
        <div style="background-color: var(--color-surface);" class="rounded-xl p-4 mb-6">
            <h3 class="text-lg font-semibold mb-4" style="color: var(--color-text-primary);">📅 Event Categories</h3>

            @forelse($categoryStats as $stat)
                <div class="flex justify-between items-center py-3 border-b last:border-b-0" style="border-color: var(--color-border);">
                    <div class="flex-1">
                        <div class="font-medium" style="color: var(--color-text-primary);">{{ $stat->category }}</div>
                        <div class="text-sm" style="color: var(--color-text-secondary);">{{ $stat->count }} event{{ $stat->count !== 1 ? 's' : '' }}</div>
                    </div>
                    <div class="text-right">
                        <div class="font-medium" style="color: var(--color-text-primary);">{{ number_format($stat->avg_rating, 1) }}</div>
                        <div class="text-xs" style="color: var(--color-text-secondary);">avg rating</div>
                    </div>
                </div>
            @empty
                <div class="text-center py-8">
                    <div class="text-4xl mb-2">📊</div>
                    <p class="text-sm" style="color: var(--color-text-secondary);">No event data available yet</p>
                </div>
            @endforelse
        </div>

        <!-- Dream Categories -->
        <div style="background-color: var(--color-surface);" class="rounded-xl p-4">
            <h3 class="text-lg font-semibold mb-4" style="color: var(--color-text-primary);">🌟 Dream Categories</h3>

            @forelse($dreamCategoryStats as $stat)
                <div class="flex justify-between items-center py-3 border-b last:border-b-0" style="border-color: var(--color-border);">
                    <div class="flex-1">
                        <div class="font-medium" style="color: var(--color-text-primary);">{{ $stat->category }}</div>
                        <div class="text-sm" style="color: var(--color-text-secondary);">{{ $stat->count }} dream{{ $stat->count !== 1 ? 's' : '' }}</div>
                    </div>
                    <div class="text-right">
                        <div class="font-medium text-green-600">{{ $stat->completed_count }}</div>
                        <div class="text-xs" style="color: var(--color-text-secondary);">achieved</div>
                    </div>
                </div>
            @empty
                <div class="text-center py-8">
                    <div class="text-4xl mb-2">🌟</div>
                    <p class="text-sm" style="color: var(--color-text-secondary);">No dream data available yet</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
