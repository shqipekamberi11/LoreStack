@extends('layouts.app')

@section('title', 'Events')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h1>⚔️ Events</h1>
        <p class="text-muted">Timeline of your fictional world's history</p>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('events.create') }}" class="btn btn-primary btn-lg">
            ➕ Create New Event
        </a>
    </div>
</div>

<div class="row">
    @forelse($events as $event)
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $event->title }}</h5>
                    
                    <div class="mb-2">
                        @if($event->event_type)
                            <span class="badge bg-danger">{{ $event->event_type }}</span>
                        @endif
                        
                        @if($event->event_date)
                            <span class="badge bg-secondary">{{ $event->event_date->format('M d, Y') }}</span>
                        @endif
                    </div>

                    @if($event->location)
                        <p class="mb-2">
                            <small>📍 <strong>Location:</strong> 
                                <a href="{{ route('locations.show', $event->location) }}" class="text-decoration-none">
                                    {{ $event->location->name }}
                                </a>
                            </small>
                        </p>
                    @endif
                    
                    @if($event->description)
                        <p class="card-text text-muted">
                            {{ Str::limit($event->description, 120) }}
                        </p>
                    @endif
                    
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <a href="{{ route('events.show', $event) }}" class="btn btn-sm btn-outline-primary">
                            View Details
                        </a>
                        <div>
                            <a href="{{ route('events.edit', $event) }}" class="btn btn-sm btn-warning">
                                Edit
                            </a>
                            <form action="{{ route('events.destroy', $event) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                <h4>No events yet!</h4>
                <p>Click "Create New Event" to add your first historical event.</p>
            </div>
        </div>
    @endforelse
</div>
@endsection