<?php

use App\Livewire\AddEventForm;
use App\Livewire\Dashboard;
use App\Livewire\EditEventForm;
use App\Livewire\EventDetail;
use App\Livewire\EventsList;
use App\Livewire\Stats;
use Illuminate\Support\Facades\Route;

Route::get('/', Dashboard::class);
Route::get('/events', EventsList::class)->name('events');
Route::get('/events/create', AddEventForm::class);
Route::get('/events/{id}', EventDetail::class)->name('events.show');
Route::get('/events/{id}/edit', EditEventForm::class)->name('events.edit');
Route::get('/stats', Stats::class);
