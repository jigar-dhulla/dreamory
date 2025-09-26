<div style="background-color: var(--color-background);" class="min-h-screen">
    <!-- Header -->
    <div style="background-color: var(--color-surface);" class="p-4 border-b flex justify-between items-center" style="border-color: var(--color-border);">
        <h2 class="text-xl font-semibold" style="color: var(--color-text-primary);">My Events</h2>
        <a href="/events/create" class="w-9 h-9 rounded-full flex items-center justify-center text-white text-lg" style="background-color: var(--color-primary);">
            <x-lucide-plus class="w-5 h-5" />
        </a>
    </div>

    <!-- Search Bar -->
    <div style="background-color: var(--color-surface);" class="p-4 border-b" style="border-color: var(--color-border);">
        <input
            type="text"
            wire:model.live="search"
            class="w-full px-4 py-3 rounded-full text-base outline-none"
            style="border: 1px solid var(--color-border);"
            placeholder="Search events..."
        >
    </div>

    <!-- Filter Tabs -->
    <div style="background-color: var(--color-surface);" class="p-4 border-b flex gap-2 overflow-x-auto" style="border-color: var(--color-border);">
        @foreach($categories as $category)
            <button
                wire:click="setCategory('{{ $category }}')"
                class="px-4 py-2 rounded-full text-sm whitespace-nowrap transition-colors {{ $selectedCategory === $category ? 'text-white' : '' }}"
                style="background-color: {{ $selectedCategory === $category ? 'var(--color-primary)' : 'var(--color-background)' }}; color: {{ $selectedCategory === $category ? 'white' : 'var(--color-text-primary)' }};"
            >
                {{ $category }}
            </button>
        @endforeach
    </div>

    <!-- Events List -->
    <div class="p-5">
        @forelse($events as $event)
            <a href="/events/{{ $event->id }}" style="background-color: var(--color-surface);" class="block rounded-xl p-4 mb-4 shadow-sm transition-transform hover:scale-[1.02]">
                <!-- Event Card Header -->
                <div class="flex justify-between items-start mb-3">
                    <div class="flex-1 min-w-0">
                        <h3 class="font-medium text-base truncate" style="color: var(--color-text-primary);">{{ $event->name }}</h3>
                        <div class="text-xs mt-1" style="color: var(--color-text-secondary);">
                            {{ $event->date_attended ? $event->date_attended->format('M j, Y') : 'No date' }}
                        </div>
                    </div>
                    @if($event->overall_rating)
                        <div class="flex gap-1 ml-3">
                            @for($i = 1; $i <= 5; $i++)
                                <x-lucide-star class="w-3 h-3 {{ $i <= $event->overall_rating ? 'fill-current text-yellow-400' : 'text-gray-300' }}" />
                            @endfor
                        </div>
                    @endif
                </div>

                <!-- Location -->
                @if($event->location)
                    <div class="mb-3 text-sm" style="color: var(--color-text-secondary);">
                        <x-lucide-map-pin class="w-4 h-4 inline mr-1" /> {{ $event->location }}
                    </div>
                @endif

                <!-- Tags -->
                <div class="flex gap-2 flex-wrap">
                    @if($event->category)
                        <span class="px-2 py-1 rounded-xl text-xs" style="background-color: #e3f2fd; color: #1976d2;">
                            {{ $event->category }}
                        </span>
                    @endif
                    @if($event->overall_rating >= 4)
                        <span class="px-2 py-1 rounded-xl text-xs" style="background-color: #f3e5f5; color: #7b1fa2;">
                            Highly Rated
                        </span>
                    @endif
                    @if($event->date_attended && $event->date_attended->isToday())
                        <span class="px-2 py-1 rounded-xl text-xs" style="background-color: #e8f5e8; color: #2e7d32;">
                            Today
                        </span>
                    @endif
                </div>
            </a>
        @empty
            <div style="background-color: var(--color-surface);" class="rounded-xl p-8 text-center">
                <x-lucide-calendar class="w-16 h-16 mx-auto mb-4 opacity-60" />
                <h3 class="text-lg font-medium mb-2" style="color: var(--color-text-primary);">No events found</h3>
                <p class="text-sm mb-4" style="color: var(--color-text-secondary);">
                    @if($search || $selectedCategory !== 'All')
                        Try adjusting your search or filters
                    @else
                        Start by adding your first experience!
                    @endif
                </p>
                <a href="/events/create" class="inline-block px-6 py-3 rounded-full text-white font-medium" style="background-color: var(--color-primary);">
                    Add Your First Event
                </a>
            </div>
        @endforelse
    </div>
</div>
