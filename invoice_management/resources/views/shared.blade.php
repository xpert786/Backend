{{-- @extends('layouts.app')

@section('content')
<main role="main" class="content ml-sm-auto  px-4">
 
        <div class="container-fluid">
            <div class="title pt-3 mb-4 d-inline-block d-flex justify-content-between">
                @if (Auth::user()->role == 'customer')<h3>Shared With Me</h3>@else
                <h3>Shared To</h3>
                @endif
                <a href="{{ route('document') }}" class="back-margin"> <button class="back">Back</button></a>
</div>

<div class="row g-5">
    @if (Auth::user()->role == 'customer')
    @foreach ($folder as $uniqueFolder)
    <div class="col-6">

        <img src="{{ asset('storage/app/public/documents/' . $uniqueFolder->document->documents) }}" alt="image-">
        <div>{{ $uniqueFolder->sharedToUser->name}}</div>
    </div>
    @endforeach
    @else
    @foreach ($folder as $user => $documents)

    <h3>{{ $user }}</h3>
    <div class="row">
        @foreach ($documents as $document)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <img src="{{ asset('storage/app/public/documents/' . $document->documents) }}" alt="image-">
        </div>
        @endforeach
    </div>

    @endforeach
    @endif
</div>

</div>
</main>
@endsection --}}

@extends('layouts.app')

@section('content')
<main role="main" class="content ml-sm-auto px-4 mt-0 pt-0">
    <section class="document-area">
        <div class="container-fluid">
            <div class="d-flex justify-content-between pt-3 mb-4">

                <h3 class="shared">{{ Auth::user()->role == 'customer' ? 'Shared With Me' : 'Shared To' }}</h3>

                <a href="{{ route('document') }}" class="back-margin"><button class="back">Back</button></a>
            </div>
            <div class="row">
                {{-- customer --}}
                @if (Auth::user()->role == 'customer')
                @foreach ($folder as $uniqueFolder)
                <div class="col-6 col-sm-2 my-2 mx-0 pe-0">
                    @if (pathinfo($uniqueFolder->document->documents, PATHINFO_EXTENSION) == 'pdf')
                    <a href="{{ asset('storage/app/public/documents/' . $uniqueFolder->document->documents) }}">
                        <img src="https://invoicemanagement.itinfonity.com/public/images/pdf.png" alt="image-" class="img-doc">
                    </a>
                    @elseif (pathinfo($uniqueFolder->document->documents, PATHINFO_EXTENSION) == 'ppt' || pathinfo($uniqueFolder->document->documents, PATHINFO_EXTENSION) == 'pptx')
                    <a href="{{ asset('storage/app/public/documents/' . $uniqueFolder->document->documents) }}">
                        <img src="https://invoicemanagement.itinfonity.com/public/images/ppt.png" alt="image-" class="img-fluid">
                    </a>
                    @elseif (pathinfo($uniqueFolder->document->documents, PATHINFO_EXTENSION) == 'doc' || pathinfo($uniqueFolder->document->documents, PATHINFO_EXTENSION) == 'docx')
                    <a href="{{ asset('storage/app/public/documents/' . $uniqueFolder->document->documents) }}">
                        <img src="https://invoicemanagement.itinfonity.com/public/images/Google-Docs.png" alt="image-" class="img-fluid">
                    </a>
                    @elseif (pathinfo($uniqueFolder->document->documents, PATHINFO_EXTENSION) == 'xls' || pathinfo($uniqueFolder->document->documents, PATHINFO_EXTENSION) == 'xlsx')
                    <a href="{{ asset('storage/app/public/documents/' . $uniqueFolder->document->documents) }}">
                        <img src="https://invoicemanagement.itinfonity.com/public/images/excel.png" alt="image-" class="img-fluid">
                    </a>
                    @else
                    <img src="{{ asset('storage/app/public/documents/' . $uniqueFolder->document->documents) }}" alt="image-" class="img-fluid shared-img">
                    @endif
                    {{-- <div>{{ $uniqueFolder->sharedToUser->name}}
                </div> --}}
            </div>
            @endforeach
            @else
            {{-- admin --}}
            @if(!empty($folder))
            <div class="d-flex shared-doc">
                <div class="col-sm-6 col-md-3 px-0">
                    <!-- Vertical nav tabs -->
                    <div class="shared-client-name">
                        <div class="d-flex">
                        <!-- <form action="{{ route('shared') }}" method="GET"> -->
                            <input type="text" name="search" id="search-input" class="form-control me-3" placeholder="Search...">
                            <!-- <button type="submit" class="btn btn-primary">Search</button> -->
                        <!-- </form> -->
                        </div>
                        <div class="nav flex-column nav-pills me-3 mt-3" id="v-pills-tab" role="tablist" aria-orientation="vertical" id="folder-list">
                            @foreach ($folder as $user => $documents)
                            <a class="nav-link {{ $loop->first? 'active' : '' }}" id="v-pills-{{$user}}-tab" data-bs-toggle="pill" href="#v-pills-{{$user}}" role="tab" aria-controls="v-pills-" aria-selected="">{{ $user }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-9  doc-shared">
                    <!-- Tab content -->
                    <div class="tab-content" style="width: 100%;">
                        @foreach ($folder as $user => $documents)
                        <div class="tab-pane {{ $loop->first? 'show active' : '' }}" id="v-pills-{{$user}}" role="tabpanel" aria-labelledby="v-pills-{{$user}}-tab">
                            <div class="row g-4">
                                @foreach ($documents as $document)
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                    @if (pathinfo($document->documents, PATHINFO_EXTENSION) == 'pdf')
                                    <a href="{{ asset('storage/app/public/documents/' . $document->documents) }}">
                                        <img src="https://invoicemanagement.itinfonity.com/public/images/pdf.png" alt="image-" class="img-doc">
                                    </a>
                                    @elseif (pathinfo($document->documents, PATHINFO_EXTENSION) == 'ppt' || pathinfo($document->documents, PATHINFO_EXTENSION) == 'pptx')
                                    <a href="{{ asset('storage/app/public/documents/' . $document->documents) }}">
                                        <img src="https://invoicemanagement.itinfonity.com/public/images/ppt.png" alt="image-" class="img-fluid">
                                    </a>
                                    @elseif (pathinfo($document->documents, PATHINFO_EXTENSION) == 'doc' || pathinfo($document->documents, PATHINFO_EXTENSION) == 'docx')
                                    <a href="{{ asset('storage/app/public/documents/' . $document->documents) }}">
                                        <img src="https://invoicemanagement.itinfonity.com/public/images/Google-Docs.png" alt="image-" class="img-fluid">
                                    </a>
                                    @elseif (pathinfo($document->documents, PATHINFO_EXTENSION) == 'xls' || pathinfo($document->documents, PATHINFO_EXTENSION) == 'xlsx')
                                    <a href="{{ asset('storage/app/public/documents/' . $document->documents) }}">
                                        <img src="https://invoicemanagement.itinfonity.com/public/images/excel.png" alt="image-" class="img-fluid">
                                    </a>
                                    @else
                                    <img src="{{ asset('storage/app/public/documents/' . $document->documents) }}" class="img-fluid shared-img" alt="Document">
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
            @endif
        </div>
        </div>
    </section>
</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
    $('#search-input').on('keyup', function () {
        var searchTerm = $(this).val().trim();

        $.ajax({
            url: "{{ route('shared') }}",
            type: "GET",
            data: { search: searchTerm },
            dataType: "json",
            success: function (response) {
                $('#folder-list').empty(); // Clear previous results
                    
                // Iterate over each user's folders
                var anchorTag = '';
                $.each(response.folder, function (user, folders) {
                    console.log('folders',folders);
                    var anchor = $('<a>', {
                        class: 'nav-link',
                        id: 'v-pills-' + user + '-tab',
                        'data-bs-toggle': 'pill',
                        href: '#v-pills-' + user,
                        role: 'tab',
                        'aria-controls': 'v-pills-' + user,
                        'aria-selected': 'false',
                        text: user
                    });
                    anchorTag += anchor.prop('outerHTML');
                });
                $('.nav-pills').html(anchorTag);

                $('.tab-pane').addClass('active show').siblings().removeClass('active show');
            },
            error: function (xhr, status, error) {
                console.error(error);
                $('.nav-pills').html('<p>Error occurred while searching.</p>');
            }
        });
    });
});
</script>
@endsection