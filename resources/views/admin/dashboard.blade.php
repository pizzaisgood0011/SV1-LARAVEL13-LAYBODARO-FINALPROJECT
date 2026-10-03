<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pet Dashboard</title>

    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>

<body>

    <nav class="navbar">
        <div class="brand">
            <i class="bi bi-heart-pulse"></i>
            Pet Management System
        </div>

        <div class="user-info">
            <span>{{ auth()->user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="bi bi-box-arrow-right"></i>
                    Logout
                </button>
            </form>
        </div>
    </nav>


    <main class="main-content">

        @if(session('success'))
            <div class="alert-success">
                <i class="bi bi-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="page-header">
            <div>
                <h2>Pet Directory</h2>
                <p>Manage all registered pets in the system.</p>
            </div>
            <div class="action-bar">
                <a href="{{ route('species.create') }}" class="btn btn-secondary">
                    <i class="bi bi-tags"></i>Add Species
                </a>
                <a href="{{ route('pets.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i>Add Pet
                </a>
            </div>
        </div>
        <div class="dashboard-card">
            <table id="petsTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Species</th>
                        <th>Age</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pets as $pet)
                        <tr>
                            <td>{{ $pet->id }}</td>
                            <td>
                                <strong>{{ $pet->name }}</strong>
                            </td>
                            <td>
                                {{ $pet->species->name }}
                            </td>
                            <td>
                                {{ $pet->age }} yrs
                            </td>
                            <td>
                                <span class="status-badge {{ strtolower($pet->status) }}">
                                    {{ $pet->status }}
                                </span>
                            </td>
                            <td>
                                <div class="table-actions">
                                    {{-- Edit --}}
                                    <a href="{{ route('pets.edit', $pet->id) }}" class="btn-sm btn-edit" title="Edit Pet">
                                        <i class="bi bi-pencil"></i>
                                        Edit
                                    </a>
                                    {{-- Delete --}}
                                    <form action="{{ route('pets.destroy', $pet->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this pet?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-sm btn-delete" title="Delete Pet">
                                            <i class="bi bi-trash"></i>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#petsTable').DataTable({
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50],
                order: [[0, 'asc']],
                columnDefs: [
                    {
                        orderable: false,
                        searchable: false,
                        targets: 5
                    }
                ]
            });
        });
    </script>
</body>

</html>