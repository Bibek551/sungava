@extends('layouts.admin.master')
@section('title', 'Bookings')

@section('content')
    @include('admin.includes.message')
    <div class="card">
        <div class="row mt-3 mb-0 m-2">
            <div class="col-md-9">
                <form class="d-flex" method="GET" action="">
                    <div class="col-md-10">
                        <div class="input-group gap-2">
                            <input class="form-control flatpicker" name="start_date" type="" placeholder="Start Date"
                                value="{{ request('start_date') ?? '' }}" aria-label="Search">
                            <input class="form-control flatpicker" type="text" name="end_date"
                                value="{{ request('end_date') ?? '' }}" placeholder="End Date">
                            <button class="input-group-text" type="submit"><i class="tf-icons bx bx-search"></i>
                                Search</button>
                            <a class="input-group-text" href="{{ route('admin.bookings.index') }}"> Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Bookings Persons ({{ $bookings->total() }})</h5>
        </div>

        <div class="table-responsive text-nowrap">
            @if ($bookings->isNotEmpty())
                <table class="table">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Full Name</th>
                            <th>Package</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($bookings as $key => $booking)
                            <tr>
                                <td><strong>{{ $key + $bookings->firstItem() }}</strong></td>

                                <td><strong>{{ $booking->full_name ?? '' }}</strong></td>
                                <td>{{ $booking->package->name ?? '-' }}</td>
                                <td>{{ $booking->phone ?? '-' }}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary"
                                        href="{{ route('admin.bookings.show', $booking->id) }}"
                                        style="float: left;margin-right: 5px;"><i class="fa-solid fa-eye"></i> Show</a>
                                    <form class="delete-form" action="{{ route('admin.bookings.destroy', $booking->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger delete_booking mr-2" id=""
                                            data-type="confirm" type="submit" title="Delete"><i class="fa fa-trash"></i>
                                            Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $bookings->appends($searchParams)->links() }}
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
        $('.delete_booking').click(function(e) {
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
