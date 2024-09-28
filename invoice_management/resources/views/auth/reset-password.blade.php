<!DOCTYPE html>
<html>
<title> Reset Password </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('public/css/style.css')}}">

<body>
    <section class="login-form">
        <!-- <div class="overlay"> -->
        <div class="overlay">
            <!-- </div> -->
            <div class="container">
                @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ session()->get('success') }}
                </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <img src="{{asset('public/images/logo1.png')}}" class="logo" alt="logo">
                <div class="row">
                    <div class="col-9 col-md-6  mx-auto">
                        <img src="{{asset('public/images/lock.png')}}" class="lock" alt="icon">
                        <h1>Reset Password</h1>
                        <p>Choose a new password for your account</p>
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-9 col-md-6  mx-auto">
                        <div class="form-group reset-password">
                            <form action="{{ route('password.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                <label for="email" class="password">Email</label>
                                <!-- <input name="email" :value="old('email', $request->email)" class="form-control m-1" id="email" type="email" placeholder="Email" required autofocus autocomplete="username"> -->
                                <!-- <x-input-label for="email" :value="__('Email')" /> -->
                                <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />

                                <label for="password" class="email">New Password</label>
                                <input name="password" class="form-control my-2" id="password" type="password" placeholder="Enter Password" required autocomplete="new-password">
                                <span class="char mb-1">* Your Password must be at least 8 characters long and include 1
                                    capital letter and 1 number</span>

                                <label for="confirmPassword" class="email" style="padding-top: 20px;">Confirm Password</label>
                                <input name="password_confirmation" class="form-control m-0" id="password_confirmation" type="password" placeholder="Enter Password" required autocomplete="new-password">
                                <x-input-error :messages="$errors->get('password_confirmation')" class="" />

                                <input type="submit" value="Reset Password" class="submit">
                            </form>
                        </div>
                        <button class="btn-1 btn-light mb-4" type="button"><a href="{{ route('login') }}">Back To Log In</a></button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <section> -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>

