<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Pet</title>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/add-pet.css') }}">
    
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="form-card">
        <div class="form-header">
            <a href="{{ route('dashboard') }}" class="btn-back">
                <i class="bi bi-arrow-left"></i> Back to Dashboard
            </a>
            <h2>Add New Pet</h2>
        </div>

        <form action="{{ route('pets.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Pet Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                @error('name') <p class="error-text">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label>Species</label>
                <select name="species_id" class="form-control" required>
                    <option value="">-- Select Species --</option>
                    @foreach($species as $item)
                        <option value="{{ $item->id }}" {{ old('species_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
                @error('species_id') <p class="error-text">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label>Age (years)</label>
                <input type="number" name="age" class="form-control" min="0" value="{{ old('age') }}" required>
                @error('age') <p class="error-text">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="Available">Available</option>
                    <option value="Adopted">Adopted</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Save Pet</button>
        </form>
    </div>
</body>
</html>