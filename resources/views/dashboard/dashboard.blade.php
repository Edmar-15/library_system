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
    <!-- Mobile Navigation -->
    <div class="mobile-nav">
        <a href="{{ route('show.home') }}" class="mobile-back-btn">
            <i class="fas fa-arrow-left"></i>
            <span>Back</span>
        </a>
        <h1 class="mobile-title">Profile</h1>
        <div class="mobile-actions">
            <button type="submit" form="profileForm" class="mobile-save-btn">
                <i class="fas fa-save"></i>
            </button>
        </div>
    </div>

    <!-- Notification Container -->
    <div class="notification-container" id="notificationContainer"></div>

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
            updateCharCount();
        }

        const profileForm = document.getElementById('profileForm');
        const submitBtn = document.getElementById('submitBtn');
        const mobileSubmitBtn = document.querySelector('.mobile-save-btn');
        const mobileBottomSubmitBtn = document.querySelector('.mobile-bottom-bar .submit-btn');

        function handleFormSubmit(e) {
            e.preventDefault();

            const submitButtons = [submitBtn, mobileSubmitBtn, mobileBottomSubmitBtn];

            submitButtons.forEach(btn => {
                if (btn) {
                    const originalText = btn.innerHTML;
                    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                    btn.disabled = true;

                    setTimeout(() => {
                        if (btn.disabled) {
                            btn.innerHTML = originalText;
                            btn.disabled = false;
                        }
                    }, 3000);
                }
            });

            const formData = new FormData(profileForm);

            const mobileFileInput = document.getElementById('mobile_profile_picture');
            if (mobileFileInput && mobileFileInput.files.length > 0) {
                formData.set('profile_picture', mobileFileInput.files[0]);
            }

            fetch(profileForm.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ||
                                  document.querySelector('input[name="_token"]')?.value ||
                                  '{{ csrf_token() }}'
                }
            })
            .then(response => {
                const contentType = response.headers.get("content-type");

                if (contentType && contentType.includes("application/json")) {
                    return response.json().then(data => {
                        if (response.ok) {
                            NotificationSystem.show('success', 'Success!', data.message || 'Profile updated successfully!');

                            const profileContainers = [
                                'profile_picture_container',
                                'mobile_profile_picture_container',
                                'desktop_profile_picture_container'
                            ];

                            profileContainers.forEach(containerId => {
                                const container = document.getElementById(containerId);
                                if (container) {
                                    if (data.profile_picture) {
                                        container.innerHTML = `
                                            <img src="${data.profile_picture}"
                                                 alt="Profile Picture"
                                                 style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                                            ${containerId === 'mobile_profile_picture_container' ?
                                                '<div class="mobile-image-overlay"><i class="fas fa-camera"></i></div>' :
                                                '<div class="image-overlay"><i class="fas fa-sync-alt"></i><span>Change Photo</span></div>'}
                                        `;
                                    }
                                }
                            });

                            const nameInput = document.getElementById('name');
                            const mobileProfileName = document.querySelector('.mobile-profile-info h2');
                            if (nameInput && mobileProfileName) {
                                mobileProfileName.textContent = nameInput.value;
                            }

                            // Show success message
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
                                document.querySelector('.profile-content').insertAdjacentHTML('afterbegin', successMessage);
                            }

                            setTimeout(() => {
                                const message = document.querySelector('.session-message');
                                if (message) message.remove();
                            }, 5000);

                        } else {
                            let errorMessage = data.message || 'Failed to update profile';
                            if (data.errors) {
                                errorMessage = Object.values(data.errors).flat().join(', ');
                            }
                            throw new Error(errorMessage);
                        }
                    });
                } else {
                    return response.text().then(text => {
                        if (response.ok) {
                            NotificationSystem.show('success', 'Success!', 'Profile updated successfully!');
                            setTimeout(() => window.location.reload(), 1500);
                        } else {
                            throw new Error('Server returned non-JSON response');
                        }
                    });
                }
            })
            .catch(error => {
                console.error('Form submission error:', error);
                NotificationSystem.show('error', 'Error!', error.message || 'An unexpected error occurred');
            })
            .finally(() => {
                submitButtons.forEach(btn => {
                    if (btn) {
                        if (btn === mobileSubmitBtn) {
                            btn.innerHTML = '<i class="fas fa-save"></i>';
                        } else if (btn === mobileBottomSubmitBtn) {
                            btn.innerHTML = '<i class="fas fa-save"></i><span>Save Changes</span>';
                        } else {
                            btn.innerHTML = '<i class="fas fa-save"></i> Update Profile';
                        }
                        btn.disabled = false;
                    }
                });
            });
        }

        if (profileForm) {
            profileForm.addEventListener('submit', handleFormSubmit);
        }

        // Image preview handlers for all file inputs
        function setupImagePreview(inputId, containerId, isMobile = false) {
            const input = document.getElementById(inputId);
            const container = document.getElementById(containerId);

            if (input && container) {
                input.addEventListener('change', function(e) {
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
                        const overlayHTML = isMobile ?
                            '<div class="mobile-image-overlay"><i class="fas fa-camera"></i></div>' :
                            '<div class="image-overlay"><i class="fas fa-sync-alt"></i><span>Change Photo</span></div>';

                        container.innerHTML = `
                            <img src="${event.target.result}"
                                 alt="Profile Picture Preview"
                                 style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                            ${overlayHTML}
                        `;

                        const otherInputs = ['profile_picture', 'mobile_profile_picture', 'desktop_profile_picture'];
                        otherInputs.forEach(otherInputId => {
                            if (otherInputId !== inputId) {
                                const otherInput = document.getElementById(otherInputId);
                                if (otherInput) {
                                    const dataTransfer = new DataTransfer();
                                    dataTransfer.items.add(file);
                                    otherInput.files = dataTransfer.files;
                                }
                            }
                        });
                    };

                    reader.onerror = () => {
                        NotificationSystem.show('error', 'Upload Error', 'Failed to process image');
                    };

                    reader.readAsDataURL(file);
                });
            }
        }

        setupImagePreview('profile_picture', 'profile_picture_container');
        setupImagePreview('mobile_profile_picture', 'mobile_profile_picture_container', true);
        setupImagePreview('desktop_profile_picture', 'desktop_profile_picture_container');

        // Click handlers for profile picture containers
        document.querySelectorAll('.profile-picture-container, .mobile-profile-picture').forEach(container => {
            container.addEventListener('click', function() {
                let fileInput;
                if (this.id === 'mobile_profile_picture_container') {
                    fileInput = document.getElementById('mobile_profile_picture');
                } else if (this.id === 'desktop_profile_picture_container') {
                    fileInput = document.getElementById('desktop_profile_picture');
                } else {
                    fileInput = document.getElementById('profile_picture');
                }
                if (fileInput) fileInput.click();
            });
        });

        function setupRemovePhoto(btnId, containerId, isMobile = false) {
            const btn = document.getElementById(btnId);
            const container = document.getElementById(containerId);

            if (btn && container) {
                btn.addEventListener('click', function() {
                    if (confirm('Are you sure you want to remove your profile picture?')) {
                        const defaultAvatarHTML = isMobile ?
                            '<div class="mobile-default-avatar"><i class="fas fa-user-circle"></i></div>' :
                            '<div class="default-avatar"><i class="fas fa-user-circle"></i><div class="avatar-text"><span>No Profile Picture</span><small>Click to upload</small></div></div>';

                        container.innerHTML = defaultAvatarHTML;

                        // Clear all file inputs
                        ['profile_picture', 'mobile_profile_picture', 'desktop_profile_picture'].forEach(inputId => {
                            const input = document.getElementById(inputId);
                            if (input) input.value = '';
                        });

                        NotificationSystem.show('info', 'Photo Removed', 'Profile picture has been removed');
                    }
                });
            }
        }

        setupRemovePhoto('removePhotoBtn', 'profile_picture_container');
        setupRemovePhoto('desktopRemovePhotoBtn', 'desktop_profile_picture_container');

        // Mobile cancel button
        const mobileCancelBtn = document.querySelector('.mobile-bottom-bar .cancel-btn');
        if (mobileCancelBtn) {
            mobileCancelBtn.addEventListener('click', function(e) {
                e.preventDefault();
                profileForm.reset();
                updateCharCount();
                NotificationSystem.show('info', 'Form Reset', 'All changes have been discarded');
            });
        }

        // Desktop cancel button
        const desktopCancelBtn = document.querySelector('.btn-cancel[type="reset"]');
        if (desktopCancelBtn) {
            desktopCancelBtn.addEventListener('click', function(e) {
                e.preventDefault();
                profileForm.reset();
                updateCharCount();
                NotificationSystem.show('info', 'Form Reset', 'All changes have been discarded');
            });
        }

        // Mobile back button
        const mobileBackBtn = document.querySelector('.mobile-back-btn');
        if (mobileBackBtn) {
            mobileBackBtn.addEventListener('click', function(e) {
                // Check for unsaved changes
                let hasChanges = false;
                const formData = new FormData(profileForm);
                const originalData = {
                    name: '{{ $user->name }}',
                    phone: '{{ $user->profile->phone ?? "" }}',
                    address: '{{ $user->profile->address ?? "" }}',
                    bio: '{{ $user->profile->bio ?? "" }}'
                };

                if (formData.get('name') !== originalData.name ||
                    formData.get('phone') !== originalData.phone ||
                    formData.get('address') !== originalData.address ||
                    formData.get('bio') !== originalData.bio ||
                    (document.getElementById('profile_picture') && document.getElementById('profile_picture').files.length > 0)) {
                    hasChanges = true;
                }

                if (hasChanges && !confirm('You have unsaved changes. Are you sure you want to leave?')) {
                    e.preventDefault();
                }
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

                        const mobileProfileName = document.querySelector('.mobile-profile-info h2');
                        if (mobileProfileName) {
                            mobileProfileName.textContent = profile.name || '';
                        }

                        updateCharCount();
                    }
                }
            } catch (err) {
                console.error('Error loading profile:', err);
            }
        }

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

            // Load profile data
            loadProfile();

            // Handle keyboard on mobile
            const inputs = document.querySelectorAll('input, textarea');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    // Scroll input into view on mobile
                    if (window.innerWidth <= 768) {
                        setTimeout(() => {
                            this.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }, 300);
                    }
                });
            });

            // Prevent zoom on input focus for mobile
            document.addEventListener('touchstart', function(e) {
                if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA' || e.target.tagName === 'SELECT') {
                    document.documentElement.style.zoom = "100%";
                }
            }, { passive: true });
        });

        // Form field focus effects
        document.querySelectorAll('.form-group input, .form-group textarea').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });

            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('focused');
            });
        });

        // Handle orientation change
        let portrait = window.matchMedia("(orientation: portrait)");
        portrait.addEventListener("change", function(e) {
            // Force reflow on orientation change
            document.body.style.display = 'none';
            document.body.offsetHeight;
            document.body.style.display = '';
        });
    </script>
</body>
</html>
