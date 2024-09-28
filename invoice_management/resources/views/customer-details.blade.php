@extends('layouts.app')

@section('content')

<!-- Main content area -->
<main role="main" class="content ml-sm-auto px-4">
    <!-- Main content goes here -->
    <div class="container-fluid">
        <div class="title pt-3 mb-4 d-inline-block d-flex justify-content-between">
            <h1>Customer Details</h1>
            <a href="{{route('customer')}}" class="back-margin"><button class="back">Back</button></a>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="row">
            @if(Auth::user()->role == 'admin')
            @foreach($user as $users)
            <form action="{{ route('user.update', ['id' => $users->id])}}" method="post">
                @csrf
                <div class="cus-details">
                    <div class="col-12">
                        <div class="row gy-4">
                            <div class="col-12 col-sm-6">
                                <h6> First Name</h6>
                                <span><input type="text" name="name" class="form-control" value="{{$users->name}}"></span>
                            </div>

                            <div class="col-12 col-sm-6">
                                <h6>Last Name</h6>
                                <span><input type="text" name="lname" class="form-control" value="{{$users->lname}}"></span>
                            </div>

                            <div class="col-12 col-sm-6">
                                <h6> Email Address</h6>
                                <span><input type="email" name="email" class="form-control" value="{{$users->email}}" readonly></span>
                            </div>

                            <div class="col-12 col-sm-6">
                                <h6> Mobile</h6>
                                @if($users->mobile)
                                @php
                                $mobile = json_decode($users->mobile);

                                $mobileValue = isset($mobile->full) ? htmlspecialchars($mobile->full) : '';

                                @endphp
                                <span><input type="tel" id="mobile" name="mobile[main]" class="form-control" value="{{$mobileValue}}"></span>
                                @else
                                <span><input type="tel" class="form-control" id="mobile" name="mobile[main]"></span>
                                @endif
                            </div>

                            <div class="col-12 col-sm-6">
                                <h6>Address</h6>
                                <span><input type="text" name="address" class="form-control" value="{{$users->address}}"></span>

                            </div>

                            <div class="col-12 col-sm-6">
                                <h6>City</h6>
                                <span><input type="text" name="city" class="form-control" value="{{$users->city}}"></span>
                            </div>

                            <div class="col-12 col-sm-6">
                                <h6>State</h6>
                                <span><input type="text" name="state" class="form-control" value="{{$users->state}}"></span>
                            </div>

                            <div class="col-12 col-sm-6">
                                <h6>Country</h6>
                                <span><input type="text" name="country" class="form-control" value="{{$users->country}}"></span>
                            </div>

                            <div class="col-12 col-sm-6">
                                <h6> Zip Code</h6>
                                <span><input type="text" name="zip_code" class="form-control" value="{{$users->zip_code}}"></span>
                            </div>

                            <h5 class="text-start fw-bold mt-5">COMPANY INFORMATION:</h5>

                            <div class="col-12 col-sm-6">
                                <h6> Company Name</h6>
                                <span><input type="text" name="company_name" class="form-control" value="{{$users->company_name}}"></span>
                            </div>

                            <div class="col-12 col-sm-6">
                                <h6> EIN/Piva Number</h6>
                                <span><input type="text" name="ein_number" class="form-control" value="{{$users->ein_number}}"></span>
                            </div>

                            <div class="col-12 col-sm-6">
                                <h6> Email</h6>
                                <span><input type="email" name="email" class="form-control" value="{{$users->email}}" readonly></span>
                            </div>

                            <div class="col-12 col-sm-6">
                                <h6> Mobile</h6>
                                @if($users->company_mobile)
                                @php
                                $mobile = json_decode($users->company_mobile);

                                $mobileValue = isset($mobile->full) ? htmlspecialchars($mobile->full) : '';

                                @endphp
                                <span><input type="tel" id="company_mobile" name="company_mobile[main]" class="form-control" value="{{$mobileValue}}"></span>
                                @else
                                <span><input type="tel" class="form-control" id="company_mobile" name="company_mobile[main]"></span>
                                @endif
                            </div>

                            <div class="col-12 col-sm-6">
                                <h6> Address</h6>
                                <span><input type="text" name="company_address" class="form-control" value="{{$users->company_address}}"></span>
                            </div>

                            <div class="col-12 col-sm-6">
                                <h6> City</h6>
                                <span><input type="text" name="company_city" class="form-control" value="{{$users->company_city}}"></span>
                            </div>

                            <div class="col-12 col-sm-6">
                                <h6> State</h6>
                                <span><input type="text" name="company_state" class="form-control" value="{{$users->company_state}}"></span>
                            </div>

                            <div class="col-12 col-sm-6">
                                <h6> Country</h6>
                                <span><input type="text" name="company_country" class="form-control" value="{{$users->company_country}}"></span>
                            </div>

                            <div class="col-12 col-sm-6">
                                <h6> Zip Code</h6>
                                <span><input type="text" name="company_zip_code" class="form-control" value="{{$users->company_zip_code}}"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5 custom-btn">
                    <div class="col-12 col-sm-9">
                        <div class="d-flex justify-content-center">
                            <!--  <button type="button" class="cancel">Cancel</button> -->
                            <input type="submit" class="save ms-3 mb-4" value="Save">
                        </div>
                    </div>
                </div>
            </form>
            @endforeach
            @else
            @foreach($customer as $customers)

            <form action="{{ route('customer.update', ['id' => $customers->id ] )}}" method="post">
                @csrf
                <div class="cus-details">
                    <div class="col-12">
                        <div class="row gy-4">
                            <div class="row gy-4 detail-bx">
                                <div class="col-12 col-sm-6">
                                    <h6> First Name</h6>
                                    <input type="text" name="fname" class="form-control" value="{{$customers->fname}}" required>
                                    <input type="hidden" name="customerId" value="{{Auth::user()->id}}" class="form-control">
                                    <input type="hidden" name="id" value="{{$customers->id}}" class="form-control">
                                </div>

                                <div class="col-12 col-sm-6">
                                    <h6>Last Name</h6>
                                    <input type="text" name="lname" value="{{$customers->lname}}" class="form-control">
                                </div>

                                <div class="col-12 col-sm-6">
                                    <h6> Email Address</h6>
                                    <input type="email" name="email" value="{{$customers->email}}" class="form-control" readonly>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <h6> Mobile</h6>
                                    @if($customers->mobile)
                                    @php
                                    $mobile = json_decode($customers->mobile);

                                    $mobileValue = isset($mobile->full) ? htmlspecialchars($mobile->full) : '';

                                    @endphp
                                    <span><input type="tel" id="mobile" name="mobile[main]" class="form-control" value="{{ $mobileValue }}"></span>
                                    @else
                                    <span><input type="tel" class="form-control" id="mobile" name="mobile[main]"></span>
                                    @endif
                                </div>
                                <h5 class="text-start fw-bold mt-5">COMPANY INFORMATION:</h5>
                                <div class="col-12 col-sm-6">
                                    <h6> Company Name</h6>
                                    <input type="text" name="company_name" value="{{$customers->company_name}}" class="form-control">
                                </div>

                                <div class="col-12 col-sm-6">
                                    <h6> EIN/Piva</h6>
                                    <input type="text" name="ein" value="{{$customers->ein}}" class="form-control">
                                </div>

                                <div class="col-12 col-sm-6">
                                    <h6>Address</h6>
                                    <input type="text" name="address" value="{{$customers->address}}" class="form-control">
                                </div>

                                <div class="col-12 col-sm-6">
                                    <h6>City</h6>
                                    <input type="text" name="city" value="{{$customers->city}}" class="form-control">
                                </div>

                                <div class="col-12 col-sm-6">
                                    <h6>State</h6>
                                    <input type="text" name="state" value="{{$customers->state}}" class="form-control">
                                </div>

                                <div class="col-12 col-sm-6">
                                    <h6> Country</h6>
                                    <input type="text" name="country" value="{{$customers->country}}" class="form-control">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h6> Zip code</h6>
                                    <input type="text" name="zip_code" value="{{$customers->zip_code}}" pattern="[0-9]{6}" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5 custom-btn">
                    <div class="col-12 col-sm-9">
                        <div class="d-flex justify-content-center">
                            <!-- <button type="button" class="cancel">Cancel</button> -->
                            <input type="submit" class="save ms-3 mb-4" value="Save">
                        </div>
                    </div>
                </div>
            </form>
            @endforeach
            @endif
        </div>
    </div>
</main>

@endsection