<?php

namespace App\Livewire;

use App\Models\BucketListItem;
use Livewire\Component;
use Native\Mobile\Facades\Dialog;

class EditBucketListForm extends Component
{
    public BucketListItem $bucketListItem;
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
        'target_date' => 'nullable|date',
        'notes' => 'nullable|string|max:1000'
    ];

    public function mount($id)
    {
        $this->bucketListItem = BucketListItem::findOrFail($id);

        // Populate form with existing values
        $this->title = $this->bucketListItem->title;
        $this->description = $this->bucketListItem->description ?? '';
        $this->category = $this->bucketListItem->category ?? '';
        $this->priority = $this->bucketListItem->priority ?? 3;
        $this->target_date = $this->bucketListItem->target_date ? $this->bucketListItem->target_date->format('Y-m-d') : '';
        $this->notes = $this->bucketListItem->notes ?? '';
    }

    public function save()
    {
        $this->validate();

        $this->bucketListItem->update([
            'title' => $this->title,
            'description' => $this->description,
            'category' => $this->category,
            'priority' => $this->priority,
            'target_date' => $this->target_date,
            'notes' => $this->notes,
        ]);

        Dialog::toast('Dream updated successfully! ✨');

        return redirect()->route('dreams.show', $this->bucketListItem->id);
    }

    public function delete()
    {
        $this->bucketListItem->delete();
        Dialog::toast('Dream removed from your bucket list.');
        return redirect()->route('dreams');
    }

    public function render()
    {
        return view('livewire.edit-bucket-list-form');
    }
}
