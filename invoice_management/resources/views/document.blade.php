@extends('layouts.app')

@section('content')
<!-- Main content area -->
<main role="main" class="content ml-sm-auto  px-4">
    <!-- Main content goes here -->
    <div class="container-fluid p-0">
        <div class="title pt-3 mb-4 d-inline-block d-flex justify-content-between">
            <h1>Document</h1>

            <div class="fol">
                <button type="button" id="createFolderBtn" class="create-fol" data-toggle="modal" data-target="#createFolderModal">Create folder</button>
            </div>
        </div>

        <div class="modal fade " id="createFolderModal" tabindex="-1" data-backdrop="false" role="dialog" aria-labelledby="createFolderModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content ">
                    {{-- <div class="modal-header mo-ti p-0 border-0 justify-content-end">
                        <h5></h5>
                        <button type="button" class="close pt-4 px-4" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> --}}
                    <div class="modal-header d-flex justify-content-between align-items-center">
                        <h1 class="modal-title fs-1 me-auto" id="exampleModalLabel">Create Folder</h1>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>

                    <form action="{{ route('document.create_folder') }}" method="post">
                        @csrf
                        <div class="modal-body ">
                            <input type="hidden" name="customerId" value="{{ Auth::user()->id }}">
                            <input type="text" id="newFolderName" name="custom_folder_name" class="form-control folder mb-3 me-4" placeholder="Enter folder name" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn modal-cancel" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn create-fol" id="saveFolderBtn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row g-5">
            <div class="col-12">
                <form action="{{ route('document.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="d-flex">
                        <select name="folder_name" class="form-control select_name folder mb-3 me-4" required>
                            <option value="">Select a folder</option>
                            @foreach ($folder as $uniqueFolder)
                            <option value="{{ $uniqueFolder->folder_name }}">{{ $uniqueFolder->folder_name }}</option>
                            @endforeach
                        </select>

                    </div>




                    @csrf
                    <div class="row g-5">
                        <div class="col-12 col-sm-6">
                            <div class="box">

                                <div class="add-logo1">

                                    <input type="file" id="document" name="documents[]" accept=".png, .jpg, .jpeg, .pdf, .doc, .docx" required multiple>
                                    <div id="preview-container" class="d-flex flex-wrap align-items-center">
                                        <img src="{{ asset('public/images/image-icon 1.png') }}" alt="icon">
                                    </div>
                                   
                                    <p>Upload your images here, or <span style="color: #3A59F2;"> browse</span></p>
                                    <p style="font-weight:200;">Supports : JPG, PNG, PDF Or Doc Format</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="px-5 pt-4">

                                <input type="hidden" name="customerId" value="{{ Auth::user()->id }}">
                                <!-- <button class="btn-2">Upload Document</button> -->
                                <div class="upload"><input type="submit" Value="Upload" class="btn-3"></div>
                            </div>
                        </div>



                    </div>
            </div>

            </form>



        </div>

        <!--document-->
        <div class="col-12">
            <div class="row gy-5 mt-3">

                <div class="col-6 col-sm-3 col-md-2 ">
                    <a href="{{ route('my-document') }}">
                        <img src="https://invoicemanagement.itinfonity.com/public/images/folder-1.png" alt="folder" width="65px"></a>
                    <div class="folder-name" data-folder-id="">My Documents
                    </div>
                </div>
                <!-- Admin -->
                @if(Auth::user()->role == "admin")
                <div class="col-6 col-sm-3 col-md-2 ">
                    <a href="{{ route('shared') }}">
                        <img src="https://invoicemanagement.itinfonity.com/public/images/folder-1.png" alt="folder" width="65px"></a>
                    <div class="folder-name" data-folder-id="">
                        Shared To Customer
                    </div>
                </div>
                <div class="col-6 col-sm-3 col-md-2 ">
                    <a href="{{ route('sharedToAdmin') }}">
                        <img src="https://invoicemanagement.itinfonity.com/public/images/folder-1.png" alt="folder" width="65px"></a>
                    <div class="folder-name" data-folder-id="">Shared With Me
                    </div>
                </div>
                @else
                <!-- Customer -->
                <div class="col-6 col-sm-3 col-md-2 ">
                    <a href="{{ route('shared') }}">
                        <img src="https://invoicemanagement.itinfonity.com/public/images/folder-1.png" alt="folder" width="65px"></a>
                    <div class="folder-name" data-folder-id="">
                        Shared with me
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- PDF.js library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>

<script>
    $(document).ready(function() {
        // Function to handle file input change
        $('#document').on('change', function() {
            // Clear existing previews
            $('#preview-container').html('');
    
            // Loop through selected files
            for (let i = 0; i < this.files.length; i++) {
                let file = this.files[i];
    
                // Check if the file is a PDF
                if (file.type === 'application/pdf') {
                    // Render PDF as image
                    renderPdfAsImage(file);
                } else {
                    // Handle other file types (e.g., images)
                    renderFilePreview(file);
                }
            }
        });
    
        // Function to render PDF as image using PDF.js
        function renderPdfAsImage(pdfFile) {
            let reader = new FileReader();
    
            reader.onload = function(e) {
                // Initialize PDF.js
                pdfjsLib.getDocument(e.target.result).promise.then(function(pdf) {
                    // Render the first page of the PDF
                    pdf.getPage(1).then(function(page) {
                        // Set canvas dimensions
                        let canvas = document.createElement('canvas');
                        let ctx = canvas.getContext('2d');
                        let viewport = page.getViewport({ scale: 0.5 }); // Adjust scale as needed
    
                        canvas.width = viewport.width;
                        canvas.height = viewport.height;
    
                        // Render PDF page to canvas
                        page.render({
                            canvasContext: ctx,
                            viewport: viewport
                        }).promise.then(function() {
                            // Convert canvas to data URL
                            let imageUrl = canvas.toDataURL('image/jpeg');
    
                            // Display the PDF image preview
                            $('#preview-container').append(`<img src="${imageUrl}" alt="PDF Preview">`);
                        });
                    });
                });
            };
    
            // Read the PDF file as a data URL
            reader.readAsArrayBuffer(pdfFile);
        }
    
        // Function to render previews for other file types (e.g., images)
        function renderFilePreview(file) {
            let reader = new FileReader();
    
            reader.onload = function(e) {
                // Display file preview
                $('#preview-container').append(`<img src="${e.target.result}" alt="File Preview">`);
            };

            // Read the file as a data URL
            reader.readAsDataURL(file);
        }
    });
   
</script>
@endsection