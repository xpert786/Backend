@extends('layouts.app')

@section('content')
<main role="main" class="content ml-sm-auto px-4">
<div class="container-fluid">
           <div class="title pt-3 mb-4 d-inline-block d-flex justify-content-between">
               <h1>View Documents</h1>
               <a href="{{route('customer')}}" class="mt-5"><button class="back">Back</button></a>
           </div>
           <div class="row gy-5">
                        @foreach ($folder as $uniqueFolder)
                            <div class="col-sm-6 col-md-2">
                                <a
                                    href="{{ route('customer-document', ['user_id' => $user, 'folder_id' => $uniqueFolder->id]) }}">
                                    <img src="https://invoicemanagement.itinfonity.com/public/images/folder-1.png" alt="folder"
                                        width="65px"></a>
                                <div class="folder-name" data-folder-id="{{ $uniqueFolder->id }}">{{ $uniqueFolder->folder_name }}</div>
                            </div>
                        @endforeach
                    </div>
        
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.folder').click(function() {
            var folderName = $(this).data('folder');
            $('.images-container').hide(); // Hide all images containers
            $('#images-' + folderName).toggle(); // Toggle the visibility of the clicked folder's images container
        });
    });
</script>
@endsection