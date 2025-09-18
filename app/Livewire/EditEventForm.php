<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditEventForm extends Component
{
    use WithFileUploads;

    public Event $event;
    public $name = '';
    public $category = '';
    public $location = '';
    public $date_attended = '';
    public $overall_rating = '';
    public $photo;
    public $notes = '';

    public $categories = [
        'Food & Dining',
        'Music',
        'Travel',
        'Activities',
        'Culture',
        'Other'
    ];

    protected $rules = [
        'name' => 'required|string|max:255',
        'category' => 'required|string|in:Food & Dining,Music,Travel,Activities,Culture,Other',
        'location' => 'nullable|string|max:255',
        'date_attended' => 'required|date',
        'overall_rating' => 'required|integer|between:1,5',
        'photo' => 'nullable|image|max:2048',
        'notes' => 'nullable|string|max:1000'
    ];

    public function mount($id)
    {
        $this->event = Event::findOrFail($id);

        // Populate form with existing values
        $this->name = $this->event->name;
        $this->category = $this->event->category ?? '';
        $this->location = $this->event->location ?? '';
        $this->date_attended = $this->event->date_attended ? $this->event->date_attended->format('Y-m-d') : '';
        $this->overall_rating = $this->event->overall_rating ?? '';
        $this->notes = $this->event->notes ?? '';
    }

    public function save()
    {
        $this->validate();

        $photoPath = $this->event->photo_path;
        if ($this->photo) {
            $photoPath = $this->photo->store('event-photos', 'public');
        }

        $this->event->update([
            'name' => $this->name,
            'category' => $this->category,
            'location' => $this->location,
            'date_attended' => $this->date_attended,
            'overall_rating' => $this->overall_rating,
            'photo_path' => $photoPath,
            'notes' => $this->notes,
        ]);

        session()->flash('message', 'Event updated successfully!');

        return redirect()->route('events.show', $this->event->id);
    }

    public function render()
    {
        return view('livewire.edit-event-form');
    }
}
