@extends('layouts.app')

@section('title', 'Create Location')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">🗺️ Create New Location</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('locations.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Location Name *</label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}"
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <input type="text" 
                               class="form-control" 
                               id="type" 
                               name="type" 
                               value="{{ old('type') }}"
                               placeholder="e.g., Kingdom, Forest, City, Mountain">
                    </div>

                    <div class="mb-3">
                        <label for="climate" class="form-label">Climate</label>
                        <input type="text" 
                               class="form-control" 
                               id="climate" 
                               name="climate" 
                               value="{{ old('climate') }}"
                               placeholder="e.g., Tropical, Arctic, Desert, Temperate">
                    </div>

                    <div class="mb-3">
                        <label for="population" class="form-label">Population</label>
                        <input type="number" 
                               class="form-control" 
                               id="population" 
                               name="population" 
                               value="{{ old('population') }}">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" 
                                  id="description" 
                                  name="description" 
                                  rows="3"
                                  placeholder="Brief description of the location...">{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="notable_features" class="form-label">Notable Features</label>
                        <textarea class="form-control" 
                                  id="notable_features" 
                                  name="notable_features" 
                                  rows="5"
                                  placeholder="Interesting landmarks, buildings, or natural features...">{{ old('notable_features') }}</textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('locations.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Create Location
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection