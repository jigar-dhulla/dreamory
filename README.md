# Dreamory
*Personal Experience Database with Bucket List Manifestation*

Mobile app built with Laravel + Livewire + NativePHP for iOS and Android. Offline-first with SQLite storage.

## ✅ Features

### Events Management
- Full CRUD operations for events with photos
- Categories: Food & Dining, Music, Travel, Activities, Culture, Other
- 1-5 star rating system
- Search and filter functionality
- Location and date tracking

### Dreams (Bucket List)
- Full CRUD operations for dreams/goals
- Priority system (1-5 stars)
- Categories: Travel, Adventure, Learning, Career, Health, Relationships, Experiences, Other
- Achievement tracking with celebrations
- Target date management
- Link achieved dreams to events

### Dashboard & Statistics
- Real-time metrics for events and dreams
- Recent activities and achievements
- Completion rates and progress tracking
- Category breakdown for both events and dreams

### Mobile Features
- Bottom navigation: Home, Events, Dreams, Stats
- Offline-first with SQLite storage
- Touch-optimized UI (44px+ targets)
- Native photo capture and gallery integration

## Development

### Tech Stack
- **Backend:** Laravel 12 + Livewire
- **Mobile:** NativePHP for Android
- **Database:** SQLite (local storage)
- **Frontend:** Alpine.js + Tailwind CSS 4

### Commands
```bash
# Development
composer run dev    # Start full development stack
php artisan serve   # Laravel server only
npm run dev        # Vite development

# Mobile builds
php artisan native:android    # Build Android app
```

## Project Status

✅ **Completed MVP** with both Events and Dreams (Bucket List) functionality ready for mobile deployment.

