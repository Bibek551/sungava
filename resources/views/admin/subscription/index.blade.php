@extends('layouts.admin.master')
@section('title', 'Subscription')

@section('content')
    @include('admin.includes.message')
    <div class="card">
        <div class="row mt-3 mb-0 m-2">
            <div class="col-md-9">
                <form class="d-flex" method="GET" action="">
                    <div class="col-md-10">
                        <div class="input-group gap-2">
                            <input class="form-control" name="email" type="" placeholder="Email"
                                value="{{ request('email') ?? '' }}" aria-label="Search">

                            <button class="input-group-text" type="submit"><i class="tf-icons bx bx-search"></i>
                                Search</button>
                            <a class="input-group-text" href="{{ route('admin.subscriptions.index') }}"> Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Subscriptions ({{ $subscriptions->total() }})</h5>
        </div>

        <div class="table-responsive text-nowrap">
            @if ($subscriptions->isNotEmpty())
                <table class="table">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Email</th>
                            <th>Updated at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($subscriptions as $key => $subscription)
                            <tr>
                                <td><strong>{{ $key + $subscriptions->firstItem() }}</strong></td>

                                <td><strong>{{ $subscription->email ?? '' }}</strong></td>

                                <td>{{ $subscription->updated_at->diffForHumans() }}</td>
                                <td>
                                    <form class="delete-form"
                                        action="{{ route('admin.subscriptions.destroy', $subscription->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger delete_subscription mr-2" id=""
                                            data-type="confirm" type="submit" title="Delete"><i class="fa fa-trash"></i>
                                            Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $subscriptions->appends($searchParams)->links() }}
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
        $('.delete_subscription').click(function(e) {
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
