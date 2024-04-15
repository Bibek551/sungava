@extends('layouts.admin.master')
@section('title', 'Testimonials')

@section('content')
    @include('admin.includes.message')

    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Testimonial "{{ $testimonial->name }}"</h5>
                <small class="text-muted float-end">
                    <a class="btn btn-primary" href="{{ route('admin.testimonials.index') }}"><i
                            class="fa-solid fa-arrow-left"></i> Back</a>
                </small>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.testimonials.update', $testimonial->id) }}"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" id="" type="text"
                            value="{{ old('name', $testimonial->name) }}" name="name" placeholder="">
                        @error('name')
                            <div class="invalid-feedback" style="display: block;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label" for="basic-default-fullname">Position</label>
                                <input class="form-control" id="" type="text"
                                    value="{{ old('position', $testimonial->position) }}" name="position" placeholder="">
                                @error('position')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="basic-default-fullname">Order</label>
                                <input class="form-control @error('order') is-invalid @enderror" id=""
                                    type="number" name="order" value="{{ old('order', $testimonial->order) }}"
                                    placeholder="">
                                @error('order')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="basic-default-fullname">Rating</label>
                                <input class="form-control @error('rating') is-invalid @enderror" id=""
                                    type="number" name="rating" value="{{ old('rating', $testimonial->rating) }}"
                                    placeholder="" min="1" max="5">
                                @error('rating')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-message">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror ckeditor" id="" name="description"
                            rows="8" placeholder="">{{ old('description', $testimonial->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback" style="display: block;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-message">Image</label>
                        <input class="form-control @error('image') is-invalid @enderror image" id="" type="file"
                            name="image">
                        <img class="view-image mt-2" src="" height="60" alt="">
                        @if ($testimonial->image)
                            <img class="mt-2 old-image" src="{{ $testimonial->image }}" width="100">
                            <i class="fa fa-times text-danger remove-image cursor-pointer" column="image"
                                module="{{ $testimonial->id }}" aria-hidden="true"></i>
                        @endif
                        @error('image')
                            <div class="invalid-feedback" style="display: block;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button class="btn btn-primary" type="submit"><i class="fa-solid fa-rotate"></i> Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(".image").change(function() {
            input = this;
            var nthis = $(this);

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    nthis.siblings('.old-image').hide();
                    nthis.siblings('.view-image').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        });

        $('.remove-image').click(function(e) {
            e.preventDefault();
            swal({
                    title: `Are you sure?`,
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        var moduleid = $(this).attr('module');
                        var column = $(this).attr('column');
                        var entity = 'Testimonial';
                        var folder = 'testimonial';

                        $.ajax({
                            url: "{{ url('fileremove') }}" + "/" + moduleid + "/" + entity +
                                "/" + folder + '/' + column,
                            type: "GET",
                            success: function(data) {
                                location.reload();
                                toastr.success("File removed");
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
