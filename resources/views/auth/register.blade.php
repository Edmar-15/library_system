<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibrarySystem | Register</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
    <header>
        <h1>LibrarySystem</h1>
    </header>
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
            </div>  --}}
    
            <div class="container">

                    <div class="white-back">
                        
                    </div>
                
                    <div class="orange-back">
                        <h1 id="Title">Register</h1>
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
                            <button id = "btn" type="submit">Register</button>
                        </div> 
                        {{-- <h1>Register</h1>
                        <label for="EM" id="lbl1">Enter Email</label>
                        <input type="email" id="EM">

                        <label for="PASS">Enter password</label>
                        <input type="password" id="PASS">


                        <label for="re-enter">Re-Enter Password</label>
                        <input type="password" id="re-enter">

                        <button id ="btn">confirm</button> --}}
                    </div>
            </div>
            <footer class="dashboard-footer">
                    <div class="copyright">
                        &copy; {{ date('Y') }} LibrarySystem.
                    </div>
                    </div>
                </footer>
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