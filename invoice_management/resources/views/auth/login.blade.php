<!DOCTYPE html>
<html>
<title> Login Page </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('public/css/style.css') }}">

<body>
    <section class="login-form ">
        <!-- <div class="overlay"> -->
        <div class="overlay pb-4">
            <!-- </div> -->
            <div class="container">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <img src="{{ asset('public/images/logo1.png') }}" class="logo" alt="logo">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-9 col-md-7  mx-auto">
                            <div class="form-group">
                                <x-text-input id="email" class="form-control" placeholder="Enter your Email Id" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <x-text-input id="password" class="form-control" type="password" name="password" required placeholder="Enter your password" autocomplete="current-password" />

                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-between rem-for mx-auto">
                        <div class="col-6 col-md-6 d-flex justify-content-start">
                            <input type="checkbox" class="form-check-input" id="remember remember_me" name="remember">
                            <label class="form-check-label remember ps-2" for="remember">Remember Me</label>
                        </div>
                        <div class="col-6 col-md-6 d-flex justify-content-end">
                            <a class="forgot" href="{{ route('forgot') }}">Forgot Password?</a>
                        </div>

                        {{-- <button class="btn-5 mt-3" type="button">Log In</button> --}}
                        <button class="btn-5 mt-3">
                            {{ __('Log in') }}
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- <section> -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>


{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
@csrf

<!-- Email Address -->
<div>
    <x-input-label for="email" :value="__('Email')" />
    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
    <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

<!-- Password -->
<div class="mt-4">
    <x-input-label for="password" :value="__('Password')" />

    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />

    <x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>

<!-- Remember Me -->
<div class="block mt-4">
    <label for="remember_me" class="inline-flex items-center">
        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
    </label>
</div>

<div class="flex items-center justify-end mt-4">
    @if (Route::has('password.request'))
    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
        {{ __('Forgot your password?') }}
    </a>
    @endif

    <x-primary-button class="ms-3">
        {{ __('Log in') }}
    </x-primary-button>
</div>
</form>
</x-guest-layout> --}}