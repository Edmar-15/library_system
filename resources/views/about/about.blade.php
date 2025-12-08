<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibrarySystem | About</title>
</head>
<body>
    <header class="about-header">
        <nav class="about-nav">
            <a href="{{ route('show.home') }}" class="nav-link">Home</a>
            
            @auth
                <a href="{{ route('about.edit') }}" class="nav-link edit-btn">✏️ Edit About Page</a>
                <span style="background: green; color: white; padding: 5px 10px; border-radius: 5px;">Logged in as: {{ auth()->user()->name ?? auth()->user()->email }}</span>
            @else
                <a href="{{ route('show.login') }}" class="nav-link">Login to Edit</a>
            @endauth
        </nav>
    </header>

    <main class="about-main">
        @if(isset($about) && $about)
        <!-- Page Title -->
        <section class="about-title-section">
            <h1 class="about-title">{{ $about->title }}</h1>
        </section>

        <!-- Description -->
        @if($about->description)
        <section class="about-description-section">
            <h2 class="section-heading">About Us</h2>
            <p class="about-description">{{ $about->description }}</p>
        </section>
        @endif

        <!-- Mission & Vision -->
        <section class="mission-vision-section">
            @if($about->mission)
            <div class="mission-box">
                <h2 class="section-heading">Our Mission</h2>
                <p class="mission-text">{{ $about->mission }}</p>
            </div>
            @endif

            @if($about->vision)
            <div class="vision-box">
                <h2 class="section-heading">Our Vision</h2>
                <p class="vision-text">{{ $about->vision }}</p>
            </div>
            @endif
        </section>

        <!-- System Features -->
        @if($about->features)
        <section class="features-section">
            <h2 class="section-heading">System Features</h2>
            <div class="features-content">
                <p class="features-text">{{ $about->features }}</p>
            </div>
        </section>
        @endif

        <!-- Image/Logo -->
        @if($about->image)
        <section class="logo-section">
            <img src="{{ asset('storage/' . $about->image) }}" alt="Library Logo" class="about-logo">
        </section>
        @endif

        <!-- Developer Info / Team Members -->
        @if($about->developer_name)
        <section class="team-section">
            <h2 class="section-heading">Development Team</h2>
            <div class="team-grid">
                @if(is_array($about->developer_name))
                    @foreach($about->developer_name as $member)
                    <div class="team-member-card">
                        <p class="member-name"><strong>Name:</strong> {{ $member['name'] }}</p>
                        <p class="member-role"><strong>Role:</strong> {{ $member['role'] }}</p>
                        <p class="member-email"><strong>Email:</strong> <a href="mailto:{{ $member['email'] }}" class="email-link">{{ $member['email'] }}</a></p>
                    </div>
                    @endforeach
                @else
                    <p class="error-message">Developer data format issue. Please check the model casting.</p>
                @endif
            </div>
        </section>
        @endif

        <!-- Contact Information -->
        @if($about->contact_email || $about->contact_phone)
        <section class="contact-section">
            <h2 class="section-heading">Contact Us</h2>
            <div class="contact-info">
                @if($about->contact_email)
                <p class="contact-email"><strong>Email:</strong> <a href="mailto:{{ $about->contact_email }}" class="email-link">{{ $about->contact_email }}</a></p>
                @endif

                @if($about->contact_phone)
                <p class="contact-phone"><strong>Phone:</strong> {{ $about->contact_phone }}</p>
                @endif
            </div>
        </section>
        @endif
        @else
        <section class="error-section">
            <h1>About the Library System</h1>
            <p>No information available. Please contact the administrator.</p>
        </section>
        @endif
    </main>

    <footer class="about-footer">
        <p class="copyright">&copy; {{ date('Y') }} Library System. All rights reserved.</p>
    </footer>
</body>
</html>