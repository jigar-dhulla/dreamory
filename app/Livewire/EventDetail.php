<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;

class EventDetail extends Component
{
    public Event $event;

    public function mount($id)
    {
        $this->event = Event::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.event-detail');
    }
}
