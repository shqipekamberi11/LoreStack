@extends('layouts.app')

@section('title', $event->title)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="mb-3">
            <a href="{{ route('events.index') }}" class="btn btn-secondary">
                ← Back to Events
            </a>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h2 class="mb-0">{{ $event->title }}</h2>
                <div>
                    <a href="{{ route('events.edit', $event) }}" class="btn btn-warning btn-sm">
                        Edit
                    </a>
                    <form action="{{ route('events.destroy', $event) }}" 
                          method="POST" 
                          class="d-inline"
                          onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Event Details</h4>
                        
                        @if($event->event_type)
                            <p><strong>Type:</strong> 
                                <span class="badge bg-danger">{{ $event->event_type }}</span>
                            </p>
                        @endif

                        @if($event->event_date)
                            <p><strong>Date:</strong> {{ $event->event_date->format('F j, Y') }}</p>
                        @endif

                        @if($event->location)
                            <p><strong>Location:</strong> 
                                <a href="{{ route('locations.show', $event->location) }}" class="text-decoration-none">
                                    {{ $event->location->name }}
                                </a>
                            </p>
                        @endif

                        @if($event->description)
                            <h5 class="mt-4">What Happened</h5>
                            <p class="text-muted">{{ $event->description }}</p>
                        @endif
                    </div>

                    <div class="col-md-6">
                        @if($event->consequences)
                            <h4>Consequences</h4>
                            <p class="text-muted">{{ $event->consequences }}</p>
                        @endif
                    </div>
                </div>

                <!-- Characters Involved -->
                <hr>
                <div class="mt-4">
                    <h4>Characters Involved</h4>
                    @if($event->characters->count() > 0)
                        <div class="row">
                            @foreach($event->characters as $character)
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">
                                                <a href="{{ route('characters.show', $character) }}" class="text-decoration-none">
                                                    {{ $character->name }}
                                                </a>
                                            </h6>
                                            @if($character->role)
                                                <span class="badge bg-info">{{ $character->role }}</span>
                                            @endif
                                            @if($character->pivot->involvement)
                                                <span class="badge bg-secondary">{{ $character->pivot->involvement }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">No characters have been linked to this event yet.</p>
                    @endif
                </div>
            </div>
            <div class="card-footer text-muted">
                <small>Created: {{ $event->created_at->diffForHumans() }}</small>
                @if($event->updated_at != $event->created_at)
                    <small>• Updated: {{ $event->updated_at->diffForHumans() }}</small>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection