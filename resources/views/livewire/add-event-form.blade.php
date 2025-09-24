<div style="background-color: var(--color-background);" class="min-h-screen">
    <!-- Header -->
    <div style="background-color: var(--color-surface);" class="p-4 border-b flex justify-between items-center" style="border-color: var(--color-border);">
        <div class="flex items-center gap-3">
            <a href="/events" class="w-9 h-9 rounded-full flex items-center justify-center" style="background-color: var(--color-background);">
                ←
            </a>
            <h2 class="text-xl font-semibold" style="color: var(--color-text-primary);">Add Experience</h2>
        </div>
    </div>

    <!-- Form -->
    <div class="p-5">
        <form wire:submit="save">
            <!-- Event Name -->
            <div class="mb-6">
                <label class="block text-sm font-medium mb-2" style="color: var(--color-text-primary);">Event Name *</label>
                <input
                    type="text"
                    wire:model="name"
                    class="w-full px-4 py-3 rounded-xl text-base outline-none"
                    style="border: 1px solid var(--color-border); background-color: var(--color-surface);"
                    placeholder="e.g., Dinner at Italian Restaurant"
                >
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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

            <!-- Location -->
            <div class="mb-6">
                <label class="block text-sm font-medium mb-2" style="color: var(--color-text-primary);">Location</label>
                <input
                    type="text"
                    wire:model="location"
                    class="w-full px-4 py-3 rounded-xl text-base outline-none"
                    style="border: 1px solid var(--color-border); background-color: var(--color-surface);"
                    placeholder="e.g., Downtown Portland"
                >
                @error('location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Date -->
            <div class="mb-6">
                <label class="block text-sm font-medium mb-2" style="color: var(--color-text-primary);">Date Attended *</label>
                <input
                    type="date"
                    wire:model="date_attended"
                    class="w-full px-4 py-3 rounded-xl text-base outline-none"
                    style="border: 1px solid var(--color-border); background-color: var(--color-surface);"
                >
                @error('date_attended') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Rating -->
            <div class="mb-6">
                <label class="block text-sm font-medium mb-2" style="color: var(--color-text-primary);">Overall Rating *</label>
                <div class="flex gap-2">
                    @for($i = 1; $i <= 5; $i++)
                        <button
                            type="button"
                            wire:click="$set('overall_rating', {{ $i }})"
                            class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl transition-colors"
                            style="background-color: {{ $overall_rating >= $i ? 'var(--color-primary)' : 'var(--color-surface)' }}; border: 1px solid var(--color-border);"
                        >
                            ⭐
                        </button>
                    @endfor
                </div>
                @error('overall_rating') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Photo Selection -->
            <div class="mb-6">
                <label class="block text-sm font-medium mb-2" style="color: var(--color-text-primary);">Photo</label>
                <div class="border-2 border-dashed rounded-xl p-6 text-center" style="border-color: var(--color-border);">
                    @if (count($photos) > 0)
                        @foreach($photos as $photo)
                            <div class="mb-3">
                                <img src="{{ $photo }}" alt="Selected Photo" class="w-24 h-24 rounded-xl mx-auto object-cover mb-2">
                            </div>
                        @endforeach
                        <button
                            type="button"
                            wire:click="pickImage"
                            class="px-6 py-2 rounded-lg font-medium text-sm mb-2"
                            style="background-color: var(--color-primary); color: white;"
                        >
                            Change Photo
                        </button>
                    @else
                        <div class="mb-3">
                            <div class="w-24 h-24 rounded-xl mx-auto flex items-center justify-center text-4xl" style="background-color: var(--color-background);">
                                📷
                            </div>
                        </div>
                        <button
                            type="button"
                            wire:click="pickImage"
                            class="px-6 py-3 rounded-lg font-medium"
                            style="background-color: var(--color-primary); color: white;"
                        >
                            Select Photo
                        </button>
                    @endif
                    <p class="text-sm mt-2" style="color: var(--color-text-secondary);">Tap to select an image from your gallery</p>
                </div>
            </div>

            <!-- Notes -->
            <div class="mb-8">
                <label class="block text-sm font-medium mb-2" style="color: var(--color-text-primary);">Notes</label>
                <textarea
                    wire:model="notes"
                    rows="4"
                    class="w-full px-4 py-3 rounded-xl text-base outline-none resize-none"
                    style="border: 1px solid var(--color-border); background-color: var(--color-surface);"
                    placeholder="Share your thoughts, feelings, or memorable details..."
                ></textarea>
                @error('notes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Submit Button -->
            <button
                type="submit"
                class="w-full py-4 rounded-xl text-white font-semibold text-lg"
                style="background-color: var(--color-primary);"
            >
                Save Experience
            </button>
        </form>
    </div>
</div>
