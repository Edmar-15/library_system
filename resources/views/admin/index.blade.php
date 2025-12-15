<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin – User Management</title>

    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

    <header class="dashboard-header">
        <div class="logo-section">
            <div class="logo-icon">📚</div>
            <div class="logo-text">LibrarySystem</div>
        </div>

        @auth
            <div class="user-section">
                <span class="user-name">{{ Auth::user()->name }}</span>
            </div>
        @endauth
    </header>

    <div class="dashboard-container">

        <nav class="sidebar">
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="fas fa-user-shield nav-icon"></i>
                        <span class="nav-text">Admin</span>
                    </a>
                </li>
            </ul>

            <form action="{{ route('logout') }}" method="POST" class="sidebar-logout">
                @csrf
                <button class="sidebar-logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </button>
            </form>
        </nav>

        <main class="main-content">

            <div class="admin-container">
                <div class="admin-card">

                    <h2 class="admin-title">
                        <i class="fas fa-user-shield"></i>
                        User Role Management
                    </h2>

                    <div class="search-container">
                        <input type="text" id="userSearch" placeholder="Search users..." onkeyup="filterUsers()">
                    </div>

                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($users as $user)
                                @php
                                    $isSuperAdmin = $user->role === 'super_admin';
                                @endphp

                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>

                                    <td>
                                        <form method="POST" action="{{ route('admin.users.update', $user) }}">
                                            @csrf
                                            @method('PATCH')

                                            <select name="role" {{ $isSuperAdmin ? 'disabled' : '' }}>
                                                <option value="student" {{ $user->role === 'student' ? 'selected' : '' }}>
                                                    Student
                                                </option>
                                                <option value="librarian" {{ $user->role === 'librarian' ? 'selected' : '' }}>
                                                    Librarian
                                                </option>

                                                @if ($isSuperAdmin)
                                                    <option value="super_admin" selected>
                                                        Super Admin
                                                    </option>
                                                @endif
                                            </select>
                                    </td>

                                    <td>
                                        <button type="submit" {{ $isSuperAdmin ? 'disabled' : '' }}>
                                            Update
                                        </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

        </main>
    </div>

    <script>
        function filterUsers() {
            const filter = document.getElementById("userSearch").value.toLowerCase();
            const rows = document.querySelectorAll(".admin-table tbody tr");

            rows.forEach(row => {
                const name = row.children[0].textContent.toLowerCase();
                const email = row.children[1].textContent.toLowerCase();
                row.style.display = (name.includes(filter) || email.includes(filter)) ? "" : "none";
            });
        }
    </script>

</body>

</html>