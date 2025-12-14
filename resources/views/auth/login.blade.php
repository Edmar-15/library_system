<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LibrarySystem | Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <header>
        <h1>Library System</h1>
    </header>

    <main>
        <form action="{{ route('login') }}" method="POST" class="form-container" id="loginForm">
            @csrf

            <div class="container">
                <!-- Left Side -->
                <div class="white-back">
                    <div class="emoji">📚</div>
                    <div class="title">Welcome Back!</div>
                    <div class="description">
                        Continue your reading journey. Access your personal library, saved books,
                        and reading progress. We're glad to have you back!
                    </div>
                </div>

                <!-- Right Side -->
                <div class="orange-back">
                    <label for="EM" id="lbl1">Enter Email</label>
                    <input type="email" id="EM" name="email" value="{{ old('email') }}" required
                           placeholder="your.email@example.com">

                    <label for="PASS">Enter Password</label>
                    <input type="password" id="PASS" name="password" required
                           placeholder="Enter your password">

                    <a href="{{ route('password.request') }}" id="F">Forgot password?</a>

                    <button id="btn" type="submit">Login</button>

                    <div class="or-divider">
                        <span>Don't have an account?</span>
                    </div>

                    <a href="{{ route('show.register') }}" class="create-account-btn" id="createAccountBtn">
                        Create Account
                    </a>

                    <!-- Error Messages -->
                    @if ($errors->any())
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </form>
    </main>

    <footer>
        © 2025 LibrarySystem.
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.getElementById('loginForm');
            const loginBtn = document.getElementById('btn');
            const createAccountBtn = document.getElementById('createAccountBtn');
            const inputs = document.querySelectorAll('input[type="email"], input[type="password"]');
            const container = document.querySelector('.container');
            const headerTitle = document.querySelector('header h1');
            const emoji = document.querySelector('.emoji');

            // ripple effect function
            function createRipple(e, button, color = 'rgba(255, 255, 255, 0.6)') {
                const ripple = document.createElement('span');
                const rippleClass = button.classList.contains('create-account-btn')
                    ? 'create-account-ripple'
                    : 'ripple';

                ripple.classList.add(rippleClass);

                const rect = button.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;

                ripple.style.cssText = `
                    position: absolute;
                    width: ${size}px;
                    height: ${size}px;
                    left: ${x}px;
                    top: ${y}px;
                    background: ${color};
                    border-radius: 50%;
                    transform: scale(0);
                    pointer-events: none;
                `;

                button.appendChild(ripple);

                setTimeout(() => {
                    ripple.style.transform = 'scale(3)';
                    ripple.style.opacity = '0';
                    ripple.style.transition = 'transform 0.6s ease-out, opacity 0.6s ease-out';
                }, 10);

                setTimeout(() => {
                    if (ripple.parentNode === button) {
                        button.removeChild(ripple);
                    }
                }, 600);
            }

            // Button click animation
            if (loginBtn) {
                loginBtn.addEventListener('click', function(e) {
                    createRipple(e, this);
                });

                // Button hover effects
                loginBtn.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-3px)';
                });

                loginBtn.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });

                // Button focus
                loginBtn.addEventListener('focus', function() {
                    this.style.boxShadow = '0 0 0 3px rgba(232, 153, 58, 0.3)';
                });

                loginBtn.addEventListener('blur', function() {
                    this.style.boxShadow = '0 5px 20px rgba(0, 0, 0, 0.15)';
                });
            }

            // Create Account button
            if (createAccountBtn) {
                createAccountBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    createRipple(e, this, 'rgba(232, 153, 58, 0.4)');

                    this.style.transform = 'scale(0.98)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 150);

                    // Navigate after animation
                    setTimeout(() => {
                        window.location.href = this.href;
                    }, 400);
                });

                // Create Account button hover effects
                createAccountBtn.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-3px)';
                    this.style.boxShadow = '0 8px 25px rgba(232, 153, 58, 0.4)';
                });

                createAccountBtn.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = '0 4px 15px rgba(0, 0, 0, 0.2)';
                });

                // Keyboard navigation
                createAccountBtn.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        this.click();
                    }
                });
            }

            // Input field animations
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.style.transform = 'translateY(-2px)';
                });

                input.addEventListener('blur', function() {
                    this.style.transform = 'translateY(0)';
                });
            });

            // Container hover effect
            if (container) {
                container.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });

                container.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            }

            // Header hover effect
            if (headerTitle) {
                headerTitle.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                });

                headerTitle.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            }

            // Emoji hover animation
            if (emoji) {
                emoji.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.1) rotate(5deg)';
                });

                emoji.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1) rotate(0deg)';
                });
            }

            // Forgot password link animation
            const forgotLink = document.getElementById('F');
            if (forgotLink) {
                forgotLink.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(3px)';
                });

                forgotLink.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0)';
                });
            }

            // Form submission animation
            if (loginForm) {
                loginForm.addEventListener('submit', function(e) {
                    // Check if form is valid
                    const email = document.getElementById('EM');
                    const password = document.getElementById('PASS');

                    if (!email.value || !password.value) {
                        e.preventDefault();
                        if (!email.value) {
                            email.style.animation = 'shake 0.5s ease';
                            setTimeout(() => email.style.animation = '', 500);
                        }
                        if (!password.value) {
                            password.style.animation = 'shake 0.5s ease';
                            setTimeout(() => password.style.animation = '', 500);
                        }
                    }
                });
            }

            const style = document.createElement('style');
            style.textContent = `
                .emoji {
                    transition: all 0.3s ease;
                }

                header h1 {
                    transition: transform 0.3s ease;
                }

                .container {
                    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                }

                input, button, a {
                    transition: all 0.3s ease;
                }

                #F {
                    transition: all 0.3s ease;
                }

                .create-account-btn {
                    display: block;
                    width: 100%;
                    max-width: 400px;
                    text-align: center;
                    margin-top: 0.5rem;
                    position: relative;
                    overflow: hidden;
                }

                .or-divider {
                    color: white;
                    text-align: center;
                    margin: 1.5rem 0 0.5rem 0;
                    font-size: 0.9rem;
                    opacity: 0.9;
                    width: 100%;
                    max-width: 400px;
                }

                .or-divider span {
                    position: relative;
                    padding: 0 1rem;
                    background: linear-gradient(135deg, #e8993a 0%, #d68825 100%);
                }

                .or-divider span::before,
                .or-divider span::after {
                    content: '';
                    position: absolute;
                    top: 50%;
                    width: 40%;
                    height: 1px;
                    background: rgba(255, 255, 255, 0.4);
                }

                .or-divider span::before {
                    right: 100%;
                }

                .or-divider span::after {
                    left: 100%;
                }

                @media (max-width: 768px) {
                    .create-account-btn {
                        max-width: 100%;
                    }

                    .or-divider {
                        max-width: 100%;
                    }
                }
            `;
            document.head.appendChild(style);

            // Auto-focus first input
            setTimeout(() => {
                const firstInput = document.getElementById('EM');
                if (firstInput) {
                    firstInput.focus();
                }
            }, 400);
        });
    </script>
</body>
</html>
