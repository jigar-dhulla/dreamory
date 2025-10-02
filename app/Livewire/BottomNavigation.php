<?php

namespace App\Livewire;

use Livewire\Component;
use Native\Mobile\Facades\Dialog;
use Native\Mobile\Facades\Haptics;

class BottomNavigation extends Component
{
    public function navigateWithVibration($route)
    {
        Haptics::vibrate();
        return redirect($route);
    }

    public function render()
    {
        return view('livewire.bottom-navigation');
    }
}
