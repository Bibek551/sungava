@extends('layouts.admin.master')
@section('title', 'Popup')

@section('content')
    @include('admin.includes.message')

    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Popup "{{ $popup->title }}"</h5>
                <small class="text-muted float-end">
                    <a class="btn btn-primary" href="{{ route('admin.popups.index') }}"><i class="fa-solid fa-arrow-left"></i>
                        Back</a>
                </small>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.popups.update', $popup->id) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Title</label>
                        <input class="form-control @error('title') is-invalid @enderror" id="" type="text"
                            value="{{ old('title', $popup->title) }}" name="title" placeholder="">
                        @error('title')
                            <div class="invalid-feedback" style="display: block;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-message">Description</label>
                        <textarea class="form-control ckeditor" id="" name="description" rows="8" placeholder="">{{ old('description', $popup->description) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label" for="basic-default-fullname">Link</label>
                                <input class="form-control @error('link') is-invalid @enderror" id=""
                                    type="text" value="{{ old('link', $popup->link) }}" name="link" placeholder="">
                                @error('link')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="basic-default-fullname">Order</label>
                                <input class="form-control @error('order') is-invalid @enderror" id=""
                                    type="number" value="{{ old('order', $popup->order) }}" name="order" placeholder="">
                                @error('order')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="basic-default-fullname">Status</label>
                                <select class="form-select @error('status') is-invalid @enderror" id=""
                                    name="status">
                                    <option {{ $popup->status == 1 ? 'selected' : '' }} value="1">Published</option>
                                    <option {{ $popup->status == 0 ? 'selected' : '' }} value="0">Draft</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-message">Image </label>
                        <input class="form-control @error('image') is-invalid @enderror image" id="" type="file"
                            name="image">
                        <img class="view-image mt-2" src="" height="60" alt="">
                        @if ($popup->image)
                            <img class="mt-2 old-image" src="{{ $popup->image }}" width="100">
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
    </script>
@endsection
