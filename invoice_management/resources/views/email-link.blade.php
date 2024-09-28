<!DOCTYPE html>
<html>

<head>
    <title> Email Link </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
</head>

<body>
    <section class="login-form">
        <!-- <div class="overlay"> -->
        <div class="overlay">
            <!-- </div> -->
            <div class="container">
                <img src="{{ asset('public/images/logo1.png') }}" class="logo" alt="logo">
                <div class="row">
                    <div class="col-9 col-md-6 mx-auto">
                        <img src="{{ asset('public/images/email.png') }}" class="mb-1 email-icon" alt="icon">
                        <h1 class="pt-3">Check Your Email</h1>
                        <p>We have sent an email with password reset information to
                            {{ session('email') }}
                        </p>
                        <p>Didn’t receive the email?</p>
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-9 col-md-6 mx-auto">
                        <div class="form-group">
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <input name="email" value="{{ session('email') }}" class="form-control m-1" id="email" type="hidden" required autofocus>

                                <input type="submit" class="submit" value="Resend Email">
                            </form>


                        </div>
                        <button class="btn-1 btn-light" type="button"><a href="{{ route('login') }}">Back To Log In</a></button>
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