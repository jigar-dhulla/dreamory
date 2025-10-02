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
    @livewire('bottom-navigation')
</body>
</html>