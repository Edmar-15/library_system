<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Staff – LibrarySystem</title>
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
      <a href="{{ route('staff.index') }}" class="back-btn">
        <i class="fas fa-arrow-left"></i> Back to Staff
      </a>

      <div class="form-container">
        <h2><i class="fas fa-user-plus"></i> Add New Staff Member</h2>

        <form action="{{ route('staff.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <label for="name"><i class="fas fa-user"></i> Full Name</label>
          <input type="text" id="name" name="name" value="{{ old('name') }}" required>

          <label for="position"><i class="fas fa-briefcase"></i> Position / Role</label>
          <input type="text" id="position" name="position" value="{{ old('position') }}" required>
          <small><i class="fas fa-info-circle"></i> Example: Librarian, Assistant, Administrator, etc.</small>

          <label for="email"><i class="fas fa-envelope"></i> Email Address</label>
          <input type="email" id="email" name="email" value="{{ old('email') }}" required>

          <label for="profile_picture"><i class="fas fa-camera"></i> Profile Picture</label>
          <div class="file-upload-wrapper">
            <input type="file" id="profile_picture" name="profile_picture" accept="image/*" class="file-upload">
            <label for="profile_picture" class="file-upload-label">
              <i class="fas fa-cloud-upload-alt"></i> Choose Profile Image
            </label>
          </div>
          <small><i class="fas fa-info-circle"></i> Recommended: Square image, max 2MB (optional)</small>

          <!-- Form Actions -->
          <div class="form-actions">
            <button type="submit" class="staff-btn add">
              <i class="fas fa-plus"></i> Add Staff Member
            </button>
            <a href="{{ route('staff.index') }}" class="staff-btn cancel">
              <i class="fas fa-times"></i> Cancel
            </a>
          </div>
        </form>
      </div>
    </main>
  </div>

  <!-- Footer -->
  <footer class="dashboard-footer">
    <div class="copyright">
      &copy; {{ date('Y') }} LibrarySystem. All rights reserved.
    </div>
  </footer>

  <script>
    // File upload preview
    document.getElementById('profile_picture').addEventListener('change', function(e) {
      const fileName = e.target.files[0]?.name;
      const label = document.querySelector('.file-upload-label');
      if (fileName) {
        label.innerHTML = `<i class="fas fa-file-image"></i> ${fileName}`;
      }
    });

    // Sidebar active links
    document.querySelectorAll('.nav-link').forEach(link => {
      link.addEventListener('click', function () {
        document.querySelectorAll('.nav-link').forEach(item => item.classList.remove('active'));
        this.classList.add('active');
      });
    });

    // Set current year in footer
    document.getElementById('currentYear').textContent = new Date().getFullYear();
  </script>
</body>
</html>
