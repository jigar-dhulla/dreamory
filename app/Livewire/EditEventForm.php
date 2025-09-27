<?php

namespace App\Livewire;

use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Native\Mobile\Events\Gallery\MediaSelected;
use Native\Mobile\Facades\Camera;
use Native\Mobile\Facades\Dialog;

class EditEventForm extends Component
{
    public Event $event;

    public $name = '';

    public $category = '';

    public $location = '';

    public $date_attended = '';

    public $overall_rating = '';

    public $photo_path = null;

    public $notes = '';

    public $photos = [];

    public $categories = [
        'Food & Dining',
        'Music',
        'Travel',
        'Activities',
        'Culture',
        'Other',
    ];

    protected $rules = [
        'name' => 'required|string|max:255',
        'category' => 'required|string|in:Food & Dining,Music,Travel,Activities,Culture,Other',
        'location' => 'nullable|string|max:255',
        'date_attended' => 'required|date',
        'overall_rating' => 'required|integer|between:1,5',
        'notes' => 'nullable|string|max:1000',
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
        $this->photo_path = $this->event->photo_path;
        $this->notes = $this->event->notes ?? '';
    }

    public function pickImage()
    {
        Camera::pickImages('images', false);
    }

    #[On('native:'.MediaSelected::class)]
    public function handleMediaSelected($success, $files, $count)
    {
        if (! $success) {
            Dialog::toast('Failed to select the media.');

            return;
        }
        $this->photos = [];

        foreach ($files as $file) {
            if ($file['type'] === 'video') {
                Dialog::toast('Videos are not supported yet');
            } else {
                // For photos, use base64 data URI (small files)
                $fileContent = file_get_contents($file['path']);
                $data = base64_encode($fileContent);
                $filePath = 'public/photos/'.basename($file['path']);
                if (Storage::put($filePath, $fileContent) === false) {
                    Dialog::toast('Failed to upload photo');
                }
                $this->photos[] = "data:{$file['mimeType']};base64,{$data}";
                $this->photo_path = $filePath;
            }
        }
    }

    public function save()
    {
        $this->validate();

        $this->event->update([
            'name' => $this->name,
            'category' => $this->category,
            'location' => $this->location,
            'date_attended' => $this->date_attended,
            'overall_rating' => $this->overall_rating,
            'photo_path' => $this->photo_path,
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
