<div style="background-color: var(--color-background);" class="min-h-screen">
    <!-- Header -->
    <div style="background-color: var(--color-surface);" class="p-4 border-b" style="border-color: var(--color-border);">
        <h2 class="text-xl font-semibold" style="color: var(--color-text-primary);">Your Stats</h2>
    </div>

    <div class="p-5">
        <!-- Overview Stats -->
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div style="background-color: var(--color-surface);" class="rounded-xl p-4 text-center">
                <div class="text-2xl font-bold mb-1" style="color: var(--color-text-primary);">{{ $totalEvents }}</div>
                <div class="text-sm" style="color: var(--color-text-secondary);">Total Events</div>
            </div>
            <div style="background-color: var(--color-surface);" class="rounded-xl p-4 text-center">
                <div class="text-2xl font-bold mb-1" style="color: var(--color-text-primary);">{{ $averageRating }}</div>
                <div class="text-sm" style="color: var(--color-text-secondary);">Avg Rating</div>
            </div>
        </div>

        <!-- Category Breakdown -->
        <div style="background-color: var(--color-surface);" class="rounded-xl p-4 mb-6">
            <h3 class="text-lg font-semibold mb-4" style="color: var(--color-text-primary);">Categories</h3>

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
                    <p class="text-sm" style="color: var(--color-text-secondary);">No data available yet</p>
                </div>
            @endforelse
        </div>

        <!-- Recent Activity -->
        <div style="background-color: var(--color-surface);" class="rounded-xl p-4">
            <h3 class="text-lg font-semibold mb-4" style="color: var(--color-text-primary);">Activity</h3>
            <div class="text-center py-8">
                <div class="text-4xl mb-2">🚀</div>
                <p class="text-sm" style="color: var(--color-text-secondary);">More insights coming soon!</p>
            </div>
        </div>
    </div>
</div>
