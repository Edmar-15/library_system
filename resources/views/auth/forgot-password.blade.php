<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibrarySystem | Forgot Password</title>
    <link rel="stylesheet" href="{{ asset('css/forgot.css') }}">
</head>
<body>
    <header>
        <h1 id="headerTitle">Library System</h1>
    </header>

    <main id="mainContainer">
        <div class="container">
            <div class="card-wrapper">
                <!-- Left white curved box -->
                <div class="left-panel">
                    <div class="left-content">
                        <div class="lock-icon">🔐</div>
                        <h3>Secure Password Reset</h3>
                        <p class="left-description">Enter your email address and we'll send you a link to reset your password securely.</p>
                    </div>
                </div>

                <div class="forgot-card" id="card">
                    @if(session('status'))
                        <p class="success-message"><i>{{ session('status') }}</i></p>
                    @endif

                    <h2>Forgot password?</h2>
                    <p class="subtitle">Don't worry we got you covered</p>

                    <form action="{{ route('password.email') }}" method="POST">
                        @csrf

                        <div class="input-wrapper">
                            <input type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required>
                            <span class="close-btn" onclick="this.parentElement.querySelector('input').value=''">✖</span>
                        </div>

                        @error('email')
                            <p class="error-message">{{ $message }}</p>
                        @enderror

                        <a href="{{ route('login') }}" class="try-way">Remember your password? Login</a>

                        <button type="submit" class="confirm-btn">Send Reset Link</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} LibrarySystem.</p>
    </footer>

    <script>
        // Enhanced ripple effect with better mobile support
        document.querySelector('.confirm-btn').addEventListener('click', function(e) {
            createRipple(e, this);
        });

        function createRipple(event, element) {
            // For touch devices
            if (event.type === 'touchstart') {
                event.preventDefault();
                const touch = event.touches[0];
                event.clientX = touch.clientX;
                event.clientY = touch.clientY;
            }

            const ripple = document.createElement('span');
            const rect = element.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = event.clientX - rect.left - size / 2;
            const y = event.clientY - rect.top - size / 2;

            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('ripple');

            // Remove any existing ripples
            const existingRipples = element.querySelectorAll('.ripple');
            existingRipples.forEach(r => r.remove());

            element.appendChild(ripple);

            setTimeout(() => {
                ripple.remove();
            }, 600);
        }

        // Add touch support for mobile
        document.querySelector('.confirm-btn').addEventListener('touchstart', function(e) {
            createRipple(e, this);
        }, { passive: false });
    </script>
</body>
</html>
