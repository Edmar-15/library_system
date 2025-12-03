<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/forgot.css') }}">
</head>
<body>
<!--tinanggal ko yung h2 rito-->

@if(session('status'))
    <p>{{ session('status') }}</p>
@endif
<!--simula bago-->
<div class="container"> 
    <div class="card-wrapper"> 

        <!-- Left white curved box-->
        <div class="left-panel"></div>

        <!-- Orange box -->
        <div class="forgot-card">
            <h2>Forgot password?</h2>
            <p class="subtitle">Don’t worry we got you covered</p>


            <form action="{{ route('password.email') }}" method="POST">
                @csrf

               
                <div class="input-wrapper">
                    <input type="email" name="email" placeholder="Enter email : example@gmail.com">

                  
                    <span class="close-btn">✖</span>
                </div>

                @error('email')
                    <p>{{ $message }}</p>
                @enderror

                
                <p class="try-way">Try another way?</p>

                
                <button type="submit" class="confirm-btn">Confirm</button>
            </form>

        </div> <!-- End orange card -->

    </div> <!-- End card wrapper -->
</div>
<!--end-->

</body>
</html>