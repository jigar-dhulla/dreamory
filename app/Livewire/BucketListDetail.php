<?php

namespace App\Livewire;

use App\Models\BucketListItem;
use App\Models\Event;
use Livewire\Component;
use Native\Mobile\Facades\Dialog;

class BucketListDetail extends Component
{
    public BucketListItem $bucketListItem;

    public function mount($id)
    {
        $this->bucketListItem = BucketListItem::with('linkedEvent')->findOrFail($id);
    }

    public function toggleCompleted()
    {
        if ($this->bucketListItem->is_completed) {
            $this->bucketListItem->markAsIncomplete();
            Dialog::toast('Dream marked as pending!');
        } else {
            $this->bucketListItem->markAsCompleted();
            Dialog::toast('Dream achieved! Congratulations!');
        }

        $this->bucketListItem->refresh();
    }

    public function linkToEvent($eventId)
    {
        $this->bucketListItem->update([
            'linked_event_id' => $eventId,
            'is_completed' => true,
            'completed_at' => now(),
        ]);

        Dialog::toast('Dream linked to event!');
        $this->bucketListItem->refresh();
    }

    public function unlinkFromEvent()
    {
        $this->bucketListItem->update([
            'linked_event_id' => null,
        ]);

        Dialog::toast('Dream unlinked from event.');
        $this->bucketListItem->refresh();
    }

    public function delete()
    {
        $this->bucketListItem->delete();
        Dialog::toast('Dream removed from your bucket list.');

        return redirect()->route('dreams');
    }

    public function render()
    {
        $recentEvents = Event::latest()->limit(10)->get();

        return view('livewire.bucket-list-detail', [
            'recentEvents' => $recentEvents,
        ]);
    }
}
