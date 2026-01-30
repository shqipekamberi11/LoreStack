@extends('layouts.app')

@section('title', 'Create Event')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">⚔️ Create New Event</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('events.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Event Title *</label>
                        <input type="text" 
                               class="form-control @error('title') is-invalid @enderror" 
                               id="title" 
                               name="title" 
                               value="{{ old('title') }}"
                               required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="event_type" class="form-label">Event Type</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="event_type" 
                                       name="event_type" 
                                       value="{{ old('event_type') }}"
                                       placeholder="e.g., Battle, Wedding, Discovery">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="event_date" class="form-label">Event Date</label>
                                <input type="date" 
                                       class="form-control" 
                                       id="event_date" 
                                       name="event_date" 
                                       value="{{ old('event_date') }}">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="location_id" class="form-label">Location</label>
                        <select class="form-select" id="location_id" name="location_id">
                            <option value="">-- Select a Location --</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>
                                    {{ $location->name }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Where did this event take place?</small>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" 
                                  id="description" 
                                  name="description" 
                                  rows="4"
                                  placeholder="What happened during this event...">{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="consequences" class="form-label">Consequences</label>
                        <textarea class="form-control" 
                                  id="consequences" 
                                  name="consequences" 
                                  rows="3"
                                  placeholder="What were the results or effects of this event...">{{ old('consequences') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Characters Involved</label>
                        <div class="border rounded p-3" style="max-height: 200px; overflow-y: auto;">
                            @forelse($characters as $character)
                                <div class="form-check">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           name="characters[]" 
                                           value="{{ $character->id }}" 
                                           id="character{{ $character->id }}"
                                           {{ in_array($character->id, old('characters', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="character{{ $character->id }}">
                                        {{ $character->name }}
                                        @if($character->role)
                                            <small class="text-muted">({{ $character->role }})</small>
                                        @endif
                                    </label>
                                </div>
                            @empty
                                <p class="text-muted mb-0">No characters created yet.</p>
                            @endforelse
                        </div>
                        <small class="text-muted">Select all characters who were involved in this event</small>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('events.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Create Event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection