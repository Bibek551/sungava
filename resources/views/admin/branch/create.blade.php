@extends('layouts.admin.master')
@section('title', 'Branches')

@section('content')
    @include('admin.includes.message')

    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Create Branch</h5>
                <small class="text-muted float-end">
                    <a href="{{ route('admin.branches.index') }}" class="btn btn-primary"><i
                            class="fa-solid fa-arrow-left"></i> Back</a>
                </small>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.branches.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label class="form-label" for="basic-default-fullname">Company</label>
                            <input type="text" class="form-control @error('company') is-invalid @enderror" name="company"
                                id="" value="{{ old('company') }}" placeholder="">
                            @error('company')
                                <div class="invalid-feedback" style="display: block;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="basic-default-fullname">Contact Person</label>
                            <input type="text" class="form-control @error('contact_person') is-invalid @enderror"
                                name="contact_person" id="" value="{{ old('contact_person') }}" placeholder="">
                            @error('contact_person')
                                <div class="invalid-feedback" style="display: block;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label class="form-label" for="basic-default-fullname">Location</label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror"
                                name="location" id="" value="{{ old('location') }}" placeholder="">
                            @error('location')
                                <div class="invalid-feedback" style="display: block;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="basic-default-fullname">Order</label>
                            <input type="number" name="order" class="form-control @error('order') is-invalid @enderror"
                                value="{{ old('order') }}">
                            @error('order')
                                <div class="invalid-feedback" style="display: block;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label class="form-label" for="basic-default-fullname">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                                id="" value="{{ old('email') }}" placeholder="">
                            @error('email')
                                <div class="invalid-feedback" style="display: block;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="basic-default-fullname">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                                id="" value="{{ old('phone') }}" placeholder="">
                            @error('phone')
                                <div class="invalid-feedback" style="display: block;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script></script>
@endsection
