<head>
     <link rel="stylesheet" href="{{ asset('css/about.css') }}">
</head>
<body>
    <header class="about-header">
        <nav class="about-nav">
            <a href="{{ route('show.home') }}" class="nav-link">🏠 Home</a>
            
            @auth
                <div>
                    <a href="{{ route('about.edit') }}" class="nav-link edit-btn">✏️ Edit About Page</a>
                    <span style="background: rgba(255,255,255,0.2); padding: 5px 15px; border-radius: 5px; margin-left: 10px;">
                        👤 {{ auth()->user()->name ?? auth()->user()->email }}
                    </span>
                </div>
            @else
                <a href="{{ route('show.login') }}" class="nav-link">🔐 Login to Edit</a>
            @endauth
        </nav>
    </header>

    <main class="about-main">
        <!-- Loading State -->
        <div id="loading" class="loading">
            <div class="spinner"></div>
            <p>Loading about page...</p>
        </div>

        <!-- Content Container (Hidden initially) -->
        <div id="content" style="display: none;">
            <!-- Title Section -->
            <section class="about-title-section">
                <h1 class="about-title" id="pageTitle">About the Library System</h1>
            </section>

            <!-- Description -->
            <section class="about-description-section" id="descriptionSection" style="display: none;">
                <h2 class="section-heading">About Us</h2>
                <p class="about-description" id="description"></p>
            </section>

            <!-- Mission & Vision -->
            <section class="mission-vision-section">
                <div class="mission-box" id="missionBox" style="display: none;">
                    <h2 class="section-heading">Our Mission</h2>
                    <p class="mission-text" id="mission"></p>
                </div>

                <div class="vision-box" id="visionBox" style="display: none;">
                    <h2 class="section-heading">Our Vision</h2>
                    <p class="vision-text" id="vision"></p>
                </div>
            </section>

            <!-- System Features -->
            <section class="features-section" id="featuresSection" style="display: none;">
                <h2 class="section-heading">System Features</h2>
                <div class="features-content">
                    <p class="features-text" id="features"></p>
                </div>
            </section>

            <!-- Logo/Image -->
            <section class="logo-section" id="logoSection" style="display: none;">
                <img id="logoImage" src="" alt="Library Logo" class="about-logo">
            </section>

            <!-- Developer Team -->
            <section class="team-section" id="teamSection" style="display: none;">
                <h2 class="section-heading">Development Team</h2>
                <div class="team-grid" id="teamGrid"></div>
            </section>

            <!-- Contact Information -->
            <section class="contact-section" id="contactSection" style="display: none;">
                <h2 class="section-heading">Contact Us</h2>
                <div class="contact-info" id="contactInfo"></div>
            </section>
        </div>

        <!-- Error State -->
        <div id="error" class="error-section" style="display: none;">
            <h1>⚠️ Error Loading Content</h1>
            <p id="errorMessage">Unable to load about page. Please try again later.</p>
        </div>
    </main>

    <footer class="about-footer">
        <p class="copyright">&copy; <span id="currentYear"></span> Library System. All rights reserved.</p>
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

    // Developer Info - FIXED VERSION
    if (data.developer_name) {
        const teamGrid = document.getElementById('teamGrid');
        
        // Check if developer_name is a string (single developer)
        if (typeof data.developer_name === 'string') {
            teamGrid.innerHTML = `
                <div class="team-member-card">
                    <p class="member-name"><strong>👤 Name:</strong> ${data.developer_name}</p>
                    ${data.developer_role ? `<p class="member-role"><strong>💼 Role:</strong> ${data.developer_role}</p>` : ''}
                    ${data.developer_email ? `<p class="member-email"><strong>📧 Email:</strong> <a href="mailto:${data.developer_email}" class="email-link">${data.developer_email}</a></p>` : ''}
                </div>
            `;
        } 
        // Check if it's an array (multiple developers)
        else if (Array.isArray(data.developer_name)) {
            let html = '';
            data.developer_name.forEach(member => {
                html += `
                    <div class="team-member-card">
                        <p class="member-name"><strong>👤 Name:</strong> ${member.name || 'N/A'}</p>
                        ${member.role ? `<p class="member-role"><strong>💼 Role:</strong> ${member.role}</p>` : ''}
                        ${member.email ? `<p class="member-email"><strong>📧 Email:</strong> <a href="mailto:${member.email}" class="email-link">${member.email}</a></p>` : ''}
                    </div>
                `;
            });
            teamGrid.innerHTML = html;
        }
        // Check if it's an object (single developer as object)
        else if (typeof data.developer_name === 'object') {
            teamGrid.innerHTML = `
                <div class="team-member-card">
                    <p class="member-name"><strong>👤 Name:</strong> ${data.developer_name.name || 'N/A'}</p>
                    ${data.developer_name.role ? `<p class="member-role"><strong>💼 Role:</strong> ${data.developer_name.role}</p>` : ''}
                    ${data.developer_name.email ? `<p class="member-email"><strong>📧 Email:</strong> <a href="mailto:${data.developer_name.email}" class="email-link">${data.developer_name.email}</a></p>` : ''}
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
            html += `<p class="contact-email"><strong>📧 Email:</strong> <a href="mailto:${data.contact_email}" class="email-link">${data.contact_email}</a></p>`;
        }
        
        if (data.contact_phone) {
            html += `<p class="contact-phone"><strong>📞 Phone:</strong> ${data.contact_phone}</p>`;
        }
        
        contactInfo.innerHTML = html;
        document.getElementById('contactSection').style.display = 'block';
    }
}

        
    </script>
</body>
</html>