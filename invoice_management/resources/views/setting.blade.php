@extends('layouts.app')

@section('content')
<!-- Main content area -->
<main role="main" class="content setting ml-sm-auto  px-4">
    @if(session()->has('error'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ session()->get('error') }}
    </div>
    @endif
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
    <!-- Main content goes here -->
    <div class="container ">
        <div class="title pt-3 mb-4 d-inline-block ">
            <h1 class="mb-5 text-light text-center border-0 fw-semibold">Change Password</h1>

        </div>
        <div class="row justify-content-start">
            <div class="col-9 col-md-7 mx-auto">
                <div class="form-group">
                    <form action="{{ route('update-password') }}" method="POST">
                        @csrf
                        <label for="currentPassword" class="password">Current Password</label>
                        <input name="currentPassword" class="form-control m-1" id="currentPassword" type="password" placeholder="Current Password" required>

                        <label for="newPassword" class="password" style="padding-top: 20px;">New Password</label>
                        <input name="newPassword" class="form-control m-1" id="newPassword" type="password" placeholder="New password" required>
                        <p class="ps-2">Your Password must be at least 8 characters long and include 1 capital letter
                            and 1
                            number</p>

                        <label for="confirmPassword" class="password">Confirm Password</label>
                        <input name="newPassword_confirmation" class="form-control m-1" id="confirmPassword" type="password" placeholder="Confirm password" required>



                        <input type="submit" value="Change Password" style="margin-bottom: 0;" class="submit">
                        <!-- <button class="btn-1 btn-light" type="button">Back</button> -->
                    </form>
                </div>

            </div>


        </div>
    </div>
</main>
@endsection