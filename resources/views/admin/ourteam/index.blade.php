@extends('layouts.admin.master')
@section('title', 'Ourteams')

@section('content')
    @include('admin.includes.message')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Ourteams ({{ $ourteams->total() }})</h5>
            <small class="text-muted float-end">
                <a href="{{ route('admin.ourteams.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i>
                    Create</a>
            </small>
        </div>

        <div class="table-responsive text-nowrap">
            @if ($ourteams->isNotEmpty())
                <table class="table">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Order</th>
                            <th>Updated at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($ourteams as $key => $ourteam)
                            <tr>
                                <td><strong>{{ $key + $ourteams->firstItem() }}</strong></td>
                                <td class="">
                                    <a href="{{ $ourteam->image ?: 'avatar.png' }}" data-fancybox="demo" class="fancybox">
                                        <img src="{{ $ourteam->image ?: 'avatar.png' }}" alt="{{ $ourteam->name }}"
                                            width="80px">
                                    </a>
                                </td>
                                <td><strong>{{ $ourteam->name ?? '' }}</strong></td>
                                <td>{{ $ourteam->position ?? '' }}</td>
                                <td>{{ $ourteam->order ?? '' }}</td>
                                <td>{{ $ourteam->updated_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('admin.ourteams.edit', $ourteam->id) }}"
                                        style="float: left;margin-right: 5px;" class="btn btn-sm btn-primary"><i
                                            class="fa-solid fa-pen-to-square"></i> Edit</a>


                                    <form class="delete-form" action="{{ route('admin.ourteams.destroy', $ourteam->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger delete_ourteam mr-2"
                                            id="" title="Delete" data-type="confirm"><i class="fa fa-trash"></i>
                                            Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $ourteams->links() }}
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
        $('.delete_ourteam').click(function(e) {
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
