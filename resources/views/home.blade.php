@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Welcome Hero Section -->
<div class="jumbotron bg-gradient text-white rounded p-5 mb-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <h1 class="display-4">🌟 Welcome to LoreStack</h1>
    <p class="lead">Your collaborative worldbuilding platform for creating rich, interconnected fictional universes.</p>
    <hr class="my-4 bg-white">
    <p>Build characters, design locations, and chronicle events in your fictional world.</p>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-center border-primary">
            <div class="card-body">
                <h1 class="display-3 text-primary">{{ $stats['characters'] }}</h1>
                <p class="text-muted">Characters Created</p>
                <a href="{{ route('characters.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center border-warning">
            <div class="card-body">
                <h1 class="display-3 text-warning">{{ $stats['locations'] }}</h1>
                <p class="text-muted">Locations Mapped</p>
                <a href="{{ route('locations.index') }}" class="btn btn-sm btn-outline-warning">View All</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center border-danger">
            <div class="card-body">
                <h1 class="display-3 text-danger">{{ $stats['events'] }}</h1>
                <p class="text-muted">Events Chronicled</p>
                <a href="{{ route('events.index') }}" class="btn btn-sm btn-outline-danger">View All</a>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mb-4">
    <div class="col-12">
        <h3 class="mb-3">⚡ Quick Actions</h3>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card h-100">
            <div class="card-body text-center">
                <div class="mb-3">
                    <span style="font-size: 3rem;">👤</span>
                </div>
                <h5>Create Character</h5>
                <p class="text-muted">Add a new character to your world</p>
                <a href="{{ route('characters.create') }}" class="btn btn-primary">Create</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card h-100">
            <div class="card-body text-center">
                <div class="mb-3">
                    <span style="font-size: 3rem;">🗺️</span>
                </div>
                <h5>Create Location</h5>
                <p class="text-muted">Map out a new place</p>
                <a href="{{ route('locations.create') }}" class="btn btn-warning">Create</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card h-100">
            <div class="card-body text-center">
                <div class="mb-3">
                    <span style="font-size: 3rem;">⚔️</span>
                </div>
                <h5>Create Event</h5>
                <p class="text-muted">Chronicle a historical moment</p>
                <a href="{{ route('events.create') }}" class="btn btn-danger">Create</a>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="row">
    <!-- Recent Characters -->
    @if($recentCharacters->count() > 0)
    <div class="col-md-4 mb-4">
        <h4>📚 Recent Characters</h4>
        @foreach($recentCharacters as $character)
            <div class="card mb-2">
                <div class="card-body py-2">
                    <h6 class="mb-1">
                        <a href="{{ route('characters.show', $character) }}" class="text-decoration-none">
                            {{ $character->name }}
                        </a>
                    </h6>
                    @if($character->role)
                        <small class="text-muted">{{ $character->role }}</small>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    @endif

    <!-- Recent Locations -->
    @if($recentLocations->count() > 0)
    <div class="col-md-4 mb-4">
        <h4>🗺️ Recent Locations</h4>
        @foreach($recentLocations as $location)
            <div class="card mb-2">
                <div class="card-body py-2">
                    <h6 class="mb-1">
                        <a href="{{ route('locations.show', $location) }}" class="text-decoration-none">
                            {{ $location->name }}
                        </a>
                    </h6>
                    @if($location->type)
                        <small class="text-muted">{{ $location->type }}</small>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    @endif

    <!-- Recent Events -->
    @if($recentEvents->count() > 0)
    <div class="col-md-4 mb-4">
        <h4>⚔️ Recent Events</h4>
        @foreach($recentEvents as $event)
            <div class="card mb-2">
                <div class="card-body py-2">
                    <h6 class="mb-1">
                        <a href="{{ route('events.show', $event) }}" class="text-decoration-none">
                            {{ $event->title }}
                        </a>
                    </h6>
                    @if($event->event_date)
                        <small class="text-muted">{{ $event->event_date->format('M d, Y') }}</small>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    @endif
</div>

<!-- Getting Started (if empty) -->
@if($stats['characters'] == 0 && $stats['locations'] == 0 && $stats['events'] == 0)
<div class="row">
    <div class="col-12">
        <div class="alert alert-info">
            <h4>🎉 Get Started Building Your World!</h4>
            <p>You haven't created anything yet. Here's how to get started:</p>
            <ol>
                <li>Create your first <strong>character</strong> - the people who inhabit your world</li>
                <li>Design some <strong>locations</strong> - where your story takes place</li>
                <li>Chronicle <strong>events</strong> - the history that shapes your world</li>
            </ol>
            <p class="mb-0">Start with whichever inspires you most!</p>
        </div>
    </div>
</div>
@endif
@endsection