<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\EventController;

Route::get('/', function () {
    $stats = [
        'characters' => \App\Models\Character::count(),
        'locations' => \App\Models\Location::count(),
        'events' => \App\Models\Event::count(),
    ];
    
    $recentCharacters = \App\Models\Character::latest()->take(3)->get();
    $recentLocations = \App\Models\Location::latest()->take(3)->get();
    $recentEvents = \App\Models\Event::latest()->take(3)->get();
    
    return view('home', compact('stats', 'recentCharacters', 'recentLocations', 'recentEvents'));
})->name('home');


// Character Routes
Route::resource('characters', CharacterController::class);

// Location routes
Route::resource('locations', LocationController::class);

// Event routes
Route::resource('events', EventController::class);
