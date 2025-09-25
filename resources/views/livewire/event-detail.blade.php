<div style="background-color: var(--color-background);" class="min-h-screen">
    <!-- Hero Section with Image -->
    <div class="relative h-80 overflow-hidden" style="background: linear-gradient(135deg, var(--color-gradient-start), var(--color-gradient-end));">
        @if($event->photo_path)
            <img src="{{ $event->getPhoto() }}" class="w-full h-full object-cover opacity-90" alt="{{ $event->name }}">
        @endif

        <!-- Back Button -->
        <a href="/events" class="absolute top-12 left-4 w-9 h-9 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center text-lg shadow-lg">
            ←
        </a>

        <!-- Action Buttons -->
        <div class="absolute top-12 right-4 flex gap-2">
            <!-- Edit Button -->
            <a href="/events/{{ $event->id }}/edit" class="w-9 h-9 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center text-sm shadow-lg cursor-pointer">
                ✏️
            </a>
            <!-- Delete Button -->
            <button type="button" wire:click="delete" href="#" class="w-9 h-9 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center text-sm shadow-lg cursor-pointer">
                🗑️
            </button>
        </div>

        <!-- Hero Overlay -->
        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-5 pt-8">
            <h1 class="text-2xl font-bold text-white mb-2 drop-shadow-lg">{{ $event->name }}</h1>
            <div class="flex items-center gap-4 text-white/95 text-sm">
                <div class="flex items-center gap-1">
                    <span>📅</span>
                    <span>{{ $event->date_attended ? $event->date_attended->format('M j, Y') : 'No date' }}</span>
                </div>
                @if($event->location)
                    <div class="flex items-center gap-1">
                        <span>📍</span>
                        <span>{{ $event->location }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Info Card -->
    <div style="background-color: var(--color-surface);" class="mx-4 -mt-4 rounded-2xl p-5 shadow-lg relative z-10">
        <div class="grid grid-cols-2 gap-5">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center text-lg" style="background: linear-gradient(135deg, var(--color-primary)20, var(--color-primary)20);">
                    ⭐
                </div>
                <div>
                    <div class="text-xs text-gray-500 uppercase tracking-wide mb-1">Rating</div>
                    <div class="flex items-center gap-2">
                        <div class="flex gap-1">
                            @for($i = 1; $i <= 5; $i++)
                                <span class="text-sm">{{ $i <= ($event->overall_rating ?? 0) ? '⭐' : '☆' }}</span>
                            @endfor
                        </div>
                        <span class="text-sm text-gray-600">({{ $event->overall_rating ?? 0 }}.0)</span>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center text-lg" style="background: linear-gradient(135deg, var(--color-primary)20, var(--color-primary)20);">
                    🎭
                </div>
                <div>
                    <div class="text-xs text-gray-500 uppercase tracking-wide mb-1">Category</div>
                    <div class="font-semibold" style="color: var(--color-text-primary);">{{ $event->category ?? 'Uncategorized' }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tags Section -->
    @if($event->category)
    <div style="background-color: var(--color-surface);" class="mx-4 mt-4 rounded-2xl p-5 shadow-sm">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold" style="color: var(--color-text-primary);">Tags</h3>
        </div>
        <div class="flex flex-wrap gap-2">
            <div class="px-3 py-2 rounded-full text-sm font-medium border" style="background: linear-gradient(135deg, var(--color-primary)15, var(--color-primary)15); color: var(--color-primary); border-color: var(--color-primary)20;">
                {{ $event->category }}
            </div>
            @if($event->overall_rating >= 4)
                <div class="px-3 py-2 rounded-full text-sm font-medium" style="background-color: #f3e5f5; color: #7b1fa2;">
                    Highly Rated
                </div>
            @endif
            @if($event->date_attended && $event->date_attended->isToday())
                <div class="px-3 py-2 rounded-full text-sm font-medium" style="background-color: #e8f5e8; color: #2e7d32;">
                    Recent
                </div>
            @endif
        </div>
    </div>
    @endif

    <!-- My Experience Section -->
    @if($event->notes)
    <div style="background-color: var(--color-surface);" class="mx-4 mt-4 rounded-2xl p-5 shadow-sm">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold" style="color: var(--color-text-primary);">My Experience</h3>
            <a href="/events/{{ $event->id }}/edit" class="text-sm font-medium cursor-pointer" style="color: var(--color-primary);">Edit</a>
        </div>
        <div class="text-base leading-relaxed" style="color: var(--color-text-secondary);">
            {{ $event->notes }}
        </div>
    </div>
    @endif

    <!-- Event Details Section -->
    <div style="background-color: var(--color-surface);" class="mx-4 mt-4 rounded-2xl p-5 shadow-sm">
        <h3 class="text-lg font-bold mb-4" style="color: var(--color-text-primary);">Event Details</h3>
        <div class="space-y-4">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center text-sm" style="background: linear-gradient(135deg, var(--color-primary)20, var(--color-primary)20);">
                    📅
                </div>
                <div>
                    <div class="text-sm text-gray-500">Date Attended</div>
                    <div class="font-medium" style="color: var(--color-text-primary);">
                        {{ $event->date_attended ? $event->date_attended->format('l, F j, Y') : 'Not set' }}
                    </div>
                </div>
            </div>

            @if($event->location)
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center text-sm" style="background: linear-gradient(135deg, var(--color-primary)20, var(--color-primary)20);">
                    📍
                </div>
                <div>
                    <div class="text-sm text-gray-500">Location</div>
                    <div class="font-medium" style="color: var(--color-text-primary);">{{ $event->location }}</div>
                </div>
            </div>
            @endif

            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center text-sm" style="background: linear-gradient(135deg, var(--color-primary)20, var(--color-primary)20);">
                    📝
                </div>
                <div>
                    <div class="text-sm text-gray-500">Created</div>
                    <div class="font-medium" style="color: var(--color-text-primary);">{{ $event->created_at->format('M j, Y') }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Spacing for Navigation -->
    <div class="h-24"></div>
</div>
