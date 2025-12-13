<!-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LibrarySystem</title>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
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
<script src="{{ asset('js/book.js') }}"></script> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>LibrarySystem</title>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>
<body>
    <!-- Header -->
    <header id="header">
        <h1 id="headerTitle">Library System</h1>
    </header>

    <!-- Main Container -->
    <div id="mainContainer">
        <!-- HOME PAGE - CLOSED BOOK -->
        <div id="homePage" class="page-container active">
            <div id="book" class="book">
                <!-- Left Page - White -->
                <div class="left-page">
                    <div class="emoji">📚</div>
                    <div class="title">Welcome to Our Digital Library</div>
                    <div class="description">
                        Access thousands of books, journals, and resources from anywhere, anytime.
                        Join our community of readers and learners today.
                    </div>
                </div>

                <!-- Right Page - Orange -->
                <div class="right-page">
                    <h1>Welcome Back!</h1>
                    <div class="subtitle">
                        Sign in to access your personal library, continue reading, or register to
                        explore our vast collection of resources.
                    </div>

                    <div class="button-container">

                        <a href="{{ route('show.register') }}" class="registerBtn">Register</a>
                    <a href="{{ route('show.login') }}" class="loginBtn">Login</a>
                    <!-- <button id="registerBtn" class="btn btn-primary" data-link="{{ route('show.register') }}">
                            Register
                        </button>
                        <button id="loginBtn" class="btn btn-secondary" data-link="{{ route('show.login') }}">
                            Login
                        </button> -->


                    </div>
                </div>

                <!-- Book Spine -->
                <div class="book-spine"></div>
            </div>
        </div>

            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        © 2025 LibrarySystem.
    </footer>

    <script src="{{ asset('js/book.js') }}"></script>
</body>
</html>
