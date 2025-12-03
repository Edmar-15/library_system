<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LibrarySystem | Home</title>
</head>
<body>
    <header>
        <h1>Dashboard</h1>
        <nav>
            <form action="{{ route('logout') }}" method="POST" class="m-0 logout">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </nav>
    </header>
    <main>
        <h1>Welcome, {{ Auth::user()->name }}</h1>
    </main>
</body>
</html>