<div style="background-color: var(--color-background);" class="min-h-screen">
    <!-- Header -->
    <div style="background-color: var(--color-surface);" class="p-4 border-b flex justify-between items-center" style="border-color: var(--color-border);">
        <div class="flex items-center gap-3">
            <a href="/dreams" class="w-9 h-9 rounded-full flex items-center justify-center" style="background-color: var(--color-background);">
                <x-lucide-chevron-left class="w-5 h-5" />
            </a>
            <h2 class="text-xl font-semibold" style="color: var(--color-text-primary);">Add Dream</h2>
        </div>
    </div>

    <!-- Form -->
    <div class="p-5">
        <form wire:submit="save">
            <!-- Dream Title -->
            <div class="mb-6">
                <label class="block text-sm font-medium mb-2" style="color: var(--color-text-primary);">Dream Title *</label>
                <input
                    type="text"
                    wire:model="title"
                    class="w-full px-4 py-3 rounded-xl text-base outline-none"
                    style="border: 1px solid var(--color-border); background-color: var(--color-surface);"
                    placeholder="e.g., Visit Japan, Learn to play guitar..."
                >
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Category -->
            <div class="mb-6">
                <label class="block text-sm font-medium mb-2" style="color: var(--color-text-primary);">Category *</label>
                <select
                    wire:model="category"
                    class="w-full px-4 py-3 rounded-xl text-base outline-none"
                    style="border: 1px solid var(--color-border); background-color: var(--color-surface);"
                >
                    <option value="">Select a category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}">{{ $cat }}</option>
                    @endforeach
                </select>
                @error('category') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label class="block text-sm font-medium mb-2" style="color: var(--color-text-primary);">Description</label>
                <textarea
                    wire:model="description"
                    rows="3"
                    class="w-full px-4 py-3 rounded-xl text-base outline-none resize-none"
                    style="border: 1px solid var(--color-border); background-color: var(--color-surface);"
                    placeholder="Describe your dream in detail..."
                ></textarea>
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Priority -->
            <div class="mb-6">
                <label class="block text-sm font-medium mb-2" style="color: var(--color-text-primary);">Priority *</label>
                <div class="flex gap-2">
                    @for($i = 1; $i <= 5; $i++)
                        <button
                            type="button"
                            wire:click="$set('priority', {{ $i }})"
                            class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl transition-colors"
                            style="background-color: {{ $priority >= $i ? 'var(--color-primary)' : 'var(--color-surface)' }}; border: 1px solid var(--color-border);"
                        >
                            ⭐
                        </button>
                    @endfor
                </div>
                <p class="text-xs mt-2" style="color: var(--color-text-secondary);">1 = Low priority, 5 = Highest priority</p>
                @error('priority') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Target Date -->
            <div class="mb-6">
                <label class="block text-sm font-medium mb-2" style="color: var(--color-text-primary);">Target Date</label>
                <input
                    type="date"
                    wire:model="target_date"
                    class="w-full px-4 py-3 rounded-xl text-base outline-none"
                    style="border: 1px solid var(--color-border); background-color: var(--color-surface);"
                >
                @error('target_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Notes -->
            <div class="mb-8">
                <label class="block text-sm font-medium mb-2" style="color: var(--color-text-primary);">Notes</label>
                <textarea
                    wire:model="notes"
                    rows="4"
                    class="w-full px-4 py-3 rounded-xl text-base outline-none resize-none"
                    style="border: 1px solid var(--color-border); background-color: var(--color-surface);"
                    placeholder="Any additional thoughts, plans, or inspiration..."
                ></textarea>
                @error('notes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Submit Button -->
            <button
                type="submit"
                class="w-full py-4 rounded-xl text-white font-semibold text-lg"
                style="background-color: var(--color-primary);"
            >
                Add to Dreams ✨
            </button>
        </form>
    </div>
</div>