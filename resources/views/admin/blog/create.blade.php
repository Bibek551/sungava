@extends('layouts.admin.master')
@section('title', 'Blogs')

@section('content')
    @include('admin.includes.message')

    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Create Blog</h5>
                <small class="text-muted float-end">
                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i>
                        Back</a>
                </small>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.blogs.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="title" id="" value="{{ old('title') }}" placeholder="">
                                @error('title')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <label class="form-label" for="basic-default-fullname">Date</label>
                                    <input type="text"
                                        class="form-control flatpicker @error('date') is-invalid @enderror" name="date"
                                        id="" value="{{ old('date') }}" placeholder="" autocomplete="off">
                                    @error('date')
                                        <div class="invalid-feedback" style="display: block;">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="basic-default-fullname">Category</label>
                                    <select name="blog_category_id" id=""
                                        class="form-select @error('blog_category_id') is-invalid @enderror">
                                        <option value="">Select Category</option>
                                        @foreach ($blogcategories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('blog_category_id')
                                        <div class="invalid-feedback" style="display: block;">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="basic-default-message">Description</label>
                                <textarea id="" class="form-control @error('description') is-invalid @enderror ckeditor" name="description"
                                    rows="8" placeholder="">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="basic-default-message">Short Description</label>
                                <textarea id="" class="form-control @error('short_description') is-invalid @enderror" name="short_description"
                                    rows="4" placeholder="">{{ old('short_description') }}</textarea>
                                @error('short_description')
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
                        </div>
                        <div class="col-md-4">
                            <div class="card card-body seo my-3 shadow br-8 p-4">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Seo Title</label>
                                    <input type="text" class="form-control @error('seo_title') is-invalid @enderror"
                                        name="seo_title" id="" value="{{ old('seo_title') }}" placeholder="">
                                    @error('seo_title')
                                        <div class="invalid-feedback" style="display: block;">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Meta Description</label>
                                    <textarea name="meta_description" id="" cols="30" rows="10"
                                        class="form-control @error('meta_description') is-invalid @enderror">{{ old('meta_description') }}</textarea>
                                    @error('meta_description')
                                        <div class="invalid-feedback" style="display: block;">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Seo Schema</label>
                                    <textarea name="seo_schema" id="" cols="30" rows="10"
                                        class="form-control @error('seo_schema') is-invalid @enderror">{{ old('seo_schema') }}</textarea>
                                    @error('seo_schema')
                                        <div class="invalid-feedback" style="display: block;">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Meta Keywords</label>
                                    <input type="text"
                                        class="form-control @error('meta_keywords') is-invalid @enderror"
                                        name="meta_keywords" id="" value="{{ old('meta_keywords') }}"
                                        placeholder="">
                                    @error('meta_keywords')
                                        <div class="invalid-feedback" style="display: block;">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
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
