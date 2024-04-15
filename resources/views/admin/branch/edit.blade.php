@extends('layouts.admin.master')
@section('title', 'Braches')

@section('content')
    @include('admin.includes.message')

    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Branches "{{ $branch->location }}"</h5>
                <small class="text-muted float-end">
                    <a href="{{ route('admin.branches.index') }}" class="btn btn-primary"><i
                            class="fa-solid fa-arrow-left"></i>
                        Back</a>
                </small>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.branches.update', $branch->id) }}"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label class="form-label" for="basic-default-fullname">Company</label>
                            <input type="text" class="form-control @error('company') is-invalid @enderror" name="company"
                                id="" value="{{ old('company', $branch->company) }}" placeholder="">
                            @error('company')
                                <div class="invalid-feedback" style="display: block;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="basic-default-fullname">Contact Person</label>
                            <input type="text" class="form-control @error('contact_person') is-invalid @enderror"
                                name="contact_person" id=""
                                value="{{ old('contact_person', $branch->contact_person) }}" placeholder="">
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
                                value="{{ old('location', $branch->location) }}" name="location" id=""
                                placeholder="">
                            @error('location')
                                <div class="invalid-feedback" style="display: block;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="basic-default-fullname">Order</label>
                            <input type="number" name="order" class="form-control @error('order') is-invalid @enderror"
                                value="{{ old('order', $branch->order) }}">
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
                            <input type="text" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $branch->email) }}" name="email" id="" placeholder="">
                            @error('email')
                                <div class="invalid-feedback" style="display: block;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="basic-default-fullname">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone', $branch->phone) }}" name="phone" id="" placeholder="">
                            @error('phone')
                                <div class="invalid-feedback" style="display: block;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-rotate"></i> Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script></script>
@endsection
