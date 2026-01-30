<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Location;
use App\Models\Character;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Show all events
    public function index()
    {
        $events = Event::with('location')->latest('event_date')->get();
        return view('events.index', compact('events'));
    }

    // Show form to create new event
    public function create()
    {
        $locations = Location::all();
        $characters = Character::all();
        return view('events.create', compact('locations', 'characters'));
    }

    // Save new event to database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'event_date' => 'nullable|date',
            'event_type' => 'nullable|max:255',
            'location_id' => 'nullable|exists:locations,id',
            'consequences' => 'nullable',
            'characters' => 'nullable|array',
            'characters.*' => 'exists:characters,id',
        ]);

        // Create the event
        $event = Event::create($validated);

        // Attach characters if selected
        if (isset($validated['characters'])) {
            $event->characters()->attach($validated['characters']);
        }

        return redirect()->route('events.index')
            ->with('success', 'Event created successfully!');
    }

    // Show one event
    public function show(Event $event)
    {
        $event->load('location', 'characters');
        return view('events.show', compact('event'));
    }

    // Show form to edit event
    public function edit(Event $event)
    {
        $locations = Location::all();
        $characters = Character::all();
        $event->load('characters');
        return view('events.edit', compact('event', 'locations', 'characters'));
    }

    // Update event in database
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'event_date' => 'nullable|date',
            'event_type' => 'nullable|max:255',
            'location_id' => 'nullable|exists:locations,id',
            'consequences' => 'nullable',
            'characters' => 'nullable|array',
            'characters.*' => 'exists:characters,id',
        ]);

        // Update the event
        $event->update($validated);

        // Sync characters (update relationships)
        if (isset($validated['characters'])) {
            $event->characters()->sync($validated['characters']);
        } else {
            $event->characters()->detach();
        }

        return redirect()->route('events.index')
            ->with('success', 'Event updated successfully!');
    }

    // Delete event
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Event deleted successfully!');
    }
}

?>