@extends('layouts.admin.master')
@section('title', 'Payments')

@section('content')
    @include('admin.includes.message')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Payment Gateways ({{ $payments->total() }})</h5>
            <small class="text-muted float-end">
                <a href="{{ route('admin.payments.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i>
                    Create</a>
            </small>
        </div>

        <div class="table-responsive text-nowrap">
            @if ($payments->isNotEmpty())
                <table class="table">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Image</th>
                            <th>Bank Name</th>
                            <th>Bank Holder Name</th>
                            <th>Account Number</th>
                            <th>Branch</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($payments as $key => $payment)
                            <tr>
                                <td><strong>{{ $key + $payments->firstItem() }}</strong></td>
                                <td class="">
                                    <a href="{{ $payment->image ?: 'avatar.png' }}" data-fancybox="demo" class="fancybox">
                                        <img src="{{ $payment->image ?: 'avatar.png' }}" alt="{{ $payment->bank_name }}"
                                            width="80px">
                                    </a>
                                </td>
                                <td><strong>{{ $payment->bank_name ?? '' }}</strong></td>
                                <td>{{ $payment->account_holder_name ?? '' }}</td>
                                <td>{{ $payment->account_number ?? '' }}</td>
                                <td>{{ $payment->branch_address ?? '' }}</td>
                                <td>
                                    <a href="{{ route('admin.payments.edit', $payment->id) }}"
                                        style="float: left;margin-right: 5px;" class="btn btn-sm btn-primary"><i
                                            class="fa-solid fa-pen-to-square"></i> Edit</a>

                                    <form class="delete-form" action="{{ route('admin.payments.destroy', $payment->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger delete_payment mr-2"
                                            id="" title="Delete" data-type="confirm"><i class="fa fa-trash"></i>
                                            Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $payments->links() }}
            @else
                <div class="card-body">
                    <h6>No Data Found!</h6>
                </div>
            @endif
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        $('.delete_payment').click(function(e) {
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
                        $(this).closest("form").submit();
                    }
                });

        });
    </script>
@endsection
