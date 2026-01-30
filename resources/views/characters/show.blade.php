@extends('layouts.app')

@section('title', $character->name)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="mb-3">
            <a href="{{ route('characters.index') }}" class="btn btn-secondary">
                ← Back to Characters
            </a>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h2 class="mb-0">{{ $character->name }}</h2>
                <div>
                    <a href="{{ route('characters.edit', $character) }}" class="btn btn-warning btn-sm">
                        Edit
                    </a>
                    <form action="{{ route('characters.destroy', $character) }}" 
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
                        
                        @if($character->role)
                            <p><strong>Role:</strong> 
                                <span class="badge bg-info">{{ $character->role }}</span>
                            </p>
                        @endif

                        @if($character->species)
                            <p><strong>Species:</strong> 
                                <span class="badge bg-success">{{ $character->species }}</span>
                            </p>
                        @endif

                        @if($character->age)
                            <p><strong>Age:</strong> {{ $character->age }} years</p>
                        @endif

                        @if($character->description)
                            <h5 class="mt-4">Description</h5>
                            <p class="text-muted">{{ $character->description }}</p>
                        @endif
                    </div>

                    <div class="col-md-6">
                        @if($character->backstory)
                            <h4>Backstory</h4>
                            <p class="text-muted">{{ $character->backstory }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                <small>Created: {{ $character->created_at->diffForHumans() }}</small>
            </div>
        </div>
    </div>
</div>
@endsection