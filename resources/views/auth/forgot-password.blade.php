<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Forgot Password</h2>

@if(session('status'))
    <p>{{ session('status') }}</p>
@endif

<form action="{{ route('password.email') }}" method="POST">
    @csrf
    <input type="email" name="email" placeholder="Enter your email">
    @error('email') <p>{{ $message }}</p> @enderror

    <button type="submit">Send Reset Link</button>
</form>
</body>
</html>