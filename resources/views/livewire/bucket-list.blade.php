<div style="background-color: var(--color-background);" class="min-h-screen">
    <!-- Header -->
    <div style="background-color: var(--color-surface);" class="p-4 border-b flex justify-between items-center" style="border-color: var(--color-border);">
        <h2 class="text-xl font-semibold" style="color: var(--color-text-primary);">My Dreams</h2>
        <a href="/dreams/create" class="w-9 h-9 rounded-full flex items-center justify-center text-white text-lg" style="background-color: var(--color-primary);">
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
            placeholder="Search dreams..."
        >
    </div>

    <!-- Filter Tabs -->
    <div style="background-color: var(--color-surface);" class="p-4 border-b flex gap-2 overflow-x-auto" style="border-color: var(--color-border);">
        @foreach($filters as $filter)
            <button
                wire:click="setFilter('{{ $filter }}')"
                class="px-4 py-2 rounded-full text-sm whitespace-nowrap transition-colors {{ $selectedFilter === $filter ? 'text-white' : '' }}"
                style="background-color: {{ $selectedFilter === $filter ? 'var(--color-primary)' : 'var(--color-background)' }}; color: {{ $selectedFilter === $filter ? 'white' : 'var(--color-text-primary)' }};"
            >
                {{ $filter }}
            </button>
        @endforeach
    </div>

    <!-- Dreams List -->
    <div class="p-5">
        @forelse($bucketListItems as $item)
            <a href="/dreams/{{ $item->id }}" style="background-color: var(--color-surface);" class="block rounded-xl p-4 mb-4 shadow-sm transition-transform hover:scale-[1.02]">
                <!-- Dream Card Header -->
                <div class="flex justify-between items-start mb-3">
                    <div class="flex-1 min-w-0">
                        <h3 class="font-medium text-base truncate {{ $item->is_completed ? 'line-through opacity-60' : '' }}" style="color: var(--color-text-primary);">
                            {{ $item->title }}
                        </h3>
                        <div class="text-xs mt-1" style="color: var(--color-text-secondary);">
                            {{ $item->category ?? 'Uncategorized' }}
                            @if($item->target_date)
                                • Target: {{ $item->target_date->format('M j, Y') }}
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center gap-2 ml-3">
                        @if($item->is_completed)
                            <x-lucide-check-circle class="w-5 h-5 text-green-500" />
                        @endif
                        <div class="flex gap-1">
                            @for($i = 1; $i <= $item->priority; $i++)
                                <x-lucide-star class="w-3 h-3 fill-current text-yellow-400" />
                            @endfor
                        </div>
                    </div>
                </div>

                <!-- Description -->
                @if($item->description)
                    <div class="mb-3 text-sm {{ $item->is_completed ? 'opacity-60' : '' }}" style="color: var(--color-text-secondary);">
                        {{ Str::limit($item->description, 100) }}
                    </div>
                @endif

                <!-- Status Tags -->
                <div class="flex gap-2 flex-wrap">
                    @if($item->is_completed)
                        <span class="px-2 py-1 rounded-xl text-xs text-green-600" style="background-color: #f0fdf4;">
                            <x-lucide-sparkles class="w-3 h-3 inline mr-1" /> Achieved
                        </span>
                        @if($item->linkedEvent)
                            <span class="px-2 py-1 rounded-xl text-xs text-purple-600" style="background-color: #faf5ff;">
                                <x-lucide-target class="w-3 h-3 inline mr-1" /> Linked to Event
                            </span>
                        @endif
                    @else
                        <span class="px-2 py-1 rounded-xl text-xs text-blue-600" style="background-color: #eff6ff;">
                            <x-lucide-target class="w-3 h-3 inline mr-1" /> In Progress
                        </span>
                        @if($item->priority >= 4)
                            <span class="px-2 py-1 rounded-xl text-xs text-red-600" style="background-color: #fef2f2;">
                                <x-lucide-flame class="w-3 h-3 inline mr-1" /> High Priority
                            </span>
                        @endif
                    @endif
                    @if($item->target_date && $item->target_date->isPast() && !$item->is_completed)
                        <span class="px-2 py-1 rounded-xl text-xs text-orange-600" style="background-color: #fff7ed;">
                            <x-lucide-clock class="w-3 h-3 inline mr-1" /> Overdue
                        </span>
                    @endif
                </div>
            </a>
        @empty
            <div style="background-color: var(--color-surface);" class="rounded-xl p-8 text-center">
                <x-lucide-star class="w-16 h-16 mx-auto mb-4 opacity-60" />
                <h3 class="text-lg font-medium mb-2" style="color: var(--color-text-primary);">No dreams found</h3>
                <p class="text-sm mb-4" style="color: var(--color-text-secondary);">
                    @if($search || $selectedFilter !== 'All')
                        Try adjusting your search or filters
                    @else
                        Start by adding your first dream to your bucket list!
                    @endif
                </p>
                <a href="/dreams/create" class="inline-block px-6 py-3 rounded-full text-white font-medium" style="background-color: var(--color-primary);">
                    Add Your First Dream
                </a>
            </div>
        @endforelse
    </div>
</div>