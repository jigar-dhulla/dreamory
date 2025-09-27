<div class="text-white p-5 min-h-screen" style="background: linear-gradient(to bottom right, var(--color-gradient-start), var(--color-gradient-end))">
    <!-- Welcome Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold mb-1">Hello, Dreamer! <x-lucide-hand class="w-6 h-6 inline" /></h1>
        <p class="opacity-80 text-sm">Your memory journey continues...</p>
    </div>

    <!-- Quick Stats Grid -->
    <div class="grid grid-cols-2 gap-3 mb-6">
        <div class="bg-white/15 backdrop-blur-md rounded-2xl p-4 text-center">
            <div class="text-2xl font-bold mb-1">{{ $totalEvents }}</div>
            <div class="text-xs opacity-80">Events Logged</div>
        </div>
        <div class="bg-white/15 backdrop-blur-md rounded-2xl p-4 text-center">
            <div class="text-2xl font-bold mb-1">{{ $averageRating }}</div>
            <div class="text-xs opacity-80">Avg Rating</div>
        </div>
        <div class="bg-white/15 backdrop-blur-md rounded-2xl p-4 text-center">
            <div class="text-2xl font-bold mb-1">{{ $dreamsAchieved }}</div>
            <div class="text-xs opacity-80">Dreams Achieved</div>
        </div>
        <div class="bg-white/15 backdrop-blur-md rounded-2xl p-4 text-center">
            <div class="text-2xl font-bold mb-1">{{ $pendingDreams }}</div>
            <div class="text-xs opacity-80">Dreams Pending</div>
        </div>
    </div>

    <!-- Recent Achievements Section -->
    @if($recentCompletedDreams->count() > 0)
    <div class="mb-6">
        <h3 class="text-lg font-semibold mb-4"><x-lucide-party-popper class="w-5 h-5 inline mr-1" /> Recent Achievements</h3>
        @foreach($recentCompletedDreams as $dream)
            <div class="bg-white/10 rounded-xl p-4 mb-3 flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center flex-shrink-0">
                    <x-lucide-star class="w-5 h-5 text-white" />
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="text-sm font-medium truncate">{{ $dream->title }}</h4>
                    <p class="text-xs opacity-70">
                        Achieved {{ $dream->completed_at ? $dream->completed_at->diffForHumans() : 'recently' }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
    @endif

    <!-- Recent Experiences Section -->
    <div class="recent-section">
        <h3 class="text-lg font-semibold mb-4">Recent Experiences</h3>
        @forelse($recentEvents as $event)
            <div class="bg-white/10 rounded-xl p-4 mb-3 flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-pink-400 to-yellow-400 flex-shrink-0"></div>
                <div class="flex-1 min-w-0">
                    <h4 class="text-sm font-medium truncate">{{ $event->name }}</h4>
                    <p class="text-xs opacity-70">
                        {{ $event->date_attended ? $event->date_attended->diffForHumans() : 'No date' }}
                        @if($event->overall_rating)
                            • {!! str_repeat('⭐', $event->overall_rating) !!}
                        @endif
                    </p>
                </div>
            </div>
        @empty
            <div class="bg-white/10 rounded-xl p-4 text-center">
                <x-lucide-file-text class="w-10 h-10 mx-auto mb-2 opacity-70" />
                <p class="text-sm opacity-70">No events logged yet</p>
                <p class="text-xs opacity-60 mt-1">Start by adding your first experience!</p>
            </div>
        @endforelse
    </div>
</div>
