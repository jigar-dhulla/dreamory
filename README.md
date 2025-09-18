# Dreamory - Mobile MVP Project Details
*Personal Experience Database with Bucket List Manifestation*

## 🎯 MVP Overview

The MVP focuses on creating a functional **mobile application** that allows users to log events with photos and ratings, while establishing the foundation for future bucket list features. The goal is to have a working mobile app within 2-3 weeks that delivers immediate value.

**MVP Scope:** Basic event tracking with photos, simple categorization, and a functional dashboard optimized for mobile use.

**Tech Stack:**
- Framework: Laravel + Livewire + NativePHP
- Frontend: Livewire + Alpine.js + Tailwind CSS
- Database: SQLite (local storage)
- Mobile Platform: iOS and Android via NativePHP
- Authentication: None (free/paid app model, no user accounts)

## 📦 MVP Features (Phase 1 - Weeks 1-2)

### Core Functionality
1. **Event CRUD Operations**
    - ✅ Add new events with basic details
    - ✅ View list of all events
    - ✅ Edit existing events
    - ✅ Delete events

2. **Essential Event Fields**
    - Name (required)
    - Date attended
    - Location
    - Category (dropdown)
    - Overall rating (1-5 stars)
    - Single photo upload
    - Basic notes field

3. **Simple Dashboard**
    - Total events count
    - Recent 5 events list
    - Average rating display
    - Quick stats cards
    - Quick add event button

4. **Basic Categories**
    - Pre-defined categories (no custom yet)
    - Food & Dining, Music, Travel, Activities, Culture, Other

5. **Bottom Navigation**
    - Home (Dashboard)
    - Events
    - Add Event (center button)
    - Stats (basic view)

## 💾 MVP Database Schema

```sql
-- Core Events Table (MVP)
CREATE TABLE events (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(255) NOT NULL,
    category VARCHAR(50),
    location VARCHAR(255),
    date_attended DATE,
    overall_rating INTEGER CHECK(overall_rating >= 1 AND overall_rating <= 5),
    photo_path VARCHAR(500),
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Add indexes for performance
CREATE INDEX idx_events_date ON events(date_attended);
CREATE INDEX idx_events_category ON events(category);
CREATE INDEX idx_events_rating ON events(overall_rating);
```

## 📁 MVP File Structure (Mobile App)

### Laravel + Livewire + NativePHP Structure
```
resources/
├── views/
│   ├── layouts/
│   │   └── mobile.blade.php
│   ├── dashboard/
│   │   └── index.blade.php
│   └── events/
│       ├── index.blade.php
│       ├── create.blade.php
│       ├── show.blade.php
│       └── edit.blade.php
├── js/
│   ├── app.js
│   └── components/
│       ├── photo-upload.js
│       └── rating-picker.js
└── css/
    └── app.css (Tailwind)

storage/
└── app/
    └── photos/
```

## 📱 Mobile UI Components (Based on Mockups)

### 1. **Bottom Navigation Bar**
- Fixed at bottom
- 4-5 icons with labels
- Center "Add" button prominent
- Active state highlighting

### 2. **Dashboard Screen**
- Welcome header with gradient background
- 2x2 grid of stat cards
- Recent events list (vertical scroll)
- Pull-to-refresh functionality

### 3. **Events List Screen**
- Search bar at top
- Horizontal scrolling category filters
- Vertical list of event cards
- Each card shows: photo, name, date, rating, location

### 4. **Add/Edit Event Form**
- Full-screen form
- Camera/gallery photo picker
- Date picker (native mobile)
- Star rating (tap to select)
- Category dropdown
- Save/Cancel in header

### 5. **Event Detail View**
- Hero image with back button overlay
- Quick info cards (rating, cost, category)
- Scrollable content sections
- Edit FAB (floating action button)

## 🚀 MVP Development Tasks

### Week 1: Foundation & Core Features
- [ ] **Day 1-2: Project Setup**
    - Setup mobile development environment
    - Initialize project structure
    - Configure database (local SQLite)
    - Setup navigation structure

- [ ] **Day 3-4: Core Models & Database**
    - Create Event model/schema
    - Setup database migrations
    - Implement basic CRUD operations
    - Test data persistence

- [ ] **Day 5-7: Essential Screens**
    - Dashboard with stats
    - Events list view
    - Add event form
    - Basic event detail view

### Week 2: Polish & Additional Features
- [ ] **Day 8-9: Photo Handling**
    - Camera/gallery integration
    - Photo storage and display
    - Thumbnail generation
    - Memory optimization

- [ ] **Day 10-11: Search & Filter**
    - Search functionality
    - Category filtering
    - Sort options (date, rating)
    - Pull-to-refresh

- [ ] **Day 12-14: Testing & Polish**
    - Test on multiple devices
    - Fix UI responsiveness
    - Handle edge cases
    - Performance optimization
    - Prepare for deployment

## 📱 Mobile-Specific Considerations

### User Experience
- **Touch-friendly targets** (minimum 44x44 points)
- **Swipe gestures** for navigation
- **Pull-to-refresh** on lists
- **Native components** (date picker, camera)
- **Offline-first** functionality

### Performance
- **Image optimization** (thumbnails, lazy loading)
- **List virtualization** for long lists
- **Minimal animations** for older devices
- **Local data caching**

### Platform Considerations
- **iOS**: Follow Human Interface Guidelines
- **Android**: Follow Material Design
- **Safe areas** for notches/home indicators
- **Keyboard handling** for forms
- **Permission requests** (camera, storage)

## 🎨 MVP Screen Requirements & Mockup Status

### ✅ **Screens We Have Mockups For:**
1. **Dashboard** ✓ Complete with stats, recent events
2. **Events List** ✓ With search and filters
3. **Add Event Form** ✓ All input fields shown
4. **Event Detail View** ✓ Comprehensive detail layout
5. **Statistics Screen** ✓ (Can simplify for MVP)

### 🔄 **Screens We Can Derive from Existing:**
1. **Edit Event Form** - Use Add Event layout with pre-filled data
2. **Empty States** - Simple centered message with icon
3. **Loading States** - Standard spinner/skeleton screens

### ❌ **Missing but Needed for MVP:**
1. **Delete Confirmation Dialog** - Simple modal overlay
2. **Success/Error Toast Messages** - Top or bottom notifications
3. **Photo Selection Screen** - Camera/Gallery chooser

## ✅ MVP Success Criteria

1. **Functional Requirements**
    - User can add, view, edit, delete events
    - Photos capture and display correctly
    - Rating system works smoothly
    - Dashboard shows accurate stats
    - Search and filter work properly

2. **Performance Requirements**
    - App launches in < 2 seconds
    - Smooth scrolling (60 fps)
    - Photo capture < 3 seconds
    - Search results appear instantly

3. **User Experience**
    - Intuitive navigation
    - Clear visual feedback
    - No critical bugs
    - Works offline
    - Data persists between sessions

## 🎯 Post-MVP Features (Phase 2+)

### Near-term Additions (Weeks 3-4)
1. **Multiple Photos per Event**
    - Photo gallery with swipe
    - Captions for photos

2. **Bucket List Module**
    - Basic bucket list (shown in mockups)
    - Link completed events

3. **Enhanced Stats**
    - Charts and graphs
    - Category breakdown

### Future Expansions (Month 2+)
1. **Cloud Sync**
    - User accounts
    - Backup to cloud
    - Cross-device sync

2. **Social Features**
    - Share events
    - Public/private settings
    - Friend recommendations

3. **Advanced Features**
    - Tags system
    - Custom categories
    - Export features
    - Location-based suggestions

## 🚦 MVP Development Principles

1. **Mobile-First Design**
    - Optimize for one-handed use
    - Prioritize touch interactions
    - Design for small screens first

2. **Keep It Simple**
    - One photo per event initially
    - Pre-defined categories only
    - Basic search (text only)
    - Simple 5-star rating

3. **Focus on Core Value**
    - Quick event capture is priority
    - Make it faster than taking notes
    - Ensure photos are safe

4. **Build for Extension**
    - Clean architecture
    - Modular components
    - Scalable database design
    - Well-documented code

## 🎉 MVP Deliverable

**By End of Week 2:** A functional mobile application where users can:
- Quickly capture events with photos
- Browse and search their memories
- See basic statistics
- Use the app completely offline
- Trust their memories are safely stored

## 📱 Mockup Coverage Assessment

### **For MVP Launch: We Have Everything!** ✅

**Core Screens Available:**
- Dashboard ✓
- Events List ✓
- Add Event ✓
- Event Detail ✓

**Can Build Without Additional Mockups:**
- Edit Event (reuse Add Event layout)
- Empty States (simple implementation)
- Dialogs/Toasts (standard mobile patterns)

**Nice-to-Have (Already Mocked):**
- Statistics Screen (simplify for MVP)
- Bucket List (save for Phase 2)

The existing mobile mockups provide **complete coverage** for MVP development. The designs are mobile-optimized with proper sizing (320px width), touch-friendly elements, and clear navigation patterns perfect for a mobile app!
