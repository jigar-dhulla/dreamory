<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddEventForm extends Component
{
    use WithFileUploads;

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

    public function save()
    {
        $this->validate();

        $photoPath = null;
        if ($this->photo) {
            $photoPath = $this->photo->store('event-photos', 'public');
        }

        Event::create([
            'name' => $this->name,
            'category' => $this->category,
            'location' => $this->location,
            'date_attended' => $this->date_attended,
            'overall_rating' => $this->overall_rating,
            'photo_path' => $photoPath,
            'notes' => $this->notes,
        ]);

        session()->flash('message', 'Event saved successfully!');

        return redirect()->route('events');
    }

    public function render()
    {
        return view('livewire.add-event-form');
    }
}
