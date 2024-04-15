@extends('layouts.admin.master')
@section('title', 'Destinations')

@section('content')
    @include('admin.includes.message')
    <style>
        .nav-tabs .nav-link.active,
        .nav-tabs .nav-link.active:hover,
        .nav-tabs .nav-link.active:focus {
            background: #e7e7ff;
            background-color: #7174fe;
            color: white;
        }
    </style>

    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Create Destination</h5>
                <small class="text-muted float-end">
                    <a class="btn btn-primary" href="{{ route('admin.destinations.index') }}"><i
                            class="fa-solid fa-arrow-left"></i>
                        Back</a>
                </small>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.destinations.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Name</label>
                                <input class="form-control @error('name') is-invalid @enderror" id=""
                                    type="text" name="name" value="{{ old('name') }}" placeholder="">
                                @error('name')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label class="form-label" for="basic-default-fullname">Status</label>
                                        <select class="form-select @error('status') is-invalid @enderror" id=""
                                            name="status">
                                            <option value="1">Published</option>
                                            <option value="0">Draft</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback" style="display: block;">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label" for="basic-default-fullname">Order</label>
                                        <input class="form-control @error('order') is-invalid @enderror" type="number"
                                            name="order" value="{{ old('order') }}">
                                        @error('order')
                                            <div class="invalid-feedback" style="display: block;">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label" for="basic-default-fullname">Is Shown Homepage</label>
                                        <div class="form-check">
                                            <input class="form-check-input" id="flexCheckChecked" name="is_shown_homepage"
                                                type="checkbox" value="1">
                                        </div>
                                        @error('is_shown_homepage')
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
                                    rows="8" placeholder="">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="basic-default-message">Short Description</label>
                                <textarea class="form-control @error('short_description') is-invalid @enderror" id="" name="short_description"
                                    rows="4" placeholder="">{{ old('short_description') }}</textarea>
                                @error('short_description')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="card card-body seo my-3 shadow br-8 p-4">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-message">Image</label>
                                    <input class="form-control @error('image') is-invalid @enderror image" id=""
                                        type="file" name="image">
                                    <img class="view-image mt-2" src="" height="100" alt="">
                                    @error('image')
                                        <div class="invalid-feedback" style="display: block;">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <hr class="shadow-sm">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="basic-default-message">Banner (IMAGE)</label>
                                    <input class="form-control @error('banner_image') is-invalid @enderror image"
                                        id="" type="file" name="banner_image">
                                    <img class="view-image mt-2" src="" height="100" alt="">
                                    @error('banner_image')
                                        <div class="invalid-feedback" style="display: block;">
                                            *{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="card card-body seo my-3 shadow br-8 p-4">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Seo Title</label>
                                    <input class="form-control @error('seo_title') is-invalid @enderror" id=""
                                        type="text" name="seo_title" value="{{ old('seo_title') }}" placeholder="">
                                    @error('seo_title')
                                        <div class="invalid-feedback" style="display: block;">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Meta Description</label>
                                    <textarea class="form-control @error('meta_description') is-invalid @enderror" id="" name="meta_description"
                                        cols="30" rows="6">{{ old('meta_description') }}</textarea>
                                    @error('meta_description')
                                        <div class="invalid-feedback" style="display: block;">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Meta Keywords</label>
                                    <input class="form-control @error('meta_keywords') is-invalid @enderror"
                                        id="" type="text" name="meta_keywords"
                                        value="{{ old('meta_keywords') }}" placeholder="">
                                    @error('meta_keywords')
                                        <div class="invalid-feedback" style="display: block;">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="card card-body my-3 mx-3 shadow br-8 p-4">
                            <ul class="nav nav-tabs px-4" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="otherinfo-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-otherinfo" type="button" role="tab"
                                        aria-controls="otherinfo" aria-selected="true">OTHER INFORMATION</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-otherinfo" role="tabpanel"
                                    aria-labelledby="nav-otherinfo-tab">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-border" id="dynamicAddRemoveOtherInfo"
                                                style="width:100%">
                                                <tr>
                                                    <th>Other Information</th>
                                                    <th>Action</th>
                                                </tr>
                                                <tr>
                                                    <td style="width: 95%">
                                                        <input class="form-control mb-3" type="text"
                                                            name="addmoreotherinfo[0][title]" placeholder="Enter Title" />
                                                        <textarea class="form-control editor" id="" name="addmoreotherinfo[0][description]"></textarea>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-link" id="add-btn-otherinfo"
                                                            type="button" name="addotherinfo"><span
                                                                class="badge badge-center rounded-pill bg-primary"><i
                                                                    class="fa-solid fa-plus"></i></span></button>
                                                    </td>
                                                </tr>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (isset($_GET['parent']) && $_GET['parent'])
                        <input class="form-control" type="hidden" name="parent_id" value="{{ $_GET['parent'] }}">
                    @else
                        <input class="form-control" type="hidden" name="parent_id" value="0">
                    @endif

                    <button class="btn btn-primary" type="submit"><i class="fa-solid fa-plus"></i> Create</button>
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

        var k = 0;
        $("#add-btn-otherinfo").click(function() {
            ++k;
            $("#dynamicAddRemoveOtherInfo").append(
                '<tr><td style="width: 95%"><input type="text" name="addmoreotherinfo[' +
                k +
                '][title]" placeholder="Enter Title" class="form-control mb-3" /><textarea name="addmoreotherinfo[' +
                k +
                '][description]"  class="form-control editor' +
                k +
                '"></textarea></td><td><button type="button" class="btn btn-link remove-tr-otherinfo"><span class="badge badge-center rounded-pill bg-danger"><i class="fa fa-times"></i></span></button></td></tr>'
            );
            ckeditor('editor' + k);
        });

        $(document).on('click', '.remove-tr-otherinfo', function() {
            $(this).parents('tr').remove();
        });
    </script>
@endsection
