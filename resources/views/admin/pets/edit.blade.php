<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Pet - {{ $pet->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/edit-pet.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="form-card">
        <div class="form-header">
            <a href="{{ route('dashboard') }}" class="btn-back">
                <i class="bi bi-arrow-left"></i> Back to Dashboard
            </a>
            <h2>Edit Pet</h2>
        </div>

        <form action="{{ route('pets.update', $pet->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Pet Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $pet->name) }}" required>
                @error('name') <p class="error-text">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label>Species</label>
                <select name="species_id" class="form-control" required>
                    <option value="">-- Select Species --</option>
                    @foreach($species as $item)
                        <option value="{{ $item->id }}" {{ old('species_id', $pet->species_id) == $item->id ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
                @error('species_id') <p class="error-text">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label>Age (years)</label>
                <input type="number" name="age" class="form-control" min="0" value="{{ old('age', $pet->age) }}" required>
                @error('age') <p class="error-text">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="Available" {{ old('status', $pet->status) == 'Available' ? 'selected' : '' }}>Available</option>
                    <option value="Adopted" {{ old('status', $pet->status) == 'Adopted' ? 'selected' : '' }}>Adopted</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-lg"></i> Update Pet
            </button>
        </form>
    </div>
</body>
</html>