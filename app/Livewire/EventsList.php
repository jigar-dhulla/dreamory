<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;

class EventsList extends Component
{
    public $search = '';
    public $selectedCategory = 'All';

    public $categories = [
        'All',
        'Food & Dining',
        'Music',
        'Travel',
        'Activities',
        'Culture',
        'Other'
    ];

    public function render()
    {
        $query = Event::query()->latest();

        // Apply search filter
        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('location', 'like', '%' . $this->search . '%')
                  ->orWhere('notes', 'like', '%' . $this->search . '%');
            });
        }

        // Apply category filter
        if ($this->selectedCategory && $this->selectedCategory !== 'All') {
            $query->where('category', $this->selectedCategory);
        }

        $events = $query->get();

        return view('livewire.events-list', [
            'events' => $events
        ]);
    }

    public function setCategory($category)
    {
        $this->selectedCategory = $category;
    }
}
