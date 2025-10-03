<?php

namespace App\Livewire;

use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Livewire;
use Native\Mobile\Events\Gallery\MediaSelected;
use Native\Mobile\Facades\Camera;
use Native\Mobile\Facades\Dialog;

class AddEventForm extends Component
{
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
        'Other'
    ];

    protected $rules = [
        'name' => 'required|string|max:255',
        'category' => 'required|string|in:Food & Dining,Music,Travel,Activities,Culture,Other',
        'location' => 'nullable|string|max:255',
        'date_attended' => 'required|date',
        'overall_rating' => 'required|integer|between:1,5',
        'notes' => 'nullable|string|max:1000'
    ];

    public function pickImage()
    {
        Camera::pickImages('images', true);
    }

    #[On('native:'. MediaSelected::class)]
    public function handleMediaSelected($success, $files, $count)
    {
        if (!$success) {
            Dialog::toast('Failed to select the media.');
            return;
        }
        $this->photos = [];

        foreach ($files as $file) {
            $fileContent = file_get_contents($file['path']);
            $data = base64_encode($fileContent);
            $filePath = 'public/photos/' . basename($file['path']);
            if (false === Storage::put($filePath, $fileContent)) {
                Dialog::toast('Failed to upload photo');
            }
            $this->photos[] = [
                'path' => $filePath,
                'data' => "data:{$file['mimeType']};base64,{$data}",
            ];
        }
        // Set header photo path to the first photo if available
        if (!empty($this->photos)) {
            $this->header_photo_path = $this->photos[0]['path'];
        }
    }

    public function save()
    {
        $this->validate();

        $event = Event::create([
            'name' => $this->name,
            'category' => $this->category,
            'location' => $this->location,
            'date_attended' => $this->date_attended,
            'overall_rating' => $this->overall_rating,
            'photo_path' => $this->header_photo_path,
            'notes' => $this->notes,
        ]);

        $this->keepFirstPhotoAsHeaderPhoto();

        // Save all gallery photos
        if (!empty($this->photos)) {
            foreach ($this->photos as $photo) {
                $event->photos()->create([
                    'photo_path' => $photo['path'],
                ]);
            }
        }

        session()->flash('message', 'Event saved successfully!');
        return redirect()->route('events');
    }

    public function render()
    {
        return view('livewire.add-event-form');
    }

    private function keepFirstPhotoAsHeaderPhoto(): void
    {
        unset($this->photos[0]);
        $this->photos = array_values($this->photos);
    }
}
