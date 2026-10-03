<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Species</title>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/add-species.css') }}">
    
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="species-container">
        <div class="nav-header">
            <a href="{{ route('dashboard') }}" class="btn-back">
                <i class="bi bi-arrow-left"></i> Back to Dashboard
            </a>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <div class="form-card">
            <h2>Add New Species</h2>
            <form action="{{ route('species.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Species Name</label>
                    <input type="text" name="name" class="form-control" placeholder="e.g. Dog, Cat, Parrot" required>
                    @error('name') <p class="error-text">{{ $message }}</p> @enderror
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i> Save Species
                </button>
            </form>
        </div>

        <div class="species-table-card">
            <h3>Existing Species</h3>
            <ul class="species-list">
                @foreach($speciesList as $item)
                    <li class="species-item">
                        <span>{{ $item->name }}</span>
                        <form action="{{ route('species.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Remove species?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-sm btn-delete">
                                <i class="bi bi-trash"></i> Remove
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</body>
</html>