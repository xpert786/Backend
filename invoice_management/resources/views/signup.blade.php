<!DOCTYPE html>
<html>
<title> Login Page </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="css/style.css">

<body>
    <section class="login-form ">
        <!-- <div class="overlay"> -->
        <div class="overlay pb-4">
            <!-- </div> -->
            <div class="container">
                <img src="images/logo1.png" class="logo" alt="logo">
                <div class="row">
                    <div class="col-6 mx-auto">
                        <img src="images/crate-acc.png" class=" w-25 p-3" alt="icon">
                        <h1>Create Account</h1>
                    </div>
                </div>
                <form action="{{ route('user.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-6 mx-auto mt-4 mb-2">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="text" name="username" class="form-control my-3" placeholder="Username" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" name="email" class="form-control my-3" placeholder="Enter your Email Id" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="password" name="password" class="form-control my-3" placeholder="Enter your password" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="password" name="confirm-password" class="form-control my-3" placeholder="Confirm password" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-between w-50 mx-auto">
                        <div class="col-6 d-flex justify-content-start mb-4">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label remember ps-2" for="remember">Remember Me</label>
                        </div>

                        <input type="submit" class="btn-5 mt-3" value="Create account">
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- <section> -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>