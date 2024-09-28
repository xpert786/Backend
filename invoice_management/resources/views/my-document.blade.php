@extends('layouts.app')

@section('content')

<main role="main" class="content ml-sm-auto  px-4">
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ session()->get('success') }}
    </div>
    @endif
    <!-- Main content goes here -->

    <div class="container-fluid p-0">
        <div class="title pt-3 mb-4 d-inline-block d-flex justify-content-between">
            <h1>My Documents</h1>
            <a href="{{ route('document') }}" class="back-margin"> <button class="back">Back</button></a>
        </div>
    </div>
    <!--document-->
    <div class="col-12">
        {{-- <h4>All Folders</h4> --}}
        <div class="row gy-5">

            @foreach ($folder as $uniqueFolder)
            <div class="col-6 col-sm-3 col-md-2 ">
                <a href="{{ route('view-folder-doc', ['user_id' => Auth::user()->id, 'folder_id' => $uniqueFolder->id]) }}">
                    <img src="https://invoicemanagement.itinfonity.com/public/images/folder-1.png" alt="folder" width="65px"></a>
                <div class="folder-name" data-folder-id="{{ $uniqueFolder->id }}">{{ $uniqueFolder->folder_name }}
                </div>
            </div>
            @endforeach
        </div>
    </div>


</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Double click event handler
        $(".folder-name").dblclick(function() {
            // Get the current folder name
            var folderName = $(this).text().trim();

            // Replace the folder name with an input field
            $(this).html('<input type="text" class="form-control folder-name-input" value="' + folderName + '">');

            // Focus on the input field
            $(this).find('.folder-name-input').focus();

            // Remove any extra space around the input field
            $(this).find('.folder-name-input').css('width', '80%');

        });

        // Blur event handler for the input field
        $(document).on('blur', '.folder-name-input', function() {
            // Get the new folder name
            var newFolderName = $(this).val().trim();
            console.log('newFolderName:', newFolderName);
            // Get the folder ID
            var folderId = $(this).parent().data('folder-id');
            console.log('folderId:', folderId);
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            // Update the folder name via AJAX
            $.ajax({
                url: "{{ route('update-folder') }}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Pass CSRF token in headers
                },
                data: {
                    folder_id: folderId,
                    folder_name: newFolderName
                },
                success: function(response) {
                    // Update the folder name display
                    $(this).parent().text(newFolderName);
                    location.reload();
                }
            });
        });
    });

</script>
@endsection