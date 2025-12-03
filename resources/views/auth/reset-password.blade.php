<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h2>Reset Password</h2>

<form action="{{ route('password.update') }}" method="POST">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <input type="email" name="email" placeholder="Email">
    @error('email') <p>{{ $message }}</p> @enderror

    <input type="password" name="password" placeholder="New Password">
    @error('password') <p>{{ $message }}</p> @enderror

    <input type="password" name="password_confirmation" placeholder="Confirm Password">

    <button type="submit">Reset Password</button>
</form>

</body>
</html>