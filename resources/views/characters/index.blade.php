@extends('layouts.app')

@section('title', 'Characters')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h1>📚 Characters</h1>
        <p class="text-muted">Manage all your fictional characters</p>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('characters.create') }}" class="btn btn-primary btn-lg">
            ➕ Create New Character
        </a>
    </div>
</div>

<div class="row">
    @forelse($characters as $character)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $character->name }}</h5>
                    
                    @if($character->role)
                        <span class="badge bg-info mb-2">{{ $character->role }}</span>
                    @endif
                    
                    @if($character->species)
                        <span class="badge bg-success mb-2">{{ $character->species }}</span>
                    @endif
                    
                    @if($character->description)
                        <p class="card-text text-muted">
                            {{ Str::limit($character->description, 100) }}
                        </p>
                    @endif
                    
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <a href="{{ route('characters.show', $character) }}" class="btn btn-sm btn-outline-primary">
                            View Details
                        </a>
                        <div>
                            <a href="{{ route('characters.edit', $character) }}" class="btn btn-sm btn-warning">
                                Edit
                            </a>
                            <form action="{{ route('characters.destroy', $character) }}" 
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
                <h4>No characters yet!</h4>
                <p>Click "Create New Character" to add your first character.</p>
            </div>
        </div>
    @endforelse
</div>
@endsection