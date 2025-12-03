<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LibrarySystem</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <h1>LibrarySystem</h1>
        <nav>
            <a href="{{ route('show.register') }}">Register</a>
            <a href="{{ route('show.login') }}">Login</a>
        </nav>
    </header>
</body>
</html>
<script src="{{ asset('js/sample.js') }}"></script>