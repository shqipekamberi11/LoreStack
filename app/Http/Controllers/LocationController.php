<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    // Show all locations
    public function index()
    {
        $locations = Location::latest()->get();
        return view('locations.index', compact('locations'));
    }

    // Show form to create new location
    public function create()
    {
        return view('locations.create');
    }

    // Save new location to database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'type' => 'nullable|max:255',
            'climate' => 'nullable|max:255',
            'population' => 'nullable|integer',
            'notable_features' => 'nullable',
        ]);

        Location::create($validated);

        return redirect()->route('locations.index')
            ->with('success', 'Location created successfully!');
    }

    // Show one location
    public function show(Location $location)
    {
        $location->load('events'); // Load related events
        return view('locations.show', compact('location'));
    }

    // Show form to edit location
    public function edit(Location $location)
    {
        return view('locations.edit', compact('location'));
    }

    // Update location in database
    public function update(Request $request, Location $location)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'type' => 'nullable|max:255',
            'climate' => 'nullable|max:255',
            'population' => 'nullable|integer',
            'notable_features' => 'nullable',
        ]);

        $location->update($validated);

        return redirect()->route('locations.index')
            ->with('success', 'Location updated successfully!');
    }

    // Delete location
    public function destroy(Location $location)
    {
        $location->delete();

        return redirect()->route('locations.index')
            ->with('success', 'Location deleted successfully!');
    }
}

?>