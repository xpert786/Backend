@extends('layouts.app')

@section('content')

<!-- Main content area -->
<main role="main" class="content ml-sm-auto px-4">
    <!-- Main content goes here -->
    <div class="container-fluid">
        <div class="title pt-3 mb-4 d-inline-block d-flex justify-content-between">
            <h1>Invoice Details</h1>
            @if(Auth::user()->role == 'customer')<a href="{{route('notification')}}" class="back-margin"><button class="back">Back</button></a>
            @else
            <a href="{{route('invoice')}}" class="back-margin"><button class="back">Back</button></a>
            @endif
        </div>
        <div class="row gy-5">
            <div class="col-sm-12 col-md-10">
                
                    <div class=" view-inv invoice-bg p-5">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="add-logo">

                                    <!-- File input for new logo -->
                                    <!-- <input type="file" id="logo" name="logo" accept="image/*" value="{{$invoice->logo}}"> -->
                                    <div class="img-bx">
                                        @if ($invoice->logo)
                                        <!-- Existing logo -->
                                        @foreach($logos as $logo)
                                        <img src="{{ asset('storage/app/public/'. $logo->logo) }}" id="preview" class="img-fluid pt-4" alt="Existing Logo" width="80px" height="80px">
                                        @endforeach
                                        @else
                                        <img id="preview" src="{{ asset('public/images/image-icon 1.png') }}" class="img-fluid" alt="Placeholder Image" width="80px" height="80px">

                                        @endif
                                       
                                    </div>
                                    <span>Logo</span>
                                </div>
                            </div>


                            <div class="col-12 col-sm-6">
                                <h6>Customer Details</h6>
                                @foreach($customers as $customer)
                                <p>{{$customer->company_name}}</p>
                                <span>{{$customer->address}}</span>
                                <p><a href="tel:{{json_decode($customer->mobile)->full}}">{{json_decode($customer->mobile)->full}}</a></p>
                                <p><a href="mailto:{{$customer->email}}">{{$customer->email}}</a></p>
                                @endforeach
                            </div>

                            <div class="col-12 col-sm-6 pt-5">
                                <h6>Details</h6>
                                <p>{{ Auth::user()->company_name}}</p>
                                <span>{{ Auth::user()->company_address}}</span>
                                @if(Auth::user()->company_mobile)
                                @php
                                $mobile = json_decode(Auth::user()->company_mobile);

                                $mobileValue = isset($mobile->full) ? htmlspecialchars($mobile->full) : '';

                                @endphp
                                <p><a href="tel:{{ $mobileValue }}"> {{ $mobileValue }}</a></p>
                                
                                @endif
                                <p><a href="mailto:{{ Auth::user()->email}}">{{ Auth::user()->email}}</a></p>
                            </div>

                            <div class="col-12 col-sm-6 pt-5">
                                <div class="d-flex justify-content-start align-items-start g-3">
                                    <div class="lft-bx">
                                        <h6>Invoice Number</h6>
                                        <p class="fs">Issued Date</p>
                                        <p class="fs">Due Date</p>
                                        <p class="fs">Recurring Invoice </p>
                                    </div>
                                    <div class="rht-bx ms-5">
                                        <h6 class="inv-no ">{{$invoice->invoice_number}}</h6>
                                        <p class="issu-date inv-no">{{$invoice->issued_date}}</p>
                                        <p class="due-date inv-no">{{$invoice->due_date}}</p>
                                        <div class="form-group">{{ $invoice->recurring_invoice }}
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="COL-12 col-md-9">
                                <div class="d-flex justify-content-between">
                                    <h5 class="invoice">Invoice</h5>
                                    <!-- <div class="mb-3 d-flex align-items-center currency-bx">
                                        <label for="selectCurrency" class="form-label m-0 me-2 fw-semibold">Currency:</label>
                                    </div> -->
                                </div>
                            </div>
                            <div class="col-12 col-md-9 px-0">
                                <table id="invoice-table" class="table-responsive fill-invic">
                                    <thead class="bg-transparent">
                                        <tr>
                                            <th>Item Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Amount</th>
                                            <th>Description</th>
                                           

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $item)
                                        <tr class="invoice-item1">
                                            <td>{{ $item->item_name }}</td>
                                            <td>{{$invoice->currencies->symbol}}{{ $item->price }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{$invoice->currencies->symbol}}{{ $item->amount }}</td>
                                            <td>
                                                {{ $item->description }}
                                            </td>
                                        </tr>
                                        <tr class="description-item">
                                            {{-- <td colspan="4" class="px-3 pt-2">
                                                {{ $item->description }}
                                            </td> --}}
                                            <td></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <!-- <tfoot>
                                        <tr>
                                            <td colspan="5"><button type="button" id="add-more" class="add-more"><i class="fa-solid fa-plus pe-2"></i>Add items</button></td>
                                        </tr>
                                    </tfoot> -->
                                </table>


                            </div>
                            <div class="col-12 col-md-3 ">
                                <div class="">
                                    <table class="table-responsive mb-4 pb-0 fill-invic">
                                        <tbody>
                                            <tr>
                                                <td class="pe-5 ps-3 pt-1 fw-bold">Subtotal</td>
                                                <input type="hidden" class="subtotal" name="subtotal" value="{{$invoice->subtotal}}">
                                                <td class="sub-total-amount pt-1"><span class="currency">{{$invoice->currencies->symbol}}</span>{{$invoice->subtotal}}</td>
                                            </tr>
                                            <tr>
                                                <td class="pe-5 ps-3 fw-bold">Discount</td>
                                                <td><span class="currency">{{$invoice->currencies->symbol}}</span>{{$invoice->discount}}</td>
                                            </tr>
                                            <tr>
                                                <td class="pe-5 ps-3 fw-bold">Tax </td>
                                                <td><span class="currency">{{$invoice->currencies->symbol}}</span>{{$invoice->tax}}</td>
                                            </tr>
                                            <tr>
                                                <td class="total-bg pe-5 ps-3 fw-bold ">Total</td>
                                                <input type="hidden" class="totalamount" name="total" value="{{$invoice->total}}">
                                                <td class="total-bg total-amount "><span class="currency">{{$invoice->currencies->symbol}}</span>{{$invoice->total}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-12 message-bx">
                                <div class="my-4">
                                    <label for="Textarea1" class="form-label">Message</label>
                                    <p>{{$invoice->message}}</p>
                                </div>
                            </div>
                        </div>
                        <!--invoice-table-->
                        <!-- <div class="message my-4">
                            <h5>Message</h5>
                            <textarea name="message" id="Textarea1" rows="6" class="form-control">{{$invoice->message}}</textarea>
                        </div> -->
                        <div class="d-flex justify-content-end">
                            <!-- <button type="button" class="cancel"><a href="{{ route('invoice') }}">Cancel</a></button> -->
                            <!-- <button type="submit" class="save ms-3">Save</button> -->
                            <!-- <button type="button" class="cancel ms-3">Send</button> -->
                        </div>

                    </div>
                
            </div>
        </div>
    </div>
</main>
@endsection
