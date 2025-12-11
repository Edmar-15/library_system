<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Profile Settings - LibrarySystem</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <!-- Header -->
  <header class="dashboard-header">
    <div class="logo-section">
      <div class="logo-icon">📚</div>
      <div class="logo-text">LibrarySystem</div>
    </div>

    <div class="search-section">
      <div class="search-container">
        <i class="fas fa-search search-icon"></i>
        <input type="text" class="search-input" placeholder="Search books, authors, categories...">
        <button class="search-btn">
          <i class="fas fa-arrow-right"></i>
        </button>
      </div>
    </div>

    @auth
    <div class="user-section">
      <div class="user-info">
        <a href="{{ route('show.profile') }}" class="user-avatar">
          <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="profile-pic" srcset="">
          <i class="user-name">{{ Auth::user()->name }}</i>
        </a>
      </div>
    </div>
    @endauth
  </header>

  <div class="dashboard-container">
    <nav class="sidebar">
      <div class="sidebar-content">
        <ul class="nav-menu">
          <li class="nav-item">
            <a href="{{ route('show.home') }}" class="nav-link active" title="Dashboard">
              <i class="fas fa-home nav-icon"></i>
              <span class="nav-text">Home</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('show.about') }}" class="nav-link" title="About">
              <i class="fas fa-solid fa-eye nav-icon"></i>
              <span class="nav-text">About</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('books.index') }}" class="nav-link" title="Books">

              <i class="fas fa-book nav-icon"></i>
              <span class="nav-text">Books</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="#edit" class="nav-link" title="Edit">
              <i class="fas fa-edit nav-icon"></i>
              <span class="nav-text">Edit</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="#bookmarks" class="nav-link" title="Bookmarks">
              <i class="fas fa-bookmark nav-icon"></i>
              <span class="nav-text">Bookmark</span>
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
        </div>
    </div>

    <main class="main-content">
      <!-- Page Header -->
      <div class="page-header">
        @auth
            <h1 class="page-title">Welcome, {{ Auth::user()->name }}</h1>
        @endauth
        <p class="page-subtitle">
          Here's what's happening with your library today. Continue your reading journey or explore new
          releases.
        </p>
      </div>

    <div class="profile-container">
        <div class="profile-header">
            <h1>Profile Settings</h1>
            <p>Update your personal information and preferences</p>
        </div>

        <div class="profile-content">
            @if(session('success'))
                <div class="session-message success">
                    <i class="fas fa-check-circle"></i>
                    <div>
                        <strong>Success!</strong>
                        <p>{{ session('success') }}</p>
                    </div>
                    <button onclick="this.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="session-message error">
                    <i class="fas fa-exclamation-circle"></i>
                    <div>
                        <strong>Error!</strong>
                        <p>{{ session('error') }}</p>
                    </div>
                    <button onclick="this.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            <div class="profile-layout">
                <!-- Mobile Profile Picture Top Section -->
                <div class="mobile-profile-top">
                    <div class="mobile-profile-picture" id="mobile_profile_picture_container">
                        @if($user->profile && $user->profile->profile_picture)
                            <img src="{{ asset('storage/' . $user->profile->profile_picture) }}"
                                 alt="Profile Picture" id="mobileProfileImage">
                            <div class="mobile-image-overlay">
                                <i class="fas fa-camera"></i>
                            </div>
                        @else
                            <div class="mobile-default-avatar">
                                <i class="fas fa-user-circle"></i>
                            </div>
                        @endif
                        <input type="file" id="mobile_profile_picture" name="profile_picture" accept="image/*" class="mobile-file-input">
                    </div>
                    <div class="mobile-profile-info">
                        <h2>{{ $user->name }}</h2>
                        <p>{{ $user->email }}</p>
                        <button type="button" class="mobile-change-photo" onclick="document.getElementById('mobile_profile_picture').click()">
                            <i class="fas fa-camera"></i> Change Photo
                        </button>
                    </div>
                </div>

                <!-- Left Column: Form -->
                <div class="profile-left">
                    <form id="profileForm" class="profile-form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Desktop Profile Picture Section -->
                        <div class="desktop-profile-picture">
                            <div class="profile-picture-card">
                                <div class="picture-header">
                                    <h3><i class="fas fa-camera"></i> Profile Picture</h3>
                                    <p class="section-description">Upload a clear photo of yourself</p>
                                </div>

                                <div class="picture-preview">
                                    <div class="profile-picture-container" id="profile_picture_container">
                                        @if($user->profile && $user->profile->profile_picture)
                                            <img src="{{ asset('storage/' . $user->profile->profile_picture) }}"
                                                 alt="Profile Picture" id="profileImage">
                                            <div class="image-overlay">
                                                <i class="fas fa-sync-alt"></i>
                                                <span>Change Photo</span>
                                            </div>
                                        @else
                                            <div class="default-avatar">
                                                <i class="fas fa-user-circle"></i>
                                                <div class="avatar-text">
                                                    <span>No Profile Picture</span>
                                                    <small>Click to upload</small>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="file-input-wrapper">
                                        <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
                                    </div>
                                </div>

                                <div class="picture-info">
                                    <div class="info-item">
                                        <i class="fas fa-info-circle"></i>
                                        <span>Recommended: Square image, 500x500px or larger</span>
                                    </div>
                                    <div class="info-item">
                                        <i class="fas fa-file-upload"></i>
                                        <span>Max size: 5MB • Formats: JPG, PNG, GIF</span>
                                    </div>
                                </div>

                                <div class="picture-actions">
                                    <label for="profile_picture" class="file-input-label">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                        Choose a Photo
                                    </label>
                                    <button type="button" class="btn-remove" id="removePhotoBtn">
                                        <i class="fas fa-trash-alt"></i>
                                        Remove Photo
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-section personal-info">
                            <div class="section-header">
                                <h3><i class="fas fa-user"></i> Personal Information</h3>
                                <p class="section-description">Update your basic personal details</p>
                            </div>

                            <div class="form-grid">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="name">Full Name</label>
                                        <input type="text" id="name" name="name"
                                               value="{{ $user->name }}"
                                               placeholder="Enter your full name"
                                               required>
                                        <div class="input-info">Your full legal name</div>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <input type="email" id="email" name="email"
                                               value="{{ $user->email }}"
                                               readonly>
                                        <div class="input-info">Email cannot be changed</div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input type="tel" id="phone" name="phone"
                                               value="{{ $user->profile->phone ?? '' }}"
                                               placeholder="Enter your phone number">
                                        <div class="input-info">Include country code if international</div>
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" id="address" name="address"
                                               value="{{ $user->profile->address ?? '' }}"
                                               placeholder="Enter your address">
                                        <div class="input-info">Your current residential address</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-section biography">
                            <div class="section-header">
                                <h3><i class="fas fa-edit"></i> Biography</h3>
                                <p class="section-description">Tell others about yourself</p>
                            </div>

                            <div class="form-group">
                                <textarea id="bio" name="bio"
                                          placeholder="Share your interests, background, or anything you'd like others to know..."
                                          maxlength="500">{{ $user->profile->bio ?? '' }}</textarea>
                                <div class="char-count">
                                    <span id="bioCharCount">0</span>/500 characters
                                </div>
                                <div class="input-info">This will be visible on your public profile</div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="action-group">
                                <a href="{{ route('show.home') }}" class="btn-cancel dashboard-btn">
                                    <i class="fas fa-arrow-left"></i>
                                    Back to Dashboard
                                </a>
                            </div>

                            <div class="action-group">
                                <button type="reset" class="btn-cancel">
                                    <i class="fas fa-times"></i>
                                    Cancel Changes
                                </button>
                                <button type="submit" class="btn-submit" id="submitBtn">
                                    <i class="fas fa-save"></i>
                                    Update Profile
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Right Column: Profile Picture (Desktop only) -->
                <div class="profile-right">
                    <div class="profile-picture-card">
                        <div class="picture-header">
                            <h3><i class="fas fa-camera"></i> Profile Picture</h3>
                            <p class="section-description">Upload a clear photo of yourself</p>
                        </div>

                        <div class="picture-preview">
                            <div class="profile-picture-container" id="desktop_profile_picture_container">
                                @if($user->profile && $user->profile->profile_picture)
                                    <img src="{{ asset('storage/' . $user->profile->profile_picture) }}"
                                         alt="Profile Picture" id="desktopProfileImage">
                                    <div class="image-overlay">
                                        <i class="fas fa-sync-alt"></i>
                                        <span>Change Photo</span>
                                    </div>
                                @else
                                    <div class="default-avatar">
                                        <i class="fas fa-user-circle"></i>
                                        <div class="avatar-text">
                                            <span>No Profile Picture</span>
                                            <small>Click to upload</small>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="file-input-wrapper">
                                <input type="file" id="desktop_profile_picture" name="profile_picture" accept="image/*">
                            </div>
                        </div>

                        <div class="picture-info">
                            <div class="info-item">
                                <i class="fas fa-info-circle"></i>
                                <span>Recommended: Square image, 500x500px or larger</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-file-upload"></i>
                                <span>Max size: 5MB • Formats: JPG, PNG, GIF</span>
                            </div>
                        </div>

                        <div class="picture-actions">
                            <label for="desktop_profile_picture" class="file-input-label">
                                <i class="fas fa-cloud-upload-alt"></i>
                                Choose a Photo
                            </label>
                            <button type="button" class="btn-remove" id="desktopRemovePhotoBtn">
                                <i class="fas fa-trash-alt"></i>
                                Remove Photo
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Bottom Action Bar -->
    <div class="mobile-bottom-bar">
        <button type="reset" class="mobile-bottom-btn cancel-btn">
            <i class="fas fa-times"></i>
            <span>Cancel</span>
        </button>
        <button type="submit" form="profileForm" class="mobile-bottom-btn submit-btn">
            <i class="fas fa-save"></i>
            <span>Save Changes</span>
        </button>
    </div>

  <script>
    // Logout button
    document.querySelector('.sidebar-logout-btn')?.addEventListener('click', function (e) {
      // Optional custom logic
    });

    // Sidebar active links
    document.querySelectorAll('.nav-link').forEach(link => {
      link.addEventListener('click', function () {
        document.querySelectorAll('.nav-link').forEach(item => item.classList.remove('active'));
        this.classList.add('active');
      });
    });

    // Search input (enter key)
    document.querySelector('.search-input')?.addEventListener('keypress', function (e) {
      if (e.key === 'Enter') {
        const query = this.value.trim();
        if (query) alert(`Searching for: "${query}"`);
      }
    });

    // Search button
    document.querySelector('.search-btn')?.addEventListener('click', function () {
      const query = document.querySelector('.search-input').value.trim();
      if (query) alert(`Searching for: "${query}"`);
    });
  </script>
</body>
</html>
