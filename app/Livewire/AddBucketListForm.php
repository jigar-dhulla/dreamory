<?php

namespace App\Livewire;

use App\Models\BucketListItem;
use Livewire\Component;
use Native\Mobile\Facades\Dialog;

class AddBucketListForm extends Component
{
    public $title = '';
    public $description = '';
    public $category = '';
    public $priority = 3;
    public $target_date = '';
    public $notes = '';

    public $categories = [
        'Travel',
        'Adventure',
        'Learning',
        'Career',
        'Health',
        'Relationships',
        'Experiences',
        'Other'
    ];

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
        'category' => 'required|string|in:Travel,Adventure,Learning,Career,Health,Relationships,Experiences,Other',
        'priority' => 'required|integer|between:1,5',
        'target_date' => 'nullable|date|after:today',
        'notes' => 'nullable|string|max:1000'
    ];

    public function save()
    {
        $this->validate();

        BucketListItem::create([
            'title' => $this->title,
            'description' => $this->description,
            'category' => $this->category,
            'priority' => $this->priority,
            'target_date' => $this->target_date,
            'notes' => $this->notes,
        ]);

        Dialog::toast('Dream added to your bucket list! 🌟');

        return redirect()->route('dreams');
    }

    public function render()
    {
        return view('livewire.add-bucket-list-form');
    }
}
