@extends('layouts.admin.master')
@section('title', 'Packages Gallery')

@section('content')
    <link rel="stylesheet" href="{{ asset('admin/inner/dropzone.min.css') }}">
    <script src="{{ asset('admin/inner/dropzone.js') }}"></script>
    <style>
        .fro-dropzone-image {
            box-shadow: 10px 10px 5px grey;
            margin-right: 20px;
            margin-bottom: 20px;
            width: 140px;
            height: 140px;
            position: relative;
        }

        .fro-dropzone-image-a {
            position: relative;
            width: 100%;
        }

        .fro-dropzone-image-img {
            height: 100%;
            width: 111%;
        }

        .fro-dropzone-image-btn {
            position: absolute;
            right: 1px;
        }
    </style>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Upload "{{ $package->name }}" Package Images</h5>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card-body">
                    <form action="{{ route('admin.gallery.upload.store', $package_id) }}" method="POST" class="dropzone"
                        id="dropzone" enctype="multipart/form-data">
                        @csrf
                        <div class="dz-message">
                            Drag and Drop Your Images Here<br>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="row m-2">
                    @if (!$galleries->isEmpty())
                        @foreach ($galleries as $gallery)
                            <div class="fro-dropzone-image">
                                <button class="btn btn-danger btn-sm fro-dropzone-image-btn delete-single-document"
                                    imageid="{{ $gallery->id }}" style="z-index: 9">X</button>
                                <a href="{{ asset('admin/images/package/' . $gallery->image) }}"
                                    class="fro-dropzone-image-a fancybox" data-fancybox="demo" target="_blank">
                                    <img src="{{ asset('admin/images/package/' . $gallery->image) }}" alt=""
                                        class="fro-dropzone-image-img">
                                </a>

                            </div>
                        @endforeach
                    @else
                        <div class="card-body">
                            <div class="alert alert-dark mb-0" role="alert">No Image Uploaded Yet!</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('admin.packages.index', 'created') }}" class="btn btn-primary m-4"><i class="fa fa-refresh"
                        aria-hidden="true"></i>
                    Finish</a>
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
            location.reload();

            toastr.success("Images Upload Successfully!", {
                fadeAway: 1500
            });
        });

        $('.delete-single-document').click(function() {
            var id = $(this).attr('imageid');

            var url = "{{ url('/admin/package/delete-file/') }}" + "/" + id;

            swal({
                    title: `Are you sure?`,
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: url,
                            type: "GET",
                            success: function(data) {
                                location.reload();
                                toastr.success("Images Deleted Successfully!", {
                                    fadeAway: 1500
                                });
                            },
                            error: function(data) {
                                alert("Some Problems Occured!");
                            },
                        });
                    }
                });
        });
    </script>
@endsection
