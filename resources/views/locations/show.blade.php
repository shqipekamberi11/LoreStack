@extends('layouts.app')

@section('title', $location->name)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="mb-3">
            <a href="{{ route('locations.index') }}" class="btn btn-secondary">
                ← Back to Locations
            </a>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h2 class="mb-0">{{ $location->name }}</h2>
                <div>
                    <a href="{{ route('locations.edit', $location) }}" class="btn btn-warning btn-sm">
                        Edit
                    </a>
                    <form action="{{ route('locations.destroy', $location) }}" 
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
                        <h4>Basic Information</h4>
                        
                        @if($location->type)
                            <p><strong>Type:</strong> 
                                <span class="badge bg-warning">{{ $location->type }}</span>
                            </p>
                        @endif

                        @if($location->climate)
                            <p><strong>Climate:</strong> 
                                <span class="badge bg-info">{{ $location->climate }}</span>
                            </p>
                        @endif

                        @if($location->population)
                            <p><strong>Population:</strong> {{ number_format($location->population) }}</p>
                        @endif

                        @if($location->description)
                            <h5 class="mt-4">Description</h5>
                            <p class="text-muted">{{ $location->description }}</p>
                        @endif
                    </div>

                    <div class="col-md-6">
                        @if($location->notable_features)
                            <h4>Notable Features</h4>
                            <p class="text-muted">{{ $location->notable_features }}</p>
                        @endif
                    </div>
                </div>

                <!-- Events that happened here -->
                <hr>
                <div class="mt-4">
                    <h4>Events at this Location</h4>
                    @if($location->events->count() > 0)
                        <ul class="list-group">
                            @foreach($location->events as $event)
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $event->title }}</strong>
                                            @if($event->event_type)
                                                <span class="badge bg-secondary ms-2">{{ $event->event_type }}</span>
                                            @endif
                                            <br>
                                            <small class="text-muted">
                                                @if($event->event_date)
                                                    {{ $event->event_date->format('F j, Y') }}
                                                @endif
                                            </small>
                                        </div>
                                        <a href="{{ route('events.show', $event) }}" class="btn btn-sm btn-outline-primary">
                                            View Event
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">No events have occurred at this location yet.</p>
                    @endif
                </div>
            </div>
            <div class="card-footer text-muted">
                <small>Created: {{ $location->created_at->diffForHumans() }}</small>
                @if($location->updated_at != $location->created_at)
                    <small>• Updated: {{ $location->updated_at->diffForHumans() }}</small>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection