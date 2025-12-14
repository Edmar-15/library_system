<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibrarySystem | Register</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
    <header>
        <h1>Library System</h1>
    </header>

    <main>
        <div class="form-container">
            <div class="container">
                <!-- Left Page -->
                <div class="white-back">
                    <div class="emoji">📚</div>
                    <div class="title">Join Our Digital Library</div>
                    <div class="description">
                        Create your account to access thousands of books, journals,
                        and resources. Start your reading journey today!
                    </div>
                </div>

                <!-- Right Page -->
                <div class="orange-back">
                    <h1>Register</h1>

                    <form action="{{ route('register') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="name">Username</label>
                            <input type="text" name="name" id="name" placeholder="Enter your username" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" placeholder="Enter your email" value="{{ old('email') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" placeholder="Enter your password" required>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm your password" required>
                        </div>

                        <div class="button-container">
                            <button id="btn" type="submit">Create Account</button>
                            <a href="{{ route('login') }}" class="login-link">Already have an account? Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} LibrarySystem.</p>
    </footer>

    <script src="{{ asset('js/register.js') }}"></script>

    @if ($errors->any())
        <div class="error-container">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>
</html>
