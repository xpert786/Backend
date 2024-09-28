@extends('layouts.app')

@section('content')
    <main role="main" class="content ml-sm-auto   px-4">
        <!-- Main content goes here -->
        <div class="container-fluid">
            <div class="title pt-3 mb-4 d-inline-block d-flex justify-content-between">
                <h3>{{ $folder_name }} Documents</h3>
                <a href="{{ url()->previous() }}" class="back-margin"><button class="back">Back</button></a>
            </div>       
        <div class="row g-5">
            @foreach ($documents as $doc)
                <div class=" col-12 col-sm-6 col-md-4 col-lg-3">

                    <div class="box-4">
                        @if (pathinfo($doc->documents, PATHINFO_EXTENSION) == 'pdf')
                            <a href="{{ asset('storage/app/public/documents/' . $doc->documents) }}" target="_blank">
                                <img src="https://invoicemanagement.itinfonity.com/public/images/pdf.png" alt="image-"  class="img-g">
                            </a>
                        @elseif (pathinfo($doc->documents, PATHINFO_EXTENSION) == 'doc' || pathinfo($doc->documents, PATHINFO_EXTENSION) == 'docx')
                            <a href="{{ asset('storage/app/public/documents/' . $doc->documents) }}" target="_blank">
                                <img src="https://invoicemanagement.itinfonity.com/public/images/Google-Docs.png" alt="image-" class="img-fluid">
                            </a>
                        @elseif (pathinfo($doc->documents, PATHINFO_EXTENSION) == 'ppt')
                            <a href="{{ asset('storage/app/public/documents/' . $doc->documents) }}" target="_blank">
                                <img src="https://invoicemanagement.itinfonity.com/public/images/ppt.png" alt="image-">
                            </a>
                        @elseif (pathinfo($doc->documents, PATHINFO_EXTENSION) == 'xls' || pathinfo($doc->documents, PATHINFO_EXTENSION) == 'xlsx')
                            <a href="{{ asset('storage/app/public/documents/' . $doc->documents) }}" target="_blank">
                                <img src="https://invoicemanagement.itinfonity.com/public/images/excel.png" alt="image-" class="img-fluid">
                            </a>
                        @else
                            <img src="{{ asset('storage/app/public/documents/' . $doc->documents) }}" alt="image-" class="img-fluid">
                        @endif
                        <h6>{{ pathinfo($doc->documents, PATHINFO_FILENAME) }}</h6>
                    </div>


                </div>
            @endforeach
        </div>
    </main>
@endsection
