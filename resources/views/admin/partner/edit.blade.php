@extends('layouts.admin.master')
@section('title', 'Partners')

@section('content')
    @include('admin.includes.message')

    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit partner "{{ $partner->name }}"</h5>
                <small class="text-muted float-end">
                    <a href="{{ route('admin.partners.index') }}" class="btn btn-primary"><i
                            class="fa-solid fa-arrow-left"></i>
                        Back</a>
                </small>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.partners.update', $partner->id) }}"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $partner->name) }}" name="name" id="" placeholder="">
                                @error('name')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="form-label" for="basic-default-fullname">Order</label>
                                        <input type="number" name="order"
                                            class="form-control @error('order') is-invalid @enderror"
                                            value="{{ old('order', $partner->order) }}">
                                        @error('order')
                                            <div class="invalid-feedback" style="display: block;">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label" for="basic-default-fullname">Status</label>
                                        <select name="status" id=""
                                            class="form-select @error('status') is-invalid @enderror">
                                            <option {{ $partner->status == 1 ? 'selected' : '' }} value="1">
                                                Published
                                            </option>
                                            <option {{ $partner->status == 0 ? 'selected' : '' }} value="0">Draft
                                            </option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback" style="display: block;">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>


                                    <div class="col-md-4">
                                        <label class="form-label" for="basic-default-fullname">Link</label>
                                        <input type="text" name="link"
                                            class="form-control @error('link') is-invalid @enderror"
                                            value="{{ old('order', $partner->order) }}">
                                        @error('link')
                                            <div class="invalid-feedback" style="display: block;">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="basic-default-message">Description</label>
                                <textarea id="" class="form-control @error('description') is-invalid @enderror ckeditor" name="description"
                                    rows="8" placeholder="">{{ old('description', $partner->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="basic-default-message">Short Description</label>
                                <textarea id="" class="form-control @error('short_description') is-invalid @enderror" name="short_description"
                                    rows="4" placeholder="">{{ old('short_description', $partner->short_description) }}</textarea>
                                @error('short_description')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-body seo my-3 shadow br-8 p-4">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="basic-default-message">Image <span class="fw-bold">(167 x
                                            178px)</span></label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror image"
                                        name="image" id="">
                                    <img src="" height="60" alt="" class="view-image mt-2">
                                    @if ($partner->image)
                                        <img src="{{ $partner->image }}" width="100" class="mt-2 old-image">
                                        <i class="fa fa-times text-danger remove-image cursor-pointer" column="image"
                                            module="{{ $partner->id }}" aria-hidden="true"></i>
                                    @endif
                                    @error('image')
                                        <div class="invalid-feedback" style="display: block;">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card card-body seo my-3 shadow br-8 p-4">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Seo Title</label>
                                    <input type="text" class="form-control @error('seo_title') is-invalid @enderror"
                                        name="seo_title" id=""
                                        value="{{ old('seo_title', $partner->seo_title) }}" placeholder="">
                                    @error('seo_title')
                                        <div class="invalid-feedback" style="display: block;">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Meta Description</label>
                                    <textarea name="meta_description" id="" rows="7"
                                        class="form-control @error('meta_description') is-invalid @enderror">{{ old('meta_description', $partner->meta_description) }}</textarea>
                                    @error('meta_description')
                                        <div class="invalid-feedback" style="display: block;">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Meta Keywords</label>
                                    <input type="text"
                                        class="form-control @error('meta_keywords') is-invalid @enderror"
                                        name="meta_keywords" id=""
                                        value="{{ old('meta_keywords', $partner->meta_keywords) }}" placeholder="">
                                    @error('meta_keywords')
                                        <div class="invalid-feedback" style="display: block;">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-rotate"></i> Update</button>
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
                        var entity = 'Partner';
                        var folder = 'partner';

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
