<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pet Details - {{ $pet->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/view-pet.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="details-card">
        <div class="details-header">
            <a href="{{ route('dashboard') }}" class="btn-back">
                <i class="bi bi-arrow-left"></i> Back to Dashboard
            </a>
            <h2>Pet Details</h2>
        </div>

        <div class="details-grid">
            <div class="detail-item">
                <span class="label">Pet ID:</span>
                <span class="value">#{{ $pet->id }}</span>
            </div>
            <div class="detail-item">
                <span class="label">Pet Name:</span>
                <span class="value">{{ $pet->name }}</span>
            </div>
            <div class="detail-item">
                <span class="label">Species:</span>
                <span class="value">{{ $pet->species->name }}</span>
            </div>
            <div class="detail-item">
                <span class="label">Age:</span>
                <span class="value">{{ $pet->age }} yrs</span>
            </div>
            <div class="detail-item">
                <span class="label">Status:</span>
                <span class="status-badge {{ strtolower($pet->status) }}">{{ $pet->status }}</span>
            </div>
        </div>

        <div class="details-actions">
            <a href="{{ route('pets.edit', $pet->id) }}" class="btn btn-primary">
                <i class="bi bi-pencil"></i> Edit Pet
            </a>
            <form action="{{ route('pets.destroy', $pet->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this pet?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-trash"></i> Delete Pet
                </button>
            </form>
        </div>
    </div>
</body>
</html>