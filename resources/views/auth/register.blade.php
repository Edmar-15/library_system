<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibrarySystem | Register</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
    {{-- <header>
        <h1>Register</h1>
        <nav>
            <a href="/">Home</a>
        </nav>
    </header> --}}
    <main>
        <form action="{{ route('register') }}" method="POST" class="form-container">
            @csrf
            {{-- <div class="form-group">
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
            </div> --}}

            <div class="container">

                    <div class="white-back">
                        {{-- wala sadya ditong laman --}}
                    </div>
                
                    <div class="orange-back">
                        <h1>Register</h1>
                        <label for="name" id="lbl1">Enter Name</label>
                        <input type="text" id="name" name="name">

                        <label for="EM" id="lbl1">Enter Email</label>
                        <input type="email" id="EM" name="email">

                        <label for="password_Comfirmation">Enter password</label>
                        <input type="password" id="PASS" name="password">


                        <label for="password_Comfirmation">Re-Enter Password</label>
                        <input type="password" id="re-enter" name="password_confirmation">

                        <button id ="btn">confirm</button>
                    </div>
                    
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