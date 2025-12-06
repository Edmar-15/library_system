<!-- <!-- <!DOCTYPE html>
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
        <h1 id="headerTitle">LibrarySystem</h1>
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
                        <button id="registerBtn" class="btn btn-primary" data-link="register">
                            Register
                        </button>
                        <button id="loginBtn" class="btn btn-secondary" data-link="login">
                            Login
                        </button>
                    </div>
                </div>

                <!-- Book Spine -->
                <div class="book-spine"></div>
            </div>
        </div>

        <!-- LOGIN PAGE - OPEN BOOK -->
        <div id="loginPage" class="page-container">
            <div class="book open">
                <!-- Left Page - White -->
                <div class="left-page">
                    <div class="emoji">📖</div>
                    <div class="form-title">
                        Enter your credentials to access your library
                    </div>
                </div>

                <!-- Right Page - Orange with Form -->
                <div class="right-page">
                    <form id="loginForm" action="{{ route('login') }}" method="POST">
                        @csrf
                        <label>Enter Email</label>
                        <input type="email" id="loginEmail" name="email" required>
                        <span class="error-message" id="loginEmailError"></span>

                        <label>Enter password</label>
                        <input type="password" id="loginPassword" name="password" required>
                        <span class="error-message" id="loginPasswordError"></span>

                        <a href="#" id="forgotPasswordLink" class="forgot-link">Forgot password?</a>

                        <button type="submit" class="btn btn-submit">Login</button>

                        <p class="account-text">
                            Don't have an account? 
                            <a href="#" id="toRegisterLink" class="create-link">create account</a>
                        </p>

                        <div class="divider">
                            <span class="divider-line"></span>
                            Or log in with
                            <span class="divider-line"></span>
                        </div>
                    </form>
                </div>

                <!-- Book Spine -->
                <div class="book-spine"></div>
            </div>
        </div>

        <!-- REGISTER PAGE - OPEN BOOK -->
        <div id="registerPage" class="page-container">
            <div class="book open">
                <!-- Left Page - White -->
                <div class="left-page">
                    <div class="emoji">✍️</div>
                    <div class="form-title">
                        Create your account and start your reading journey
                    </div>
                </div>

                <!-- Right Page - Orange with Form -->
                <div class="right-page">
                    <h1>Register</h1>
                    <form id="registerForm">
                        @csrf
                        <label>Enter Email</label>
                        <input type="email" id="registerEmail" name="email" required>
                        <span class="error-message" id="registerEmailError"></span>

                        <label>Enter password</label>
                        <input type="password" id="registerPassword" name="password" required>
                        <span class="error-message" id="registerPasswordError"></span>

                        <label>Re-Enter Password</label>
                        <input type="password" id="confirmPassword" name="password_confirmation" required>
                        <span class="error-message" id="confirmPasswordError"></span>

                        <button type="submit" class="btn btn-submit">confirm</button>
                    </form>
                </div>

                <!-- Book Spine -->
                <div class="book-spine"></div>
            </div>
        </div>

        <!-- FORGOT PASSWORD PAGE - OPEN BOOK -->
        <div id="forgotPage" class="page-container">
            <div class="book open">
                <!-- Left Page - White -->
                <div class="left-page">
                    <div class="emoji">🔑</div>
                    <div class="form-title">
                        We'll help you recover your account
                    </div>
                </div>

                <!-- Right Page - Orange with Form -->
                <div class="right-page">
                    <h1>Forgot password?</h1>
                    <p class="subtitle">Don't worry we got you covered</p>
                    
                    <form id="forgotForm">
                        @csrf
                        <div class="input-wrapper">
                            <input 
                                type="email" 
                                id="forgotEmail" 
                                name="email" 
                                placeholder="Enter email - example@gmail.com"
                                required
                            >
                            <span class="clear-btn">✕</span>
                        </div>
                        <span class="error-message" id="forgotEmailError"></span>

                        <div class="forgot-actions">
                            <a href="#" id="tryAnotherWay" class="another-way-link">Try another way?</a>
                            <button type="submit" class="btn btn-submit">Confirm</button>
                        </div>
                    </form>
                </div>

                <!-- Book Spine -->
                <div class="book-spine"></div>
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
