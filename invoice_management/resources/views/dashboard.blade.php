@extends('layouts.app')

@section('content')

<main role="main" class="content ml-sm-auto px-4">
    <!-- Main content goes here -->
    <div class="container-fluid">
        <div class="title pt-3 mb-4 d-inline-block">
            <h1>Dashboard</h1>
        </div>
        <div class="row gy-5">
            @if(Auth::user()->role == 'admin')
            <div class="col-md-4">
                <div class="card invc-crd">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="{{ route('customer')}}">
                                Total Customer
                                <i class="fa-solid fa-caret-right"></i>
                            </a>
                        </div>
                        <div class="invoice-count">
                            <span>{{$invoice['users']}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card invc-crd">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="{{ route('invoice') }}">
                                Total Invoice
                                <i class="fa-solid fa-caret-right"></i>
                            </a>
                        </div>
                        <div class="invoice-count">
                            <span>{{$invoice['total_invoice']}}</span>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="col-md-4">
                <div class="card invc-crd">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="{{ route('invoice_sent') }}">
                                Invoice Sent
                                <i class="fa-solid fa-caret-right"></i>
                            </a>
                        </div>
                        <div class="invoice-count">
                            <span>{{$invoice['Sent']}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card invc-crd">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="{{ route('invoice_paid') }}">
                                Paid Invoice
                                <i class="fa-solid fa-caret-right"></i>
                            </a>
                        </div>
                        <div class="invoice-count">
                            <span>{{$invoice['Paid']}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card invc-crd">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="{{ route('invoice_unpaid') }}">
                                UnPaid Invoice
                                <i class="fa-solid fa-caret-right"></i>
                            </a>
                        </div>
                        <div class="invoice-count">
                            <span>{{$invoice['Unpaid']}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card invc-crd">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="{{ route('invoice_cancel') }}">
                                Cancel Invoice
                                <i class="fa-solid fa-caret-right"></i>
                            </a>
                        </div>
                        <div class="invoice-count">
                            <span>{{$invoice['Cancel']}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card invc-crd">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="{{ route('invoice_recurring') }}">
                                Recurring Invoice
                                <i class="fa-solid fa-caret-right"></i>
                            </a>
                        </div>
                        <div class="invoice-count">
                            <span>{{$invoice['Recurring']}}</span>
                        </div>
                    </div>
                </div></div>
            </div>
            @endif
        </div>
    </div>

</main>
@endsection