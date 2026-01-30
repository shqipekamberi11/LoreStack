@extends('layouts.app')

@section('title', 'Edit Character')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-warning text-dark">
                <h3 class="mb-0">✏️ Edit: {{ $character->name }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('characters.update', $character) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Character Name *</label>
                        <input type="text" 
                               class="form-control" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $character->name) }}"
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <input type="text" 
                               class="form-control" 
                               id="role" 
                               name="role" 
                               value="{{ old('role', $character->role) }}">
                    </div>

                    <div class="mb-3">
                        <label for="species" class="form-label">Species</label>
                        <input type="text" 
                               class="form-control" 
                               id="species" 
                               name="species" 
                               value="{{ old('species', $character->species) }}">
                    </div>

                    <div class="mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" 
                               class="form-control" 
                               id="age" 
                               name="age" 
                               value="{{ old('age', $character->age) }}">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" 
                                  id="description" 
                                  name="description" 
                                  rows="3">{{ old('description', $character->description) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="backstory" class="form-label">Backstory</label>
                        <textarea class="form-control" 
                                  id="backstory" 
                                  name="backstory" 
                                  rows="5">{{ old('backstory', $character->backstory) }}</textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('characters.show', $character) }}" class="btn btn-secondary">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Update Character
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection