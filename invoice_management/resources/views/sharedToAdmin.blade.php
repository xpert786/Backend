@extends('layouts.app')

@section('content')
<main role="main" class="content ml-sm-auto mt-0 pt-0 px-4">

    <div class="container-fluid">
        <div class="title pt-3 mb-4 d-inline-block d-flex justify-content-between">
            <h3>Shared With Me</h3>
            <a href="{{ route('document') }}" class="back-margin"> <button class="back">Back</button></a>
        </div>
       <!--  <div class="row">
            @foreach ($data['user'] as $index => $item)

            <div class="col-6 col-sm-3 col-md-2 ">
                <a href="{{route('viewdocument', ['id' => $item->id])}}"><img src="{{ asset('public/images/folder-1.png') }}" class="" width="65px"></a>
                <div>{{ $item->name }} {{ $item->lname }}</div>
            </div>
            @endforeach

        </div> -->
    </div>
    <div class="row">
            <!-- Vertical tabs for folders -->
            <!-- <div class="col-md-3">
                <div class="list-group" id="folder-list">
                    @foreach ($data['user'] as $index => $item)
                    <a href="#" class="list-group-item list-group-item-action folder-item" data-id="{{ $item->id }}">
                        {{ $item->name }} {{ $item->lname }}
                    </a>
                    @endforeach
                </div>
            </div> -->
            <!-- Image display section -->
            <!-- <div class="col-md-9">
                <div class="image-container">
                    <img src="" alt="Folder Image" id="folder-image" style="display: none;">
                    @foreach ($folder as $uniqueFolder)
                            <div class="col-sm-6 col-md-2">
                                <a
                                    href="{{ route('view-folder-doc', ['user_id' => $user, 'folder_id' => $uniqueFolder->id]) }}">
                                    <img src="https://itinfonity.in/TonyDurante/public/images/folder-1.png" alt="folder"
                                        width="65px"></a>
                                <div class="folder-name" data-folder-id="{{ $uniqueFolder->id }}">{{ $uniqueFolder->folder_name }}</div>
                            </div>
                        @endforeach
                </div>
            </div> -->
            @if(!empty($folders))
            <div class="d-flex shared-doc">
                <div class="col-sm-6 col-md-3 px-0">
                    <div class="shared-client-name">
                <!-- Vertical nav tabs -->
                <div class="d-flex">
                    <input type="text" name="search" id="search-input" class="form-control me-3" placeholder="Search...">
                </div>
                <div class="nav flex-column nav-pills me-3 mb-3 mt-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                @foreach ($folders as $user => $documents)
                        <a class="nav-link {{ $loop->first? 'active' : '' }}" id="v-pills-{{$user}}-tab"
                            data-bs-toggle="pill" href="#v-pills-{{$user}}" role="tab"
                            aria-controls="v-pills-"
                            aria-selected="">{{$user}}</a>
                    @endforeach
                </div>
                </div>
                </div>

                <div class="col-sm-6 col-md-9  doc-shared">
                <!-- Tab content -->
                <div class="tab-content" style="width: 100%;">
                    @foreach ($folders as $user => $documents)
                        <div class="tab-pane {{ $loop->first? 'show active' : '' }}" id="v-pills-{{$user}}"
                            role="tabpanel" aria-labelledby="v-pills-{{$user}}-tab">
                            <div class="row g-4">
                                @foreach ($documents as $document)
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                        @if (pathinfo($document->documents, PATHINFO_EXTENSION) == 'pdf')
                                        <a href="{{ asset('storage/app/public/documents/' . $document->documents) }}">
                                            <img src="https://invoicemanagement.itinfonity.com/public/images/pdf.png" alt="image-" class="shared-img">
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
        </div>

</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
    $('#search-input').on('keyup', function () {
        var searchTerm = $(this).val().trim();

        $.ajax({
            url: "{{ route('sharedToAdmin') }}",
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
{{-- @extends('layouts.app')

@section('content')
<main role="main" class="content ml-sm-auto  px-4">
    <div class="container-fluid">
        <div class="title pt-3 mb-4 d-inline-block d-flex justify-content-between">
            <h3>Shared With Me</h3>
            <a href="{{ route('document') }}" class="back-margin"> <button class="back">Back</button></a>
</div>
<div class="row">
    <!-- Vertical tabs for folders -->
    <div class="col-md-3">
        <div class="list-group" id="folder-list">
            @foreach ($data['user'] as $index => $item)
            <a href="#" class="list-group-item list-group-item-action folder-item" data-id="{{ $item->id }}">
                {{ $item->name }} {{ $item->lname }}
            </a>
            @endforeach
        </div>
    </div>
    <!-- Image display section -->
    <div class="col-md-9">
        <div class="image-container">
            <img src="" alt="Folder Image" id="folder-image" style="display: none;">
            @foreach ($folder as $uniqueFolder)
            <div class="col-sm-6 col-md-2">
                <a href="{{ route('view-folder-doc', ['user_id' => $user, 'folder_id' => $uniqueFolder->id]) }}">
                    <img src="https://itinfonity.in/TonyDurante/public/images/folder-1.png" alt="folder" width="65px"></a>
                <div class="folder-name" data-folder-id="{{ $uniqueFolder->id }}">{{ $uniqueFolder->folder_name }}</div>
            </div>
            @endforeach
        </div>
    </div>

</div>
</div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const folderItems = document.querySelectorAll('.folder-item');

        folderItems.forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const folderId = this.getAttribute('data-id');
                const folderImageSrc = getFolderImageSrc(folderId); // Replace this with your logic to get the folder image URL
                const folderImage = document.getElementById('folder-image');

                // Update image source and display it
                folderImage.src = folderImageSrc;
                folderImage.style.display = 'block';
            });
        });

        function getFolderImageSrc(folderId) {
            // Logic to retrieve the folder image URL based on folderId
            // You can fetch the URL from your backend or use a predefined mapping
            // For demonstration purposes, let's assume a static mapping
            const imageMap = {
                'folder1': 'path/to/folder1/image.jpg',
                'folder2': 'path/to/folder2/image.jpg',
                // Add more mappings as needed
            };
            return imageMap[folderId] || ''; // Return empty string if no image found
        }
    });
</script>
@endsection --}}