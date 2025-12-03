<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibrarySystem | Register</title>
</head>
<body>
    <header>
        <h1>Register</h1>
        <nav>
            <a href="/">Home</a>
        </nav>
    </header>
    <main>
        <form action="{{ route('register') }}" method="POST" class="form-container">
            @csrf
            <div class="form-group">
                <label for="name">Username: </label>
                <input type="name" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email: </label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <label for="password">Password: </label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <label for="password_comfirmation">Confirm Password: </label>
                <input type="password" name="password_confirmation" id="password" required>
            </div>
            <div class="form-group">
                <button type="submit">Register</button>
            </div>
        </form>

        @if ($errors->any())
            <ul style="padding: 8px 16px; background-color: ffe2e2;">
                @foreach ($errors->all() as $error)
                    <li style="color: red;">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </main>
</body>
</html>