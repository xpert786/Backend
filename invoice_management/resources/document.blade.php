@extends('layouts.app')

@section('content')
<!-- Main content area -->
<main role="main" class="content ml-sm-auto col-lg-10 pt-5 px-4">
    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ session()->get('success') }}
    </div>
    @endif
    <!-- Main content goes here -->
    <div class="container-fluid">
        <div class="title pt-3 mb-4 d-inline-block">
            <h1>Document</h1>
        </div>
        <div class="row gy-5">
            <div class="col-12 d-flex">
                <form action="{{ route('document.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="box">
                        <div class="add-logo1">
                            <input type="file" name="documents[]" accept=".png, .jpg, .jpeg, .pdf, .doc, .docx" required multiple>
                            <img src="{{ asset('public/images/image-icon 1.png') }}" alt="icon">
                            <p>Upload your images here, or <span style="color: #3A59F2;"> browse</span></p>
                            <p style="font-weight:200;">Supports : JPG, PNG, PDF Or Doc Format</p>
                        </div>
                        <div class="row px-5 pt-4">
                            <div class="col">
                                <input type="hidden" name="customerId" value="{{Auth::user()->id}}">
                                <button class="btn-3">Upload Document</button>
                                <div class="pt-5"><input type="submit" Value="Send" class="btn-2"></div>
                            </div>
                        </div>
                </form>
            </div>
            <!--document-->

            <div class="col-12">
                <h4> All Files</h4>
                <div class="row gy-5">
                    @foreach($documents as $doc)
                    <div class="col-md-3">
                        <div class="box-1">
                            @if(pathinfo($doc->documents, PATHINFO_EXTENSION) == 'pdf')
                            <a href="{{ asset('public/storage/documents/' .$doc->documents)}}"><img src="{{ asset('public/images/pdf.png') }}" alt="image-girl" class="img-fluid"></a>
                            @else
                            <img src="{{ asset('public/storage/documents/' . $doc->documents) }}" alt="image-girl" class="img-fluid">
                            @endif
                        </div>
                        <h6>{{ pathinfo($doc->documents, PATHINFO_FILENAME) }}</h6>
                    </div>
                    @endforeach
                </div>

            </div>
            <!--all-files-->

        </div>
    </div>
</main>
@endsection