<nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 h-20">
    <div class="flex justify-around items-center h-full">
        <button wire:click="navigateWithVibration('/')" class="flex flex-col items-center gap-1 text-sm" style="color: {{ request()->is('/') ? 'var(--color-primary)' : 'var(--color-text-secondary)' }}">
            <x-lucide-home class="w-6 h-6" />
            <span class="text-xs">Home</span>
        </button>
        <button wire:click="navigateWithVibration('/events')" class="flex flex-col items-center gap-1 text-sm" style="color: {{ request()->is('events*') ? 'var(--color-primary)' : 'var(--color-text-secondary)' }}">
            <x-lucide-calendar class="w-6 h-6" />
            <span class="text-xs">Events</span>
        </button>
        <button wire:click="navigateWithVibration('/dreams')" class="flex flex-col items-center gap-1 text-sm" style="color: {{ request()->is('dreams*') ? 'var(--color-primary)' : 'var(--color-text-secondary)' }}">
            <x-lucide-star class="w-6 h-6" />
            <span class="text-xs">Dreams</span>
        </button>
        <button wire:click="navigateWithVibration('/stats')" class="flex flex-col items-center gap-1 text-sm" style="color: {{ request()->is('stats*') ? 'var(--color-primary)' : 'var(--color-text-secondary)' }}">
            <x-lucide-bar-chart class="w-6 h-6" />
            <span class="text-xs">Stats</span>
        </button>
    </div>
</nav>
