@extends('layouts.app')

@section('title', 'Locations')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h1>🗺️ Locations</h1>
        <p class="text-muted">Manage all places in your fictional world</p>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('locations.create') }}" class="btn btn-primary btn-lg">
            ➕ Create New Location
        </a>
    </div>
</div>

<div class="row">
    @forelse($locations as $location)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $location->name }}</h5>
                    
                    @if($location->type)
                        <span class="badge bg-warning mb-2">{{ $location->type }}</span>
                    @endif
                    
                    @if($location->climate)
                        <span class="badge bg-info mb-2">{{ $location->climate }}</span>
                    @endif
                    
                    @if($location->description)
                        <p class="card-text text-muted">
                            {{ Str::limit($location->description, 100) }}
                        </p>
                    @endif

                    @if($location->population)
                        <p class="mb-2">
                            <small class="text-muted">
                                👥 Population: {{ number_format($location->population) }}
                            </small>
                        </p>
                    @endif
                    
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <a href="{{ route('locations.show', $location) }}" class="btn btn-sm btn-outline-primary">
                            View Details
                        </a>
                        <div>
                            <a href="{{ route('locations.edit', $location) }}" class="btn btn-sm btn-warning">
                                Edit
                            </a>
                            <form action="{{ route('locations.destroy', $location) }}" 
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
                <h4>No locations yet!</h4>
                <p>Click "Create New Location" to add your first place to your world.</p>
            </div>
        </div>
    @endforelse
</div>
@endsection