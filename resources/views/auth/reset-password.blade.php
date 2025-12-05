<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
</head>
<body>
    <header>
        <h1>Library System</h1>
    </header>

<div class="reset-wrapper">
    <div class="reset-card">

        <div class="left-box"></div>

        <div class="right-box">
            <h2>Forgot Password?</h2>
            <p>Enter your new password</p>

            <form action="{{ route('password.update') }}" method="POST">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <!-- <input type="email" name="email" placeholder="Email">
                @error('email') <p class="error">{{ $message }}</p> @enderror -->

                <input type="password" name="password" placeholder="New Password">
                @error('password') <p class="error">{{ $message }}</p> @enderror

                <input type="password" name="password_confirmation" placeholder="Confirm Password">

                <button type="submit">Reset Password</button>
            </form>
        </div>

    </div>
</div>
<footer>
        <p>&copy; {{ date('Y') }} LibrarySystem.</p>
    </footer>

</body>
</html>
