<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LibrarySystem | Edit About Page</title>
    <link rel="stylesheet" href="{{ asset('css/editAbout.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <!-- Header -->
    <header class="dashboard-header">
        <div class="logo-section">
            <div class="logo-icon">📚</div>
            <div class="logo-text">LibrarySystem</div>
        </div>

        <div class="auth-section">
            <a href="{{ route('show.about') }}" class="auth-btn back-btn">
                <i class="fas fa-arrow-left"></i> Back to About
            </a>
        </div>
    </header>

    <div class="dashboard-container">
        <nav class="sidebar">
            <div class="sidebar-content">
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="{{ route('show.home') }}" class="nav-link" title="Dashboard">
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
                        <a href="{{ route('bookmarks.index') }}" class="nav-link" title="Bookmarks">
                            <i class="fas fa-bookmark nav-icon"></i>
                            <span class="nav-text">Bookmark</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('about.edit') }}" class="nav-link active" title="Edit About">
                            <i class="fas fa-edit nav-icon"></i>
                            <span class="nav-text">Edit About</span>
                        </a>
                    </li>
                </ul>
                @auth
                <div class="sidebar-logout">
                    <form action="{{ route('logout') }}" method="POST" class="logout-form">
                        @csrf
                        <button type="submit" class="sidebar-logout-btn">
                            <i class="fas fa-sign-out-alt sidebar-logout-icon"></i>
                            <span class="sidebar-logout-text">Logout</span>
                        </button>
                    </form>
                </div>
                @endauth
            </div>
        </nav>

        <main class="main-content">
            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title">Edit About Page</h1>
                <p class="page-subtitle">
                    Update the content of your library's about page. All changes will be visible to visitors.
                </p>
            </div>

            <div class="content-card form-wrapper">
                <h2><i class="fas fa-edit"></i> Edit About Content</h2>

                <form id="aboutForm" enctype="multipart/form-data" class="form-grid">
                    <!-- Title -->
                    <div class="form-group">
                        <label for="title"><i class="fas fa-heading"></i> Page Title:</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $about->title) }}" required>
                    </div>

                    <!-- Contact Email -->
                    <div class="form-group">
                        <label for="contact_email"><i class="fas fa-envelope"></i> Contact Email:</label>
                        <input type="email" id="contact_email" name="contact_email" value="{{ old('contact_email', $about->contact_email) }}">
                    </div>

                    <!-- Description -->
                    <div class="form-group full-width">
                        <label for="description"><i class="fas fa-align-left"></i> Description:</label>
                        <textarea id="description" name="description" rows="4">{{ old('description', $about->description) }}</textarea>
                    </div>

                    <!-- Mission -->
                    <div class="form-group">
                        <label for="mission"><i class="fas fa-bullseye"></i> Mission:</label>
                        <textarea id="mission" name="mission" rows="5">{{ old('mission', $about->mission) }}</textarea>
                    </div>

                    <!-- Vision -->
                    <div class="form-group">
                        <label for="vision"><i class="fas fa-eye"></i> Vision:</label>
                        <textarea id="vision" name="vision" rows="5">{{ old('vision', $about->vision) }}</textarea>
                    </div>

                    <!-- Features -->
                    <div class="form-group full-width">
                        <label for="features"><i class="fas fa-cogs"></i> System Features:</label>
                        <textarea id="features" name="features" rows="6">{{ old('features', $about->features) }}</textarea>
                        <small><i class="fas fa-info-circle"></i> Separate features with commas or new lines</small>
                    </div>

                    <!-- Contact Phone -->
                    <div class="form-group">
                        <label for="contact_phone"><i class="fas fa-phone"></i> Contact Phone:</label>
                        <input type="text" id="contact_phone" name="contact_phone" value="{{ old('contact_phone', $about->contact_phone) }}">
                    </div>

                    <!-- Image Upload -->
                    <div class="form-group full-width">
                        <label for="image"><i class="fas fa-image"></i> Logo/Image:</label>
                        <div class="file-upload-wrapper">
                            <input type="file" id="image" name="image" accept="image/*" class="file-upload">
                            <label for="image" class="file-upload-label">
                                <i class="fas fa-cloud-upload-alt"></i> Choose Image
                            </label>
                        </div>

                        @if($about->image)
                        <div class="current-image">
                            <p><strong>Current image:</strong></p>
                            <div class="image-preview">
                                <img src="{{ asset('storage/' . $about->image) }}" alt="Current logo">
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Submit Buttons -->
                    <div class="form-group full-width form-actions">
                        <button type="submit" class="submit-btn">
                            <i class="fas fa-save"></i> Update About Page
                        </button>
                        <a href="{{ route('show.about') }}" class="cancel-btn">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>

            <div class="content-card">
                <h2><i class="fas fa-users"></i> Team Members</h2>
                <p class="card-subtitle">
                    <i class="fas fa-info-circle"></i> To update team members, please contact the system administrator.
                </p>

                @if($about->developer_name && is_array($about->developer_name))
                <div class="team-list">
                    @foreach($about->developer_name as $index => $member)
                    <div class="team-member-card">
                        <div class="team-member-header">
                            <span class="member-number">{{ $index + 1 }}</span>
                            <h3 class="member-name">{{ $member['name'] }}</h3>
                        </div>
                        <div class="team-member-details">
                            <p class="member-role"><strong><i class="fas fa-briefcase"></i> Role:</strong> {{ $member['role'] }}</p>
                            <p class="member-email"><strong><i class="fas fa-envelope"></i> Email:</strong>
                                <a href="mailto:{{ $member['email'] }}" class="email-link">{{ $member['email'] }}</a>
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="no-team-message">
                    <p><i class="fas fa-user-slash"></i> No team members configured.</p>
                </div>
                @endif
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
        document.getElementById('aboutForm').addEventListener('submit', async function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            formData.append('_method', 'PATCH'); // simulate PATCH request

            const id = "{{ $about->id }}";
            const submitBtn = this.querySelector('.submit-btn');
            const originalText = submitBtn.innerHTML;

            try {
                // Show loading state
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Updating...';
                submitBtn.disabled = true;

                const response = await fetch("{{ url('api/about') }}/" + id, {
                    method: "POST", // use POST to send FormData
                    headers: {
                        "Accept": "application/json"
                    },
                    body: formData
                });

                const result = await response.json();

                if (response.ok) {
                    // Show success message
                    submitBtn.innerHTML = '<i class="fas fa-check"></i> Updated Successfully!';
                    submitBtn.style.background = '#27ae60';

                    // Redirect after delay
                    setTimeout(() => {
                        window.location.href = "{{ route('show.about') }}";
                    }, 1500);
                } else {
                    console.error(result);
                    let msg = result.message || "Update failed. Check console for details.";
                    if (result.errors) {
                        msg += "\n" + Object.values(result.errors).join('\n');
                    }
                    alert(msg);

                    // Reset button
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }

            } catch (error) {
                console.error(error);
                alert("Something went wrong. Please check your connection and try again.");

                // Reset button
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        });

        // File upload styling
        document.getElementById('image').addEventListener('change', function(e) {
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
    </script>
</body>
</html>
