<div style="background-color: var(--color-background);" class="min-h-screen">
    <!-- Header -->
    <div style="background-color: var(--color-surface);" class="p-4 border-b flex justify-between items-center" style="border-color: var(--color-border);">
        <div class="flex items-center gap-3">
            <a href="/dreams" class="w-9 h-9 rounded-full flex items-center justify-center" style="background-color: var(--color-background);">
                ←
            </a>
            <h2 class="text-xl font-semibold truncate" style="color: var(--color-text-primary);">Dream Details</h2>
        </div>
        <a href="/dreams/{{ $bucketListItem->id }}/edit" class="w-9 h-9 rounded-full flex items-center justify-center" style="background-color: var(--color-primary); color: white;">
            ✏️
        </a>
    </div>

    <!-- Dream Content -->
    <div class="p-5">
        <!-- Dream Header -->
        <div style="background-color: var(--color-surface);" class="rounded-xl p-6 mb-6">
            <div class="flex justify-between items-start mb-4">
                <div class="flex-1">
                    <h1 class="text-2xl font-bold mb-2 {{ $bucketListItem->is_completed ? 'line-through opacity-60' : '' }}" style="color: var(--color-text-primary);">
                        {{ $bucketListItem->title }}
                    </h1>
                    <div class="flex items-center gap-4 text-sm" style="color: var(--color-text-secondary);">
                        <span>{{ $bucketListItem->category ?? 'Uncategorized' }}</span>
                        @if($bucketListItem->target_date)
                            <span>Target: {{ $bucketListItem->target_date->format('M j, Y') }}</span>
                        @endif
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    @if($bucketListItem->is_completed)
                        <div class="text-green-500 text-2xl">✅</div>
                    @endif
                    <div class="flex gap-1">
                        @for($i = 1; $i <= $bucketListItem->priority; $i++)
                            <span class="text-lg">⭐</span>
                        @endfor
                    </div>
                </div>
            </div>

            <!-- Status Toggle -->
            <button
                wire:click="toggleCompleted"
                class="w-full py-3 rounded-xl font-medium transition-colors {{ $bucketListItem->is_completed ? 'text-orange-600' : 'text-white' }}"
                style="background-color: {{ $bucketListItem->is_completed ? '#fff7ed' : 'var(--color-success)' }};"
            >
                {{ $bucketListItem->is_completed ? '↩️ Mark as Pending' : '✨ Mark as Achieved!' }}
            </button>
        </div>

        <!-- Description -->
        @if($bucketListItem->description)
        <div style="background-color: var(--color-surface);" class="rounded-xl p-6 mb-6">
            <h3 class="text-lg font-semibold mb-3" style="color: var(--color-text-primary);">Description</h3>
            <p class="text-base leading-relaxed {{ $bucketListItem->is_completed ? 'opacity-60' : '' }}" style="color: var(--color-text-secondary);">
                {{ $bucketListItem->description }}
            </p>
        </div>
        @endif

        <!-- Linked Event -->
        @if($bucketListItem->linkedEvent)
        <div style="background-color: var(--color-surface);" class="rounded-xl p-6 mb-6">
            <h3 class="text-lg font-semibold mb-3" style="color: var(--color-text-primary);">🎯 Linked to Event</h3>
            <a href="/events/{{ $bucketListItem->linkedEvent->id }}" class="block p-4 rounded-lg border hover:scale-[1.02] transition-transform" style="border-color: var(--color-border);">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <h4 class="font-medium" style="color: var(--color-text-primary);">{{ $bucketListItem->linkedEvent->name }}</h4>
                        <p class="text-sm mt-1" style="color: var(--color-text-secondary);">
                            {{ $bucketListItem->linkedEvent->date_attended ? $bucketListItem->linkedEvent->date_attended->format('M j, Y') : 'No date' }}
                            @if($bucketListItem->linkedEvent->overall_rating)
                                • {!! str_repeat('⭐', $bucketListItem->linkedEvent->overall_rating) !!}
                            @endif
                        </p>
                    </div>
                    <button
                        wire:click="unlinkFromEvent"
                        class="px-3 py-1 rounded-lg text-xs text-red-600"
                        style="background-color: #fef2f2;"
                    >
                        Unlink
                    </button>
                </div>
            </a>
        </div>
        @elseif($bucketListItem->is_completed)
        <div style="background-color: var(--color-surface);" class="rounded-xl p-6 mb-6">
            <h3 class="text-lg font-semibold mb-3" style="color: var(--color-text-primary);">🎯 Link to Event</h3>
            <p class="text-sm mb-4" style="color: var(--color-text-secondary);">
                Connect this achievement to an event in your memory journal.
            </p>
            <div class="space-y-2">
                @forelse($recentEvents as $event)
                    <button
                        wire:click="linkToEvent({{ $event->id }})"
                        class="w-full p-3 rounded-lg text-left hover:scale-[1.02] transition-transform"
                        style="border: 1px solid var(--color-border);"
                    >
                        <div class="flex justify-between items-center">
                            <div>
                                <h4 class="font-medium" style="color: var(--color-text-primary);">{{ $event->name }}</h4>
                                <p class="text-sm" style="color: var(--color-text-secondary);">
                                    {{ $event->date_attended ? $event->date_attended->format('M j, Y') : 'No date' }}
                                </p>
                            </div>
                            <span class="text-blue-600">Link</span>
                        </div>
                    </button>
                @empty
                    <p class="text-sm text-center py-4" style="color: var(--color-text-secondary);">
                        No recent events to link to.
                    </p>
                @endforelse
            </div>
        </div>
        @endif

        <!-- Notes -->
        @if($bucketListItem->notes)
        <div style="background-color: var(--color-surface);" class="rounded-xl p-6 mb-6">
            <h3 class="text-lg font-semibold mb-3" style="color: var(--color-text-primary);">Notes</h3>
            <p class="text-base leading-relaxed {{ $bucketListItem->is_completed ? 'opacity-60' : '' }}" style="color: var(--color-text-secondary);">
                {{ $bucketListItem->notes }}
            </p>
        </div>
        @endif

        <!-- Achievement Date -->
        @if($bucketListItem->is_completed && $bucketListItem->completed_at)
        <div style="background-color: var(--color-surface);" class="rounded-xl p-6 mb-6">
            <h3 class="text-lg font-semibold mb-3" style="color: var(--color-text-primary);">🎉 Achievement Date</h3>
            <p class="text-base" style="color: var(--color-text-secondary);">
                Achieved on {{ $bucketListItem->completed_at->format('F j, Y \a\t g:i A') }}
            </p>
            <p class="text-sm mt-1" style="color: var(--color-text-secondary);">
                {{ $bucketListItem->completed_at->diffForHumans() }}
            </p>
        </div>
        @endif

        <!-- Actions -->
        <div class="grid grid-cols-2 gap-4">
            <a
                href="/dreams/{{ $bucketListItem->id }}/edit"
                class="py-3 px-6 rounded-xl text-center font-medium"
                style="background-color: var(--color-primary); color: white;"
            >
                Edit Dream
            </a>
            <button
                wire:click="delete"
                onclick="return confirm('Are you sure you want to delete this dream?')"
                class="py-3 px-6 rounded-xl text-center font-medium text-red-600"
                style="background-color: #fef2f2; border: 1px solid #fecaca;"
            >
                Delete Dream
            </button>
        </div>
    </div>
</div>