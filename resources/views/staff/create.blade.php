<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Staff – LibrarySystem</title>
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('css/createStaff.css') }}">
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
      <a href="{{ route('staff.index') }}" class="back-btn"><i class="fas fa-arrow-left"></i> Back to Staff</a>
      <div class="form-container">
        <h2>Add Staff</h2>
        <form action="{{ route('staff.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <label>Name</label>
          <input type="text" name="name" value="{{ old('name') }}" required>

          <label>Position / Role</label>
          <input type="text" name="position" value="{{ old('position') }}" required>

          <label>Email</label>
          <input type="email" name="email" value="{{ old('email') }}" required>

          <label>Profile Picture</label>
          <input type="file" name="profile_picture" accept="image/*">

          <button type="submit" class="staff-btn add"><i class="fas fa-plus"></i> Add Staff</button>
        </form>
      </div>
    </main>
  </div>

    <footer class="dashboard-footer">
        <div class="copyright">
            &copy; <span id="currentYear"></span> LibrarySystem.
        </div>
    </footer>
</body>

</html>