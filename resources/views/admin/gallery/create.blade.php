@extends('layouts.admin.master')
@section('title', 'Image Galleries')

@section('content')
    <link rel="stylesheet" href="{{ asset('admin/inner/dropzone.min.css') }}">
    <script src="{{ asset('admin/inner/dropzone.js') }}"></script>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Upload Images</h5>

            <small class="text-muted float-end">
                <a href="{{ route('admin.galleries.index') }}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i>
                    Back</a>
            </small>
        </div>

        <div class="row">


            <div class="col-md-12">
                <div class="card-body">
                    <form action="{{ route('admin.galleries.store') }}" method="POST" class="dropzone" id="dropzone"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="dz-message">
                            Drag and Drop Your Images Here<br>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

@endsection
@section('scripts')
    <script>
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone('form#dropzone', {
            maxFiles: 12,
            acceptedFiles: 'image/*',
            dictInvalidFileType: 'This form only accepts images.',
            dictDefaultMessage: 'Drag or click here to upload',
            maxFilesize: 100,
            timeout: 180000000,

        });

        myDropzone.on("complete", function(file) {
            setTimeout(function() {
                window.location.href = "{{ route('admin.galleries.index') }}";
                // location.reload();
            }, 1500);

            toastr.success("Images Upload Successfully!", {
                fadeAway: 1500
            });
        });
    </script>
@endsection
