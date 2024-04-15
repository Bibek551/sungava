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
                <h5 class="mb-0">Edit Destination "{{ $destination->name }}"</h5>
                <small class="text-muted float-end">
                    @if (isset($_GET['parent']) && $_GET['parent'])
                        <a class="btn btn-primary"
                            href="{{ route('admin.destinations.index', ['parent' => $_GET['parent']]) }}"><i
                                class="fa-solid fa-arrow-left"></i>
                            Back</a>
                    @else
                        <a class="btn btn-primary" href="{{ route('admin.destinations.index') }}"><i
                                class="fa-solid fa-arrow-left"></i>
                            Back</a>
                    @endif
                </small>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.destinations.update', $destination->id) }}"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Name</label>
                                <input class="form-control @error('name') is-invalid @enderror" id=""
                                    type="text" value="{{ old('name', $destination->name) }}" name="name"
                                    placeholder="">
                                @error('name')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="form-label" for="basic-default-fullname">Status</label>
                                        <select class="form-select @error('status') is-invalid @enderror" id=""
                                            name="status">
                                            <option {{ $destination->status == 1 ? 'selected' : '' }} value="1">
                                                Published
                                            </option>
                                            <option {{ $destination->status == 0 ? 'selected' : '' }} value="0">Draft
                                            </option>
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
                                            name="order" value="{{ old('order', $destination->order) }}">
                                        @error('order')
                                            <div class="invalid-feedback" style="display: block;">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label" for="basic-default-fullname">Is Shown Homepage</label>
                                        <div class="form-check">
                                            <input class="form-check-input" id="flexCheckChecked"
                                                {{ $destination->is_shown_homepage == 1 ? 'checked' : '' }}
                                                name="is_shown_homepage" type="checkbox" value="1">
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
                                    rows="8" placeholder="">{{ old('description', $destination->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="basic-default-message">Short Description</label>
                                <textarea class="form-control @error('short_description') is-invalid @enderror" id="" name="short_description"
                                    rows="4" placeholder="">{{ old('short_description', $destination->short_description) }}</textarea>
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
                                    <img class="view-image mt-2" src="" height="60" alt="">
                                    @if ($destination->image)
                                        <img class="mt-2 old-image" src="{{ $destination->image }}" width="100">
                                    @endif
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
                                    <img class="view-image mt-2" src="" height="60" alt="">
                                    @if ($destination->banner_image)
                                        <img class="mt-2 old-image" src="{{ $destination->banner_image }}"
                                            width="100">
                                    @endif
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
                                        type="text" name="seo_title"
                                        value="{{ old('seo_title', $destination->seo_title) }}" placeholder="">
                                    @error('seo_title')
                                        <div class="invalid-feedback" style="display: block;">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Meta Description</label>
                                    <textarea class="form-control @error('meta_description') is-invalid @enderror" id="" name="meta_description"
                                        rows="6">{{ old('meta_description', $destination->meta_description) }}</textarea>
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
                                        value="{{ old('meta_keywords', $destination->meta_keywords) }}" placeholder="">
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
                                        aria-controls="otherinfo" aria-selected="false">OTHER INFORMATION</button>
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
                                                @if (!$destinationOtherinfos->isEmpty())
                                                    @foreach ($destinationOtherinfos as $key => $infos)
                                                        <tr>
                                                            <td style="width: 95%">
                                                                <input class="form-control mb-3" type="text"
                                                                    name="addmoreotherinfo[{{ $key }}][title]"
                                                                    value="{{ $infos->title }}" />
                                                                <textarea class="form-control editor{{ $key }}" id=""
                                                                    name="addmoreotherinfo[{{ $key }}][description]">{{ $infos->description }}</textarea>
                                                            </td>
                                                            <td>
                                                                @if ($key == 0)
                                                                    <button class="btn btn-link" id="add-btn-otherinfo"
                                                                        type="button" name="addotherinfo"><span
                                                                            class="badge badge-center rounded-pill bg-primary"><i
                                                                                class="fa-solid fa-plus"></i></span></button>
                                                                @else
                                                                    <button class="btn btn-link remove-tr-otherinfo"
                                                                        type="button"><span
                                                                            class="badge badge-center rounded-pill bg-danger"><i
                                                                                class="fa fa-times"></i></span></button>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td style="width: 95%">
                                                            <input class="form-control mb-3" type="text"
                                                                name="addmoreotherinfo[0][title]"
                                                                placeholder="Enter Title" />
                                                            <textarea class="form-control editor" id="" name="addmoreotherinfo[0][description]"></textarea>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-link" id="add-btn-otherinfo"
                                                                type="button" name="addotherinfo"><span
                                                                    class="badge badge-center rounded-pill bg-primary"><i
                                                                        class="fa-solid fa-plus"></i></span></button>
                                                        </td>
                                                    </tr>
                                                @endif
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input class="form-control" type="hidden" name="parent_id" value="{{ $destination->parent_id }}">

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

        var k = {{ !$destinationOtherinfos->isEmpty() ? array_key_last($destinationOtherinfos->toArray()) : 0 }}
        $("#add-btn-otherinfo").click(function() {
            ++k;
            $("#dynamicAddRemoveOtherInfo").append(
                '<tr><td style="width:95%"><input type="text" name="addmoreotherinfo[' +
                k +
                '][title]" placeholder="Enter Title" class="form-control mb-3" /><textarea name="addmoreotherinfo[' +
                k +
                '][description]" placeholder="" class="form-control editor' + k +
                '"></textarea></td><td><button type="button" class="btn btn-link remove-tr-otherinfo"><span class="badge badge-center rounded-pill bg-danger"><i class="fa fa-times"></i></span></button></td></tr>'
            );
            ckeditor('editor' + k);
        });

        $(document).on('click', '.remove-tr-otherinfo', function() {
            $(this).parents('tr').remove();
        });

        for (let i = 0; i < 15; i++) {
            ckeditor('editor' + i);
        }
    </script>
@endsection
