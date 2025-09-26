<?php

namespace App\Livewire;

use App\Models\BucketListItem;
use Livewire\Component;
use Native\Mobile\Facades\Dialog;

class BucketList extends Component
{
    public $search = '';
    public $selectedFilter = 'All';

    public $filters = [
        'All',
        'Pending',
        'Completed',
        'High Priority'
    ];

    public $categories = [
        'All',
        'Travel',
        'Adventure',
        'Learning',
        'Career',
        'Health',
        'Relationships',
        'Experiences',
        'Other'
    ];

    public function render()
    {
        $query = BucketListItem::query()->latest();

        // Apply search filter
        if ($this->search) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%')
                  ->orWhere('notes', 'like', '%' . $this->search . '%');
            });
        }

        // Apply status filter
        if ($this->selectedFilter && $this->selectedFilter !== 'All') {
            switch ($this->selectedFilter) {
                case 'Pending':
                    $query->pending();
                    break;
                case 'Completed':
                    $query->completed();
                    break;
                case 'High Priority':
                    $query->highPriority();
                    break;
            }
        }

        $bucketListItems = $query->with('linkedEvent')->get();

        return view('livewire.bucket-list', [
            'bucketListItems' => $bucketListItems
        ]);
    }

    public function setFilter($filter)
    {
        $this->selectedFilter = $filter;
    }

    public function toggleCompleted($itemId)
    {
        $item = BucketListItem::findOrFail($itemId);

        if ($item->is_completed) {
            $item->markAsIncomplete();
            Dialog::toast('Dream marked as pending!');
        } else {
            $item->markAsCompleted();
            Dialog::toast('🎉 Dream achieved! Congratulations!');
        }
    }
}
