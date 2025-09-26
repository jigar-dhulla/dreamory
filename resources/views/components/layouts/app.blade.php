<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dreamory - Your Memory Journey' }}</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50 pb-20">
    <!-- Main Content -->
    <div class="min-h-screen">
        {{ $slot }}
    </div>

    <!-- Bottom Navigation -->
    <nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 h-20">
        <div class="flex justify-around items-center h-full">
            <a href="/" class="flex flex-col items-center gap-1 text-sm" style="color: {{ request()->is('/') ? 'var(--color-primary)' : 'var(--color-text-secondary)' }}">
                <div class="text-xl">🏠</div>
                <span class="text-xs">Home</span>
            </a>
            <a href="/events" class="flex flex-col items-center gap-1 text-sm" style="color: {{ request()->is('events*') ? 'var(--color-primary)' : 'var(--color-text-secondary)' }}">
                <div class="text-xl">📅</div>
                <span class="text-xs">Events</span>
            </a>
            <a href="/dreams" class="flex flex-col items-center gap-1 text-sm" style="color: {{ request()->is('dreams*') ? 'var(--color-primary)' : 'var(--color-text-secondary)' }}">
                <div class="text-xl">🌟</div>
                <span class="text-xs">Dreams</span>
            </a>
            <a href="/stats" class="flex flex-col items-center gap-1 text-sm" style="color: {{ request()->is('stats*') ? 'var(--color-primary)' : 'var(--color-text-secondary)' }}">
                <div class="text-xl">📊</div>
                <span class="text-xs">Stats</span>
            </a>
        </div>
    </nav>
</body>
</html>