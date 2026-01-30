<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    // Show all characters
    public function index()
    {
        $characters = Character::latest()->get();
        return view('characters.index', compact('characters'));
    }

    // Show form to create new character
    public function create()
    {
        return view('characters.create');
    }

    // Save new character to database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'role' => 'nullable|max:255',
            'age' => 'nullable|integer',
            'backstory' => 'nullable',
            'species' => 'nullable|max:255',
        ]);

        Character::create($validated);

        return redirect()->route('characters.index')
            ->with('success', 'Character created successfully!');
    }

    // Show one character
    public function show(Character $character)
    {
        return view('characters.show', compact('character'));
    }

    // Show form to edit character
    public function edit(Character $character)
    {
        return view('characters.edit', compact('character'));
    }

    // Update character in database
    public function update(Request $request, Character $character)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'role' => 'nullable|max:255',
            'age' => 'nullable|integer',
            'backstory' => 'nullable',
            'species' => 'nullable|max:255',
        ]);

        $character->update($validated);

        return redirect()->route('characters.index')
            ->with('success', 'Character updated successfully!');
    }

    // Delete character
    public function destroy(Character $character)
    {
        $character->delete();

        return redirect()->route('characters.index')
            ->with('success', 'Character deleted successfully!');
    }
}