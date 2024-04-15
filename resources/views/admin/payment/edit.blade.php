@extends('layouts.admin.master')
@section('title', 'Payments')

@section('content')
    @include('admin.includes.message')

    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Payment "{{ $payment->bank_name }}"</h5>
                <small class="text-muted float-end">
                    <a href="{{ route('admin.payments.index') }}" class="btn btn-primary"><i
                            class="fa-solid fa-arrow-left"></i> Back</a>
                </small>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.payments.update', $payment->id) }}"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Bank Name</label>
                        <input type="text" class="form-control @error('bank_name') is-invalid @enderror" name="bank_name"
                            id="" value="{{ old('bank_name', $payment->bank_name) }}" placeholder="">
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
                                    name="account_holder_name" id=""
                                    value="{{ old('account_holder_name', $payment->account_holder_name) }}" placeholder="">
                                @error('account_holder_name')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="basic-default-fullname">Account Number</label>
                                <input type="text" class="form-control @error('account_number') is-invalid @enderror"
                                    name="account_number" id=""
                                    value="{{ old('account_number', $payment->account_number) }}" placeholder="">
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
                                    name="branch_address" id=""
                                    value="{{ old('branch_address', $payment->branch_address) }}" placeholder="">
                                @error('branch_address')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="basic-default-fullname">Swift Code</label>
                                <input type="text" class="form-control @error('swift_code') is-invalid @enderror"
                                    name="swift_code" id="" value="{{ old('swift_code', $payment->swift_code) }}"
                                    placeholder="">
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
                                    name="order" id="" value="{{ old('order', $payment->order) }}"
                                    placeholder="">
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
                            rows="8" placeholder="">{{ old('description', $payment->description) }}</textarea>
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
                        <img src="" height="60" alt="" class="view-image mt-2">
                        @if ($payment->image)
                            <img src="{{ $payment->image }}" width="100" class="mt-2 old-image">

                            <i class="fa fa-times text-danger remove-image cursor-pointer" column="image"
                                module="{{ $payment->id }}" aria-hidden="true"></i>
                        @endif
                        @error('image')
                            <div class="invalid-feedback" style="display: block;">
                                {{ $message }}
                            </div>
                        @enderror
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
                        var entity = 'PaymentGateway';
                        var folder = 'payment';

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
