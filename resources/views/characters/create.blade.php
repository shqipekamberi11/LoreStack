@extends('layouts.app')

@section('title', 'Create Character')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">✨ Create New Character</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('characters.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Character Name *</label>
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
                        <label for="role" class="form-label">Role</label>
                        <input type="text" 
                               class="form-control" 
                               id="role" 
                               name="role" 
                               value="{{ old('role') }}"
                               placeholder="e.g., Hero, Villain, Mentor">
                    </div>

                    <div class="mb-3">
                        <label for="species" class="form-label">Species</label>
                        <input type="text" 
                               class="form-control" 
                               id="species" 
                               name="species" 
                               value="{{ old('species') }}"
                               placeholder="e.g., Human, Elf, Dragon">
                    </div>

                    <div class="mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" 
                               class="form-control" 
                               id="age" 
                               name="age" 
                               value="{{ old('age') }}">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" 
                                  id="description" 
                                  name="description" 
                                  rows="3">{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="backstory" class="form-label">Backstory</label>
                        <textarea class="form-control" 
                                  id="backstory" 
                                  name="backstory" 
                                  rows="5">{{ old('backstory') }}</textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('characters.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Create Character
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection