@extends('layouts.app')

@section('content')
<main role="main" class="content ml-sm-auto   px-4">
    <!-- Main content goes here -->
    <div class="container-fluid">
        <div class="title pt-3 mb-4 d-inline-block d-flex justify-content-between">
            <h3>{{ $folder_name }} Documents</h3>
            <!-- @if (Auth::user()->role == 'customer')
    <a href="{{ route('document') }}" class="back-margin"> <button class="back">Back</button></a>
@else
    <a href="{{ url()->previous() }}" class="back-margin"><button class="back">Back</button></a>
    @endif -->
            <a href="{{ url()->previous() }}" class="back-margin"><button class="back">Back</button></a>
        </div>
        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session()->get('success') }}
        </div>
        @endif
        @if (Auth::user()->role == 'admin')
        <form action="{{ route('shareDocuments') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row g-5 doc-shared1">
                <div class="col-12 ">

                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <input type="hidden" value="{{ Auth::user()->id }}" name="shared_from">
                            <select name="shared_to[]" id="" class="form-control selectpicker mb-3" required multiple>
                                <option value="" disabled selected>Select customer</option>
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @foreach ($documents as $doc)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 ps-0 ">
                       
                        <div class="box-3 mt-3">
                            @if (pathinfo($doc->documents, PATHINFO_EXTENSION) == 'pdf')

                            <a href="{{ asset('storage/app/public/documents/' . $doc->documents) }}">
                                <img src="https://itinfonity.in/TonyDurante/public/images/pdf.png" alt="image-" class="img-doc">
                            </a>
                            <input type="checkbox" name="document_id[]" value="{{ $doc->id }}" class="">
                            @elseif (pathinfo($doc->documents, PATHINFO_EXTENSION) == 'ppt' || pathinfo($doc->documents, PATHINFO_EXTENSION) == 'pptx')

                            <a href="{{ asset('storage/app/public/documents/' . $doc->documents) }}">
                                <img src="https://itinfonity.in/TonyDurante/public/images/ppt.png" alt="image-" class="img-fluid">
                            </a>
                            <input type="checkbox" name="document_id[]" value="{{ $doc->id }}" class="">
                            @elseif (pathinfo($doc->documents, PATHINFO_EXTENSION) == 'doc' || pathinfo($doc->documents, PATHINFO_EXTENSION) == 'docx')

                            <a href="{{ asset('storage/app/public/documents/' . $doc->documents) }}">
                                <img src="https://itinfonity.in/TonyDurante/public/images/Google-Docs.png" alt="image-" class="img-fluid">
                            </a>
                            <input type="checkbox" name="document_id[]" value="{{ $doc->id }}" class="">
                            @elseif (pathinfo($doc->documents, PATHINFO_EXTENSION) == 'xls' || pathinfo($doc->documents, PATHINFO_EXTENSION) == 'xlsx')

                            <a href="{{ asset('storage/app/public/documents/' . $doc->documents) }}">
                                <img src="https://itinfonity.in/TonyDurante/public/images/excel.png" alt="image-" class="img-fluid">
                            </a>
                            <input type="checkbox" name="document_id[]" value="{{ $doc->id }}" class="">
                            @elseif (pathinfo($doc->documents, PATHINFO_EXTENSION) == 'ppt' || pathinfo($doc->documents, PATHINFO_EXTENSION) == 'pptx')

                            <a href="{{ asset('storage/app/public/documents/' . $doc->documents) }}">
                                <img src="https://itinfonity.in/TonyDurante/public/images/ppt.png" alt="image-" class="img-fluid">
                            </a>
                            <input type="checkbox" name="document_id[]" value="{{ $doc->id }}" class="">
                            
                            @else

                            <img src="{{ asset('storage/app/public/documents/' . $doc->documents) }}" alt="image-" class="img-doc">
                            <input type="checkbox" name="document_id[]" value="{{ $doc->id }}" class="">
                            @endif
                            <h6>{{ pathinfo($doc->documents, PATHINFO_FILENAME) }}</h6>
                        </div>


                    </div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-6 pt-3 mb-3">
                    <button type="submit" class="share">Share</button>
                </div>
            </div>
        </form>
    </div>
    @else

    <div class="row g-5">



        @foreach ($documents as $doc)
        <div class=" col-12 col-sm-6 col-md-4 col-lg-3">

            <div class="box-4">
                @if (pathinfo($doc->documents, PATHINFO_EXTENSION) == 'pdf')
                <a href="{{ asset('storage/app/public/documents/' . $doc->documents) }}">
                    <img src="https://itinfonity.in/TonyDurante/public/images/pdf.png" alt="image-" class="img-g">
                </a>
                @elseif (pathinfo($doc->documents, PATHINFO_EXTENSION) == 'ppt' || pathinfo($doc->documents, PATHINFO_EXTENSION) == 'pptx')

                <a href="{{ asset('storage/app/public/documents/' . $doc->documents) }}">
                    <img src="https://itinfonity.in/TonyDurante/public/images/ppt.png" alt="image-" class="img-fluid" >
                </a>
                @elseif (pathinfo($doc->documents, PATHINFO_EXTENSION) == 'doc' || pathinfo($doc->documents, PATHINFO_EXTENSION) == 'docx')

                <a href="{{ asset('storage/app/public/documents/' . $doc->documents) }}">
                    <img src="https://itinfonity.in/TonyDurante/public/images/Google-Docs.png" alt="image-" class="img-fluid" >
                </a>
                @elseif (pathinfo($doc->documents, PATHINFO_EXTENSION) == 'xls' || pathinfo($doc->documents, PATHINFO_EXTENSION) == 'xlsx')

                <a href="{{ asset('storage/app/public/documents/' . $doc->documents) }}">
                    <img src="https://itinfonity.in/TonyDurante/public/images/Google-Docs.png" alt="image-" class="img-fluid" >
                </a>
                @elseif (pathinfo($doc->documents, PATHINFO_EXTENSION) == 'ppt' || pathinfo($doc->documents, PATHINFO_EXTENSION) == 'pptx')

                <a href="{{ asset('storage/app/public/documents/' . $doc->documents) }}">
                    <img src="https://itinfonity.in/TonyDurante/public/images/ppt.png" alt="image-" class="img-fluid">
                </a>
                @else
                <img src="{{ asset('storage/app/public/documents/' . $doc->documents) }}" alt="image-" class="img-g">
                @endif
                <h6>{{ pathinfo($doc->documents, PATHINFO_FILENAME) }}</h6>
            </div>


        </div>
        @endforeach
        {{-- <div class="col-12 col-sm-6">
                <button type="submit" class="share">Share</button>
            </div> --}}
    </div>
    @endif
</main>
@endsection