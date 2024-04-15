@extends('layouts.admin.master')
@section('title', 'Inquiry Persons')

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

                            <input type="text" class="form-control flatpicker" name="end_date"
                                value="{{ request('end_date') ?? '' }}" placeholder="End Date">

                            <button type="submit" class="input-group-text"><i class="tf-icons bx bx-search"></i>
                                Search</button>
                            <a href="{{ route('admin.inquirypersons.index') }}" class="input-group-text"> Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Inquiry Persons ({{ $inquiries->total() }})</h5>
        </div>

        <div class="table-responsive text-nowrap">
            @if (!$inquiries->isEmpty())
                <table class="table">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Message</th>
                            <th>Updated at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($inquiries as $key => $inquiry)
                            <tr>
                                <td><strong>{{ $key + $inquiries->firstItem() }}</strong></td>

                                <td><strong>{{ $inquiry->first_name ?? '' }} {{ $inquiry->last_name ?? '' }}</strong></td>
                                <td>{{ $inquiry->email ?? '' }}</td>
                                <td>{{ $inquiry->phone ?? '' }}</td>
                                <td style="white-space: break-spaces;">{{ $inquiry->message ?? '' }}</td>
                                <td>{{ $inquiry->updated_at->diffForHumans() }}</td>
                                <td>
                                    <form class="delete-form" action="{{ route('admin.inquiries.destroy', $inquiry->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger delete_inquiry mr-2"
                                            id="" title="Delete" data-type="confirm"><i class="fa fa-trash"></i>
                                            Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $inquiries->appends($searchParams)->links() }}
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
        $('.delete_inquiry').click(function(e) {
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
