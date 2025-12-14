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

<!-- HEADER -->
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

    <!-- SIDEBAR -->
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

    <!-- MAIN -->
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
                                $isOwner = auth()->id() === $user->id;
                            @endphp

                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>

                                <td>
                                    <form method="POST" action="{{ route('admin.users.update', $user) }}">
                                        @csrf
                                        @method('PATCH')

                                        <select name="role" {{ $isSuperAdmin && !$isOwner ? 'disabled' : '' }}>
                                            <option value="student" {{ $user->role === 'student' ? 'selected' : '' }}>
                                                Student
                                            </option>
                                            <option value="librarian" {{ $user->role === 'librarian' ? 'selected' : '' }}>
                                                Librarian
                                            </option>
                                            @if ($isOwner)
                                                <option value="super_admin" selected>
                                                    Super Admin
                                                </option>
                                            @endif
                                        </select>
                                </td>

                                <td>
                                        <button type="submit" {{ $isSuperAdmin && !$isOwner ? 'disabled' : '' }}>
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
        const input = document.getElementById("userSearch");
        const filter = input.value.toLowerCase();
        const table = document.querySelector(".admin-table tbody");
        const rows = table.getElementsByTagName("tr");

        for (let i = 0; i < rows.length; i++) {
            let nameCell = rows[i].getElementsByTagName("td")[0];
            let emailCell = rows[i].getElementsByTagName("td")[1];
            if (nameCell || emailCell) {
                let nameText = nameCell.textContent || nameCell.innerText;
                let emailText = emailCell.textContent || emailCell.innerText;
                if (nameText.toLowerCase().indexOf(filter) > -1 || emailText.toLowerCase().indexOf(filter) > -1) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
    }
</script>
</body>
</html>
