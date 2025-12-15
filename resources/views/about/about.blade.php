<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>About Us - Library System</title>
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <!-- Header -->
    <header class="dashboard-header">
    <div class="logo-section">
      <div class="logo-icon">📚</div>
      <div class="logo-text">LibrarySystem</div>
    </div>


        @if (auth()->user()->role === 'librarian')
            <div class="auth-section">
                <a href="{{ route('about.edit') }}" class="auth-btn edit-btn">
                    <i class="fas fa-edit"></i> Edit About
                </a>
            </div>
        @endif
        
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
                        <a href="{{ route('show.about') }}" class="nav-link active" title="About">
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
                    @if (auth()->user()->role === 'librarian')
                        <li class="nav-item">
                            <a href="{{ route('about.edit') }}" class="nav-link" title="Edit About">
                                <i class="fas fa-edit nav-icon"></i>
                                <span class="nav-text">Edit About</span>
                            </a>
                        </li>
                    @endif
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
                <h1 class="page-title">About LibrarySystem</h1>
                <p class="page-subtitle">
                    Learn more about our mission, vision, features, and the team behind our library management system.
                </p>
            </div>

            <!-- Loading State -->
            <div id="loading" class="loading-card">
                <div class="spinner"></div>
                <p>Loading about page...</p>
            </div>

            <!-- Content Container (Hidden initially) -->
            <div id="content" style="display: none;">
                <!-- Title Section -->
                <section class="content-card">
                    <h2><i class="fas fa-info-circle"></i> About Our Library System</h2>
                    <p class="page-title" id="pageTitle">Library Management System</p>
                    <div class="card-content" id="descriptionSection" style="display: none;">
                        <p class="about-description" id="description"></p>
                    </div>
                </section>

                <!-- Mission & Vision -->
                <div class="content-grid">
                    <div class="content-card" id="missionBox" style="display: none;">
                        <h2><i class="fas fa-bullseye"></i> Our Mission</h2>
                        <div class="card-content">
                            <p class="mission-text" id="mission"></p>
                        </div>
                    </div>

                    <div class="content-card" id="visionBox" style="display: none;">
                        <h2><i class="fas fa-eye"></i> Our Vision</h2>
                        <div class="card-content">
                            <p class="vision-text" id="vision"></p>
                        </div>
                    </div>
                </div>

                <!-- System Features -->
                <section class="content-card" id="featuresSection" style="display: none;">
                    <h2><i class="fas fa-cogs"></i> System Features</h2>
                    <div class="card-content">
                        <p class="features-text" id="features"></p>
                    </div>
                </section>

                <!-- Logo/Image -->
                <section class="content-card" id="logoSection" style="display: none;">
                    <h2><i class="fas fa-image"></i> Our Logo</h2>
                    <div class="card-content text-center">
                        <img id="logoImage" src="" alt="Library Logo" class="about-logo">
                    </div>
                </section>

                <!-- Developer Team -->
                <section class="content-card" id="teamSection" style="display: none;">
                    <h2><i class="fas fa-users"></i> Development Team</h2>
                    <div class="card-content">
                        <div class="team-grid" id="teamGrid"></div>
                    </div>
                </section>

                <!-- Contact Information -->
                <section class="content-card" id="contactSection" style="display: none;">
                    <h2><i class="fas fa-envelope"></i> Contact Us</h2>
                    <div class="card-content">
                        <div class="contact-info" id="contactInfo"></div>
                    </div>
                </section>
            </div>

            <!-- Error State -->
            <div id="error" class="error-card" style="display: none;">
                <h2><i class="fas fa-exclamation-triangle"></i> Error Loading Content</h2>
                <div class="card-content">
                    <p id="errorMessage">Unable to load about page. Please try again later.</p>
                </div>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="dashboard-footer">
        <div class="copyright">
            &copy; <span id="currentYear"></span> LibrarySystem.
        </div>
    </footer>

    <script>
        // Set current year
        document.getElementById('currentYear').textContent = new Date().getFullYear();

        // Fetch about data when page loads
        document.addEventListener('DOMContentLoaded', function() {
            fetchAboutData();
        });

        async function fetchAboutData() {
            const loading = document.getElementById('loading');
            const content = document.getElementById('content');
            const error = document.getElementById('error');

            try {
                const response = await fetch('{{ route('api.about.data') }}');
                const result = await response.json();

                if (!response.ok || !result.success) {
                    throw new Error(result.message || 'Failed to fetch data');
                }

                const data = result.data;

                // Hide loading, show content
                loading.style.display = 'none';
                content.style.display = 'block';

                // Populate data
                populateAboutData(data);

            } catch (err) {
                console.error('Error fetching about data:', err);
                loading.style.display = 'none';
                error.style.display = 'block';
                document.getElementById('errorMessage').textContent = err.message;
            }
        }

        function populateAboutData(data) {
            // Title
            if (data.title) {
                document.getElementById('pageTitle').textContent = data.title;
            }

            // Description
            if (data.description) {
                document.getElementById('description').textContent = data.description;
                document.getElementById('descriptionSection').style.display = 'block';
            }

            // Mission
            if (data.mission) {
                document.getElementById('mission').textContent = data.mission;
                document.getElementById('missionBox').style.display = 'block';
            }

            // Vision
            if (data.vision) {
                document.getElementById('vision').textContent = data.vision;
                document.getElementById('visionBox').style.display = 'block';
            }

            // Features
            if (data.features) {
                document.getElementById('features').textContent = data.features;
                document.getElementById('featuresSection').style.display = 'block';
            }

            // Logo/Image
            if (data.image) {
                document.getElementById('logoImage').src = data.image;
                document.getElementById('logoSection').style.display = 'block';
            }

            // Developer Info
            if (data.developer_name) {
                const teamGrid = document.getElementById('teamGrid');

                if (typeof data.developer_name === 'string') {
                    teamGrid.innerHTML = `
                        <div class="team-member-card">
                            <p class="member-name"><strong><i class="fas fa-user"></i> Name:</strong> ${data.developer_name}</p>
                            ${data.developer_role ? `<p class="member-role"><strong><i class="fas fa-briefcase"></i> Role:</strong> ${data.developer_role}</p>` : ''}
                            ${data.developer_email ? `<p class="member-email"><strong><i class="fas fa-envelope"></i> Email:</strong> <a href="mailto:${data.developer_email}" class="email-link">${data.developer_email}</a></p>` : ''}
                        </div>
                    `;
                }
                else if (Array.isArray(data.developer_name)) {
                    let html = '';
                    data.developer_name.forEach(member => {
                        html += `
                            <div class="team-member-card">
                                <p class="member-name"><strong><i class="fas fa-user"></i> Name:</strong> ${member.name || 'N/A'}</p>
                                ${member.role ? `<p class="member-role"><strong><i class="fas fa-briefcase"></i> Role:</strong> ${member.role}</p>` : ''}
                                ${member.email ? `<p class="member-email"><strong><i class="fas fa-envelope"></i> Email:</strong> <a href="mailto:${member.email}" class="email-link">${member.email}</a></p>` : ''}
                            </div>
                        `;
                    });
                    teamGrid.innerHTML = html;
                }
                else if (typeof data.developer_name === 'object') {
                    teamGrid.innerHTML = `
                        <div class="team-member-card">
                            <p class="member-name"><strong><i class="fas fa-user"></i> Name:</strong> ${data.developer_name.name || 'N/A'}</p>
                            ${data.developer_name.role ? `<p class="member-role"><strong><i class="fas fa-briefcase"></i> Role:</strong> ${data.developer_name.role}</p>` : ''}
                            ${data.developer_name.email ? `<p class="member-email"><strong><i class="fas fa-envelope"></i> Email:</strong> <a href="mailto:${data.developer_name.email}" class="email-link">${data.developer_name.email}</a></p>` : ''}
                        </div>
                    `;
                }

                document.getElementById('teamSection').style.display = 'block';
            }

            // Contact Info
            if (data.contact_email || data.contact_phone) {
                const contactInfo = document.getElementById('contactInfo');
                let html = '';

                if (data.contact_email) {
                    html += `<p class="contact-email"><strong><i class="fas fa-envelope"></i> Email:</strong> <a href="mailto:${data.contact_email}" class="email-link">${data.contact_email}</a></p>`;
                }

                if (data.contact_phone) {
                    html += `<p class="contact-phone"><strong><i class="fas fa-phone"></i> Phone:</strong> ${data.contact_phone}</p>`;
                }

                contactInfo.innerHTML = html;
                document.getElementById('contactSection').style.display = 'block';
            }
        }

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
