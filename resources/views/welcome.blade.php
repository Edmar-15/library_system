<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LibrarySystem</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <h1>LibrarySystem</h1>
    </header>

    <div class="container">
        <div class="card-wrapper">
            <div class="left-panel">
                <div class="library-icon">📚</div>
                <div class="welcome-title">Welcome to Our Digital Library</div>
                <p class="welcome-description">
                    Access thousands of books, journals, and resources from anywhere, anytime.
                    Join our community of readers and learners today.
                </p>
            </div>

            <div class="welcome-card">
                <h1>Welcome Back!</h1>
                <p class="subtitle">
                    Sign in to access your personal library, continue reading,
                    or register to explore our vast collection of resources.
                </p>

                <nav>
                    <a href="{{ route('show.register') }}" class="register-btn">Register</a>
                    <a href="{{ route('show.login') }}" class="login-btn">Login</a>
                </nav>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} LibrarySystem.</p>
    </footer>
</body>
</html>
<script src="{{ asset('js/sample.js') }}"></script>
