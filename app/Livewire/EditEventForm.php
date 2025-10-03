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

    public $header_photo_path = null;

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
        $this->event = Event::with('photos')->findOrFail($id);

        // Populate form with existing values
        $this->name = $this->event->name;
        $this->category = $this->event->category ?? '';
        $this->location = $this->event->location ?? '';
        $this->date_attended = $this->event->date_attended ? $this->event->date_attended->format('Y-m-d') : '';
        $this->overall_rating = $this->event->overall_rating ?? '';
        $this->header_photo_path = $this->event->photo_path;
        $this->notes = $this->event->notes ?? '';

        // Load gallery photos as array of ['path' => ..., 'data' => ...]
        $this->photos = [];
        foreach ($this->event->photos as $photo) {
            $filePath = $photo->photo_path;
            $data = null;
            if (\Storage::exists($filePath)) {
                $fileContent = \Storage::get($filePath);
                $mimeType = \Storage::mimeType($filePath);
                $data = "data:{$mimeType};base64," . base64_encode($fileContent);
            }
            $this->photos[] = [
                'path' => $filePath,
                'data' => $data,
            ];
        }
    }

    public function pickImage()
    {
        Camera::pickImages('images', true);
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
                $fileContent = file_get_contents($file['path']);
                $data = base64_encode($fileContent);
                $filePath = 'public/photos/' . basename($file['path']);
                if (false === \Storage::put($filePath, $fileContent)) {
                    Dialog::toast('Failed to upload photo');
                }
                $this->photos[] = [
                    'path' => $filePath,
                    'data' => "data:{$file['mimeType']};base64,{$data}",
                ];
            }
        }
        // Set header photo path to the first photo if available
        if (!empty($this->photos)) {
            $this->header_photo_path = $this->photos[0]['path'];
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
            'photo_path' => $this->header_photo_path,
            'notes' => $this->notes,
        ]);

        // Update gallery photos: remove old, add new
        $this->event->photos()->delete();
        $this->keepFirstPhotoAsHeaderPhoto();
        if (!empty($this->photos)) {
            foreach ($this->photos as $photo) {
                $this->event->photos()->create([
                    'photo_path' => $photo['path'],
                ]);
            }
        }

        session()->flash('message', 'Event updated successfully!');
        return redirect()->route('events.show', $this->event->id);
    }

    public function render()
    {
        return view('livewire.edit-event-form');
    }

    private function keepFirstPhotoAsHeaderPhoto(): void
    {
        unset($this->photos[0]);
        $this->photos = array_values($this->photos);
    }
}
