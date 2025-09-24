<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;
use Native\Mobile\Facades\Dialog;

class EventDetail extends Component
{
    public Event $event;

    public function mount($id)
    {
        $this->event = Event::findOrFail($id);
    }

    public function delete()
    {
        $this->event->delete();
        Dialog::toast('Event deleted successfully!');
        return redirect()->route('events');
    }

    public function render()
    {
        return view('livewire.event-detail');
    }
}
