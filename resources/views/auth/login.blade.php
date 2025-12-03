<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LibrarySystem | Login</title>
</head>
<body>
    <header>
        <h1>Login</h1>
        <nav>
            <a href="/">Home</a>
        </nav>
    </header>
    <main>
        <form action="{{ route('login') }}" method="POST" class="form-container">
            @csrf
            <div class="form-group">
                <label for="email">Email: </label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <label for="password">Password: </label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <button type="submit">Login</button>
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