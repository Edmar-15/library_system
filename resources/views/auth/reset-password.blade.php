<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibrarySystem | Reset Password</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
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
                        <div class="lock-icon">🔑</div>
                        <h3>Set New Password</h3>
                        <p class="left-description">Create a strong new password for your account. Make sure it's secure and easy to remember.</p>
                    </div>
                </div>

                <div class="reset-card" id="card">
                    @if(session('status'))
                        <p class="success-message"><i>{{ session('status') }}</i></p>
                    @endif

                    <h2>Reset Password</h2>
                    <p class="subtitle">Enter your new password below</p>

                    <form action="{{ route('password.update') }}" method="POST">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="input-wrapper">
                            <input type="email" value="{{ $email }}" disabled class="email-disabled">
                            <input type="hidden" name="email" value="{{ $email }}">
                        </div>

                        <div class="input-wrapper">
                            <input type="password" name="password" placeholder="New Password" required>
                            <span class="toggle-password" onclick="togglePassword(this)">👁️</span>
                        </div>
                        @error('password')
                            <p class="error-message">{{ $message }}</p>
                        @enderror

                        <div class="input-wrapper">
                            <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                            <span class="toggle-password" onclick="togglePassword(this)">👁️</span>
                        </div>

                        <button type="submit" class="confirm-btn">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} LibrarySystem.</p>
    </footer>

    <script>
        // Ripple effect for button
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

        // Toggle password visibility
        function togglePassword(element) {
            const input = element.parentElement.querySelector('input');
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            element.textContent = type === 'password' ? '👁️' : '🙈';
        }
    </script>
</body>
</html>
