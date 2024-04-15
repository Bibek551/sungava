@extends('layouts.admin.master')
@section('title', 'Ourteams')

@section('content')
    @include('admin.includes.message')

    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Create Ourteam</h5>
                <small class="text-muted float-end">
                    <a href="{{ route('admin.ourteams.index') }}" class="btn btn-primary"><i
                            class="fa-solid fa-arrow-left"></i> Back</a>
                </small>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.ourteams.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            id="" value="{{ old('name') }}" placeholder="">
                        @error('name')
                            <div class="invalid-feedback" style="display: block;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="basic-default-fullname">Position</label>
                                <input type="text" class="form-control @error('position') is-invalid @enderror"
                                    name="position" id="" value="{{ old('position') }}" placeholder="">
                                @error('position')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="basic-default-fullname">Order</label>
                                <input type="number" class="form-control @error('order') is-invalid @enderror"
                                    name="order" id="" value="{{ old('order') }}" placeholder="">
                                @error('order')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label class="form-label" for="basic-default-fullname">Facebook Link</label>
                            <input type="text" class="form-control @error('facebook_link') is-invalid @enderror"
                                name="facebook_link" id="" value="{{ old('facebook_link') }}" placeholder="">
                            @error('facebook_link')
                                <div class="invalid-feedback" style="display: block;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="basic-default-fullname">Instagram Link</label>
                            <input type="text" class="form-control @error('instagram_link') is-invalid @enderror"
                                name="instagram_link" id="" value="{{ old('instagram_link') }}" placeholder="">
                            @error('instagram_link')
                                <div class="invalid-feedback" style="display: block;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label class="form-label" for="basic-default-fullname">Twitter Link</label>
                            <input type="text" class="form-control @error('twitter_link') is-invalid @enderror"
                                name="twitter_link" id="" value="{{ old('twitter_link') }}" placeholder="">
                            @error('twitter_link')
                                <div class="invalid-feedback" style="display: block;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="basic-default-fullname">Linkedin Link</label>
                            <input type="text" class="form-control @error('linkedin_link') is-invalid @enderror"
                                name="linkedin_link" id="" value="{{ old('linkedin_link') }}" placeholder="">
                            @error('linkedin_link')
                                <div class="invalid-feedback" style="display: block;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-message">Description</label>
                        <textarea id="" class="form-control ckeditor @error('description') is-invalid @enderror" name="description"
                            rows="8" placeholder="">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback" style="display: block;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-message">Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror image"
                            name="image" id="">
                        <img src="" height="100" alt="" class="view-image mt-2">
                        @error('image')
                            <div class="invalid-feedback" style="display: block;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function() {
            $(".image").change(function() {
                input = this;
                var nthis = $(this);
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        nthis.siblings('.view-image').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });
        })
    </script>
@endsection
