<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Profile Settings - LibrarySystem</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Notification Container -->
    <div class="notification-container" id="notificationContainer"></div>

    <div class="profile-container">
        <div class="profile-header">
            <a href="{{ route('show.home') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Back to Dashboard
            </a>
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

            <form id="profileForm" class="profile-form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="profile-picture-section">
                    <div class="profile-picture-container" id="profile_picture_container">
                        @if($user->profile && $user->profile->profile_picture)
                            <img src="{{ asset('storage/' . $user->profile->profile_picture) }}"
                                 alt="Profile Picture" id="profileImage">
                        @else
                            <div class="default-avatar">
                                <i class="fas fa-user-circle"></i>
                                <small>No profile picture</small>
                            </div>
                        @endif
                    </div>

                    <div class="file-input-wrapper">
                        <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
                        <label for="profile_picture" class="file-input-label">
                            <i class="fas fa-cloud-upload-alt"></i>
                            Choose New Photo
                        </label>
                        <small>Max size: 5MB • Formats: JPG, PNG, GIF</small>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="name">
                            <i class="fas fa-user"></i>
                            Full Name
                        </label>
                        <input type="text" id="name" name="name"
                               value="{{ $user->name }}"
                               placeholder="Enter your full name"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="email">
                            <i class="fas fa-envelope"></i>
                            Email Address
                        </label>
                        <input type="email" id="email" name="email"
                               value="{{ $user->email }}"
                               readonly>
                    </div>

                    <div class="form-group full-width">
                        <label for="bio">
                            <i class="fas fa-edit"></i>
                            Biography
                        </label>
                        <textarea id="bio" name="bio"
                                  placeholder="Tell us about yourself, your interests, or anything you'd like to share..."
                                  maxlength="500">{{ $user->profile->bio ?? '' }}</textarea>
                        <div class="char-count">
                            <span id="bioCharCount">0</span>/500 characters
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone">
                            <i class="fas fa-phone"></i>
                            Phone Number
                        </label>
                        <input type="tel" id="phone" name="phone"
                               value="{{ $user->profile->phone ?? '' }}"
                               placeholder="Enter your phone number">
                    </div>

                    <div class="form-group">
                        <label for="address">
                            <i class="fas fa-map-marker-alt"></i>
                            Address
                        </label>
                        <input type="text" id="address" name="address"
                               value="{{ $user->profile->address ?? '' }}"
                               placeholder="Enter your address">
                    </div>
                </div>

                <button type="submit" class="submit-btn" id="submitBtn">
                    <i class="fas fa-save"></i>
                    Update Profile
                </button>
            </form>
        </div>
    </div>

    <script>
        // Notification System
        class NotificationSystem {
            static show(type, title, message, duration = 5000) {
                const container = document.getElementById('notificationContainer');
                const notification = document.createElement('div');
                notification.className = `notification ${type}`;

                const icons = {
                    success: 'fas fa-check-circle',
                    error: 'fas fa-exclamation-circle',
                    warning: 'fas fa-exclamation-triangle',
                    info: 'fas fa-info-circle'
                };

                notification.innerHTML = `
                    <i class="${icons[type]}"></i>
                    <div class="notification-content">
                        <div class="notification-title">${title}</div>
                        <div class="notification-message">${message}</div>
                    </div>
                    <button onclick="this.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                `;

                container.appendChild(notification);

                setTimeout(() => {
                    if (notification.parentElement) {
                        notification.classList.add('slide-out');
                        setTimeout(() => notification.remove(), 300);
                    }
                }, duration);
            }
        }

        // Character counter for bio
        const bioTextarea = document.getElementById('bio');
        const charCount = document.getElementById('bioCharCount');

        function updateCharCount() {
            if (bioTextarea && charCount) {
                charCount.textContent = bioTextarea.value.length;
            }
        }

        if (bioTextarea) {
            bioTextarea.addEventListener('input', updateCharCount);
            updateCharCount(); // Initial count
        }

        const profileForm = document.getElementById('profileForm');
        const submitBtn = document.getElementById('submitBtn');

        if (profileForm && submitBtn) {
            profileForm.addEventListener('submit', async (e) => {
                e.preventDefault();

                const originalText = submitBtn.innerHTML;
                const originalDisabled = submitBtn.disabled;

                submitBtn.innerHTML = '<i class="fas fa-spinner"></i> Updating...';
                submitBtn.disabled = true;

                try {
                    const response = await fetch(profileForm.action, {
                        method: 'POST',
                        body: new FormData(profileForm),
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ||
                                          document.querySelector('input[name="_token"]')?.value ||
                                          '{{ csrf_token() }}'
                        }
                    });

                    const contentType = response.headers.get("content-type");

                    if (contentType && contentType.includes("application/json")) {
                        const data = await response.json();

                        if (response.ok) {
                            NotificationSystem.show('success', 'Success!', data.message || 'Profile updated successfully!');

                            // Update displayed data
                            if (data.profile_picture) {
                                const container = document.getElementById('profile_picture_container');
                                if (container) {
                                    container.innerHTML = `
                                        <img src="${data.profile_picture}"
                                             alt="Profile Picture"
                                             style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                                    `;
                                }
                            }

                            // Show success message in session message area
                            if (!document.querySelector('.session-message')) {
                                const successMessage = `
                                    <div class="session-message success">
                                        <i class="fas fa-check-circle"></i>
                                        <div>
                                            <strong>Success!</strong>
                                            <p>Profile updated successfully!</p>
                                        </div>
                                        <button onclick="this.parentElement.remove()">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                `;
                                profileForm.insertAdjacentHTML('beforebegin', successMessage);
                            }

                            setTimeout(() => {
                                const message = document.querySelector('.session-message');
                                if (message) {
                                    message.remove();
                                }
                            }, 5000);

                        } else {
                            let errorMessage = data.message || 'Failed to update profile';

                            // Handle validation errors
                            if (data.errors) {
                                errorMessage = Object.values(data.errors).flat().join(', ');
                            }

                            throw new Error(errorMessage);
                        }
                    } else {
                        const text = await response.text();

                        if (response.ok) {
                            NotificationSystem.show('success', 'Success!', 'Profile updated successfully!');
                            setTimeout(() => {
                                window.location.reload();
                            }, 1500);
                        } else {
                            throw new Error('Server returned non-JSON response');
                        }
                    }
                } catch (error) {
                    console.error('Form submission error:', error);
                    NotificationSystem.show('error', 'Error!', error.message || 'An unexpected error occurred');
                } finally {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = originalDisabled;
                }
            });
        }

        // Image preview with progress indication
        const profilePictureInput = document.getElementById('profile_picture');
        if (profilePictureInput) {
            profilePictureInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (!file) return;

                // Validate file size (5MB max)
                if (file.size > 5 * 1024 * 1024) {
                    NotificationSystem.show('error', 'File Too Large', 'Please select an image smaller than 5MB');
                    this.value = '';
                    return;
                }

                // Validate file type
                const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                if (!validTypes.includes(file.type)) {
                    NotificationSystem.show('error', 'Invalid File Type', 'Please select a JPG, PNG, GIF, or WebP image');
                    this.value = '';
                    return;
                }

                const reader = new FileReader();

                reader.onload = (event) => {
                    const container = document.getElementById('profile_picture_container');
                    if (container) {
                        container.innerHTML = `
                            <img src="${event.target.result}"
                                 alt="Profile Picture Preview"
                                 style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                        `;
                    }
                };

                reader.onerror = () => {
                    NotificationSystem.show('error', 'Upload Error', 'Failed to process image');
                };

                reader.readAsDataURL(file);
            });
        }

        // Load profile data on page load
        async function loadProfile() {
            try {
                const response = await fetch('/librarysystem/profile/api', {
                    method: 'GET',
                    credentials: 'same-origin',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (response.ok) {
                    const contentType = response.headers.get("content-type");
                    if (contentType && contentType.includes("application/json")) {
                        const profile = await response.json();

                        // Update form fields
                        const nameInput = document.getElementById('name');
                        const emailInput = document.getElementById('email');
                        const bioInput = document.getElementById('bio');
                        const phoneInput = document.getElementById('phone');
                        const addressInput = document.getElementById('address');

                        if (nameInput) nameInput.value = profile.name || '';
                        if (emailInput) emailInput.value = profile.email || '';
                        if (bioInput) bioInput.value = profile.bio || '';
                        if (phoneInput) phoneInput.value = profile.phone || '';
                        if (addressInput) addressInput.value = profile.address || '';

                        updateCharCount();

                        // Update profile picture if available
                        if (profile.profile_picture) {
                            const container = document.getElementById('profile_picture_container');
                            if (container) {
                                container.innerHTML = `
                                    <img src="${profile.profile_picture}"
                                         alt="Profile Picture"
                                         style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                                `;
                            }
                        }
                    }
                }
            } catch (err) {
                console.error('Error loading profile:', err);
            }
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                document.querySelectorAll('.session-message').forEach(msg => {
                    msg.remove();
                });
            }, 5000);

            // Check for validation errors from Laravel
            @if($errors->any())
                @foreach($errors->all() as $error)
                    NotificationSystem.show('error', 'Validation Error', '{{ $error }}');
                @endforeach
            @endif

            const backBtn = document.querySelector('.back-btn');
            if (backBtn) {
                function adjustButtonPosition() {
                    if (window.innerWidth <= 768) {
                        backBtn.style.margin = '0 auto 20px auto';
                        backBtn.style.display = 'flex';
                        backBtn.style.justifyContent = 'center';
                    } else {
                        backBtn.style.margin = '';
                        backBtn.style.display = 'inline-flex';
                        backBtn.style.justifyContent = '';
                    }
                }

                adjustButtonPosition();
                window.addEventListener('resize', adjustButtonPosition);
            }

            // Load profile data
            loadProfile();
        });

        document.querySelectorAll('.form-group input, .form-group textarea').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });

            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('focused');
            });
        });
    </script>
</body>
</html>
