@extends('layouts.admin.master')
@section('title', 'Payments')

@section('content')
    @include('admin.includes.message')

    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Create Payment Gateway</h5>
                <small class="text-muted float-end">
                    <a href="{{ route('admin.payments.index') }}" class="btn btn-primary"><i
                            class="fa-solid fa-arrow-left"></i> Back</a>
                </small>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.payments.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Bank Name</label>
                        <input type="text" class="form-control @error('bank_name') is-invalid @enderror" name="bank_name"
                            id="" value="{{ old('bank_name') }}" placeholder="">
                        @error('bank_name')
                            <div class="invalid-feedback" style="display: block;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="basic-default-fullname">Account Holder's Name</label>
                                <input type="text"
                                    class="form-control @error('account_holder_name') is-invalid @enderror"
                                    name="account_holder_name" id="" value="{{ old('account_holder_name') }}"
                                    placeholder="">
                                @error('account_holder_name')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="basic-default-fullname">Account Number</label>
                                <input type="text" class="form-control @error('account_number') is-invalid @enderror"
                                    name="account_number" id="" value="{{ old('account_number') }}" placeholder="">
                                @error('account_number')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="basic-default-fullname">Branch Address</label>
                                <input type="text" class="form-control @error('branch_address') is-invalid @enderror"
                                    name="branch_address" id="" value="{{ old('branch_address') }}" placeholder="">
                                @error('branch_address')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="basic-default-fullname">Swift Code</label>
                                <input type="text" class="form-control @error('swift_code') is-invalid @enderror"
                                    name="swift_code" id="" value="{{ old('swift_code') }}" placeholder="">
                                @error('swift_code')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
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
                        <input type="file" class="form-control @error('image') is-invalid @enderror image" name="image"
                            id="">
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
