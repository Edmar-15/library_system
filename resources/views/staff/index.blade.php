<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Management – LibrarySystem</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/staffIndex.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <!-- Header -->
    <header class="dashboard-header">
        <div class="logo-section">
            <div class="logo-icon">📚</div>
            <div class="logo-text">LibrarySystem</div>
        </div>
    </header>

    <div class="dashboard-container">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="sidebar-content">
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="{{ route('show.home') }}" class="nav-link" title="Home">
                            <i class="fas fa-home nav-icon"></i>
                            <span class="nav-text">Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('books.index') }}" class="nav-link" title="Books">
                            <i class="fas fa-book nav-icon"></i>
                            <span class="nav-text">Books</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('staff.index') }}" class="nav-link active" title="Staff">
                            <i class="fas fa-address-card nav-icon"></i>
                            <span class="nav-text">Staff</span>
                        </a>
                    </li>
                </ul>
                <div class="sidebar-logout">
                    <form action="{{ route('logout') }}" method="POST" class="logout-form">
                        @csrf
                        <button type="submit" class="sidebar-logout-btn">
                            <i class="fas fa-sign-out-alt sidebar-logout-icon"></i>
                            <span class="sidebar-logout-text">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            <div class="staff-page-header">
                <h1>Staff Management</h1>
                <p>Manage staff profiles, roles, and contact information.</p>
                @if (auth()->user()->role === 'librarian')
                    <a href="{{ route('staff.create') }}" class="staff-btn add staff-add-btn"><i class="fas fa-plus"></i>
                        Add Staff</a>
                @endif
            </div>

            @foreach($staffByRole as $role => $staffMembers)
                <div class="staff-role-title">{{ $role }}</div>
                <div class="staff-grid">
                    @foreach($staffMembers as $staff)
                        <div class="staff-card">
                            <img src="{{ $staff->profile_picture ? asset('storage/' . $staff->profile_picture) : asset('images/default.jpg') }}"
                                alt="{{ $staff->name }}">
                            <h4>{{ $staff->name }}</h4>
                            <p>{{ $staff->position }}</p>
                            <p>{{ $staff->email }}</p>
                            @if (auth()->user()->role === 'librarian')
                                <div class="staff-actions">
                                    <a href="{{ route('staff.edit', $staff) }}" class="staff-btn edit"><i class="fas fa-edit"></i>
                                        Edit</a>
                                    <form action="{{ route('staff.destroy', $staff) }}" method="POST"
                                        onsubmit="return confirm('Delete this staff member?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="staff-btn delete"><i class="fas fa-trash"></i> Delete</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endforeach
        </main>
    </div>
      <!-- Footer -->
  <footer class="dashboard-footer">
    <div class="copyright">
      &copy; {{ date('Y') }} LibrarySystem.
    </div>
    </div>
  </footer>
</body>

</html>