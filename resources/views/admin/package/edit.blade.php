@extends('layouts.admin.master')
@section('title', 'Packages')

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

    <style>
        .product_category {
            height: 400px;
            overflow-x: scroll;
            border: 1px #ddd solid;
            padding: 15px;
        }

        .panel-header {
            background: #efefef;
            padding: 10px;
            text-align: center;
        }

        .panel-header h4 {
            margin: 0;
        }

        ul li label {
            padding-left: 10px;
        }

        ul {
            list-style: none;
            line-height: 20px !important;
        }
    </style>

    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Package "{{ $package->name }}"</h5>
                <small class="text-muted float-end">
                    <a class="btn btn-primary" href="{{ route('admin.packages.index') }}"><i
                            class="fa-solid fa-arrow-left"></i>
                        Back</a>
                </small>
            </div>
            <div class="card-body">
                <form class="row" method="POST" action="{{ route('admin.packages.update', $package->id) }}"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="col-md-8">
                        <div class="card card-body main-description shadow br-8 p-4">
                            <div class="form-group mb-3">
                                <label class="form-label" for="basic-default-fullname">Name</label>
                                <input class="form-control @error('name') is-invalid @enderror" id=""
                                    type="text" name="name" value="{{ old('name', $package->name) }}" placeholder="">
                                @error('name')
                                    <div class="invalid-feedback" style="display: block;">
                                        *{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label class="form-label" for="basic-default-fullname">Adult Price (/person)</label>
                                    <input class="form-control @error('adult_price') is-invalid @enderror" type="text"
                                        name="adult_price" value="{{ old('adult_price', $package->adult_price) }}">
                                    @error('adult_price')
                                        <div class="invalid-feedback" style="display: block;">
                                            *{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label" for="basic-default-fullname">Fair Price (/person)</label>
                                    <input class="form-control @error('fair_price') is-invalid @enderror" type="text"
                                        name="fair_price" value="{{ old('fair_price', $package->fair_price) }}">
                                    @error('fair_price')
                                        <div class="invalid-feedback" style="display: block;">
                                            *{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label" for="basic-default-fullname">Duration</label>
                                    <input class="form-control @error('duration') is-invalid @enderror" type="text"
                                        name="duration" value="{{ old('duration', $package->duration) }}">
                                    @error('duration')
                                        <div class="invalid-feedback" style="display: block;">
                                            *{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label" for="basic-default-fullname">Currency</label>
                                    <input class="form-control @error('currency') is-invalid @enderror" type="text"
                                        name="currency" value="{{ old('currency', $package->currency) }}">
                                    @error('currency')
                                        <div class="invalid-feedback" style="display: block;">
                                            *{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="basic-default-message">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror ckeditor" id="" name="description"
                                    rows="8" placeholder="">{{ old('description', $package->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback" style="display: block;">
                                        *{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="basic-default-message">Short Description</label>
                                <textarea class="form-control @error('short_description') is-invalid @enderror" id="" name="short_description"
                                    rows="6" placeholder="">{{ old('short_description', $package->short_description) }}</textarea>
                                @error('short_description')
                                    <div class="invalid-feedback" style="display: block;">
                                        *{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        @include('admin.package.includes.destinations')
                        <div class="card-body card shadow br-8 my-3">
                            <div class="form-group mb-3">
                                <label class="form-label" for="basic-default-fullname">Rating</label>
                                <input class="form-control @error('rating') is-invalid @enderror" type="number"
                                    min="1" max="5" name="rating"
                                    value="{{ old('rating', $package->rating) }}">

                                @error('rating')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <hr class="shadow-sm">
                            <div class="form-group mb-3">
                                <label class="form-label" for="basic-default-fullname">Status</label>
                                <select class="form-select @error('status') is-invalid @enderror" id=""
                                    name="status">
                                    <option {{ $package->status == 1 ? 'selected' : '' }} value="1">Published
                                    </option>
                                    <option {{ $package->status == 0 ? 'selected' : '' }} value="0">Draft</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback" style="display: block;">
                                        *{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <hr class="shadow-sm">
                            <div class="form-group mb-3">
                                <label class="form-label" for="basic-default-fullname">Category</label>
                                <select class="form-select @error('package_category_id') is-invalid @enderror"
                                    id="" name="package_category_id">
                                    <option value="">Select Category</option>
                                    @foreach ($packagecategories as $category)
                                        <option {{ $category->id == $package->package_category_id ? 'selected' : '' }}
                                            value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('package_category_id')
                                    <div class="invalid-feedback" style="display: block;">
                                        *{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <hr class="shadow-sm">
                            <div class="form-group mb-3">
                                <label class="form-label" for="basic-default-message">Thumbnail (IMAGE)</label>
                                <input class="form-control @error('image') is-invalid @enderror image" id=""
                                    type="file" name="image">
                                <img class="view-image mt-2" src="" height="60" alt="">
                                @if ($package->image)
                                    <img class="mt-2 old-image" src="{{ $package->image }}" width="100">
                                @endif
                                @error('image')
                                    <div class="invalid-feedback" style="display: block;">
                                        *{{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="card card-body my-3 mx-3 shadow br-8 p-4">
                            <ul class="nav nav-tabs px-4" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="itinerary-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-itinerary" type="button" role="tab"
                                        aria-controls="itinerary" aria-selected="true">ITINERARY</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="services-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-services" type="button" role="tab"
                                        aria-controls="services" aria-selected="false">SERVICES</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="inclusionexclusion-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-inclusionexclusion" type="button" role="tab"
                                        aria-controls="inclusionexclusion"
                                        aria-selected="false">INCLUSION/EXCLUSION</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="activity-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-activity" type="button" role="tab"
                                        aria-controls="activity" aria-selected="false">ACTIVITY</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="seo-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-seo" type="button" role="tab" aria-controls="seo"
                                        aria-selected="false">SEO</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="otherinfo-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-otherinfo" type="button" role="tab"
                                        aria-controls="otherinfo" aria-selected="false">OTHER INFORMATION</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-itinerary" role="tabpanel"
                                    aria-labelledby="nav-itinerary-tab">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-border" id="dynamicAddRemove" style="width:100%">
                                                <tr>
                                                    <th>Itinerary Content</th>
                                                    <th>Action</th>
                                                </tr>
                                                @if (!$packageItenary->isEmpty())
                                                    @foreach ($packageItenary as $key => $iternary)
                                                        <tr>
                                                            <td style="width: 95%">
                                                                <input class="form-control mb-3" type="text"
                                                                    name="addmore[{{ $key }}][title]"
                                                                    value="{{ $iternary->title }}" />
                                                                <textarea class="form-control itineraryeditor{{ $key }}" id=""
                                                                    name="addmore[{{ $key }}][description]" cols="20" rows="3">{{ $iternary->description }}</textarea>
                                                            </td>
                                                            <td>
                                                                @if ($key == 0)
                                                                    <button class="btn btn-link" id="add-btn"
                                                                        type="button" name="add"><span
                                                                            class="badge badge-center rounded-pill bg-primary"><i
                                                                                class="fa-solid fa-plus"></i></span></button>
                                                                @else
                                                                    <button class="btn btn-link remove-tr"
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
                                                                name="addmore[0][title]" placeholder="Enter Title" />
                                                            <textarea class="form-control itineraryeditor" id="" name="addmore[0][description]" cols="20"
                                                                rows="3"></textarea>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-link" id="add-btn" type="button"
                                                                name="add"><span
                                                                    class="badge badge-center rounded-pill bg-primary"><i
                                                                        class="fa-solid fa-plus"></i></span></button>
                                                        </td>
                                                    </tr>
                                                @endif
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-services" role="tabpanel"
                                    aria-labelledby="nav-services-tab">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-border" id="dynamicAddRemoveService"
                                                style="width:100%">
                                                <tr>
                                                    <th>Service Content</th>
                                                    <th>Price</th>
                                                    <th>Action</th>
                                                </tr>
                                                @if (!$packageServices->isEmpty())
                                                    @foreach ($packageServices as $k => $servic)
                                                        <tr>
                                                            <td style="width: 60%">
                                                                <input class="form-control mb-2" type="text"
                                                                    name="addmoreservice[{{ $k }}][service]"
                                                                    value="{{ $servic->service }}" />
                                                            </td>
                                                            <td style="30%">
                                                                <input class="form-control mb-2" type="text"
                                                                    name="addmoreservice[{{ $k }}][price]"
                                                                    value="{{ $servic->price }}" />
                                                            </td>
                                                            <td>
                                                                @if ($k == 0)
                                                                    <button class="btn btn-link" id="add-btn-service"
                                                                        type="button" name="addservice"><span
                                                                            class="badge badge-center rounded-pill bg-primary"><i
                                                                                class="fa-solid fa-plus"></i></span></button>
                                                                @else
                                                                    <button class="btn btn-link remove-tr-service"
                                                                        type="button"><span
                                                                            class="badge badge-center rounded-pill bg-danger"><i
                                                                                class="fa fa-times"></i></span></button>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td style="width: 60%">
                                                            <input class="form-control mb-2" type="text"
                                                                name="addmoreservice[0][service]"
                                                                placeholder="Enter Service" />
                                                        </td>
                                                        <td style="width: 30%">
                                                            <input class="form-control mb-2" type="text"
                                                                name="addmoreservice[0][price]"
                                                                placeholder="Enter Price" />
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-link" id="add-btn-service"
                                                                type="button" name="addservice"><span
                                                                    class="badge badge-center rounded-pill bg-primary"><i
                                                                        class="fa-solid fa-plus"></i></span></button>
                                                        </td>
                                                    </tr>
                                                @endif
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-inclusionexclusion" role="tabpanel"
                                    aria-labelledby="nav-inclusionexclusion-tab">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="basic-default-fullname">Inclusion</label>
                                        <textarea class="form-control ixckeditor" id="" name="inclusion" cols="30" rows="10"> {{ old('inclusion', $package->inclusion) }}</textarea>
                                        @error('inclusion')
                                            <div class="invalid-feedback" style="display: block;">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label" for="basic-default-fullname">Exclusion</label>
                                        <textarea class="form-control exckeditor" id="" name="exclusion" cols="30" rows="10"> {{ old('exclusion', $package->exclusion) }}</textarea>
                                        @error('exclusion')
                                            <div class="invalid-feedback" style="display: block;">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-activity" role="tabpanel"
                                    aria-labelledby="nav-activity-tab">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label" for="basic-default-fullname">Activities</label>
                                            <input class="form-control @error('activities') is-invalid @enderror"
                                                type="text" name="activities"
                                                value="{{ old('activities', $packageActivities->activities ?? '') }}">
                                            @error('activities')
                                                <div class="invalid-feedback" style="display: block;">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label" for="basic-default-fullname">Trip Grade
                                            </label>
                                            <input class="form-control @error('trip_grade') is-invalid @enderror"
                                                type="text" name="trip_grade"
                                                value="{{ old('trip_grade', $packageActivities->trip_grade ?? null) }}">
                                            @error('trip_grade')
                                                <div class="invalid-feedback" style="display: block;">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label" for="basic-default-fullname">Trip Type
                                            </label>
                                            <input class="form-control @error('trip_type') is-invalid @enderror"
                                                type="text" name="trip_type"
                                                value="{{ old('trip_type', $packageActivities->trip_type ?? null) }}">
                                            @error('trip_type')
                                                <div class="invalid-feedback" style="display: block;">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label" for="basic-default-fullname">Trip Mode
                                            </label>
                                            <input class="form-control @error('trip_mode') is-invalid @enderror"
                                                type="text" name="trip_mode"
                                                value="{{ old('trip_mode', $packageActivities->trip_mode ?? null) }}">
                                            @error('trip_mode')
                                                <div class="invalid-feedback" style="display: block;">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label" for="basic-default-fullname">Trip Duration
                                            </label>
                                            <input class="form-control @error('trip_duration') is-invalid @enderror"
                                                type="text" name="trip_duration"
                                                value="{{ old('trip_duration', $packageActivities->trip_duration ?? null) }}">
                                            @error('trip_duration')
                                                <div class="invalid-feedback" style="display: block;">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label" for="basic-default-fullname">Accomodation
                                            </label>
                                            <input class="form-control @error('accomodation') is-invalid @enderror"
                                                type="text" name="accomodation"
                                                value="{{ old('accomodation', $packageActivities->accomodation ?? null) }}">
                                            @error('accomodation')
                                                <div class="invalid-feedback" style="display: block;">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label" for="basic-default-fullname">Best Season
                                            </label>
                                            <input class="form-control @error('best_season') is-invalid @enderror"
                                                type="text" name="best_season"
                                                value="{{ old('best_season', $packageActivities->best_season ?? null) }}">
                                            @error('best_season')
                                                <div class="invalid-feedback" style="display: block;">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label" for="basic-default-fullname">Group Size
                                            </label>
                                            <input class="form-control @error('group_size') is-invalid @enderror"
                                                type="text" name="group_size"
                                                value="{{ old('group_size', $packageActivities->group_size ?? null) }}">
                                            @error('group_size')
                                                <div class="invalid-feedback" style="display: block;">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label" for="basic-default-fullname">Transportation
                                            </label>
                                            <input class="form-control @error('transportation') is-invalid @enderror"
                                                type="text" name="transportation"
                                                value="{{ old('transportation', $packageActivities->transportation ?? null) }}">
                                            @error('transportation')
                                                <div class="invalid-feedback" style="display: block;">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-seo" role="tabpanel" aria-labelledby="nav-seo-tab">
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-default-fullname">Seo Title</label>
                                        <input class="form-control @error('seo_title') is-invalid @enderror"
                                            id="" type="text" name="seo_title"
                                            value="{{ old('seo_title', $package->seo_title) }}" placeholder="">
                                        @error('seo_title')
                                            <div class="invalid-feedback" style="display: block;">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="basic-default-fullname">Meta Description</label>
                                        <textarea class="form-control @error('meta_description') is-invalid @enderror" id=""
                                            name="meta_description" cols="30" rows="10">{{ old('meta_description', $package->meta_description) }}</textarea>
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
                                            value="{{ old('meta_keywords', $package->meta_keywords) }}" placeholder="">
                                        @error('meta_keywords')
                                            <div class="invalid-feedback" style="display: block;">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-otherinfo" role="tabpanel"
                                    aria-labelledby="nav-otherinfo-tab">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-border" id="dynamicAddRemoveOtherInfo"
                                                style="width:100%">
                                                <tr>
                                                    <th>Other Information</th>
                                                    <th>Action</th>
                                                </tr>
                                                @if (!$packageOtherinfos->isEmpty())
                                                    @foreach ($packageOtherinfos as $key => $infos)
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

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-arrow-right"
                                aria-hidden="true"></i>
                            Next</button>
                    </div>
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


        var i = {{ !$packageItenary->isEmpty() ? array_key_last($packageItenary->toArray()) : 0 }}
        // var i = 0;
        $("#add-btn").click(function() {
            ++i;
            $("#dynamicAddRemove").append('<tr><td style="width:95%"><input type="text" name="addmore[' + i +
                '][title]" placeholder="Enter Title" class="form-control mb-3" /><textarea name="addmore[' +
                i +
                '][description]" placeholder="" class="form-control itineraryeditor' + i +
                '" cols="20" rows="3"></textarea></td><td><button type="button" class="btn btn-link remove-tr"><span class="badge badge-center rounded-pill bg-danger"><i class="fa fa-times"></i></span></button></td></tr>'
            );
            ckeditor('itineraryeditor' + i);
        });

        $(document).on('click', '.remove-tr', function() {
            $(this).parents('tr').remove();
        });

        var j = {{ !$packageServices->isEmpty() ? array_key_last($packageServices->toArray()) : 0 }}
        // var i = 0;
        $("#add-btn-service").click(function() {
            ++j;
            $("#dynamicAddRemoveService").append(
                '<tr><td style="width:60%"><input type="text" name="addmoreservice[' + j +
                '][service]" placeholder="Enter Service" class="form-control mb-2" /><td style="width:30%"><input type="text" name="addmoreservice[' +
                j +
                '][price]" placeholder="Enter Price" class="form-control mb-2" /></td><td><button type="button" class="btn btn-link remove-tr-service"><span class="badge badge-center rounded-pill bg-danger"><i class="fa fa-times"></i></span></button></td></tr>'
            );
        });

        $(document).on('click', '.remove-tr-service', function() {
            $(this).parents('tr').remove();
        });

        var k = {{ !$packageOtherinfos->isEmpty() ? array_key_last($packageOtherinfos->toArray()) : 0 }}
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


        for (let z = 0; z < 10; z++) {
            ckeditor('editor' + z);
        }

        for (let t = 0; t < 30; t++) {
            ckeditor('itineraryeditor' + t);
        }
    </script>
@endsection
