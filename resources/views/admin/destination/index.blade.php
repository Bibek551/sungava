@extends('layouts.admin.master')
@section('title', 'Destinations')

@section('content')
    @include('admin.includes.message')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            @if ($parentDestination)
                <h5 class="mb-0">Sub-Destinations ({{ $parentDestination->name }})</h5>
            @else
                <h5 class="mb-0">Destinations</h5>
            @endif

            <small class="text-muted float-end">
                @if ($parent == 0)
                    <a href="{{ route('admin.destinations.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i>
                        Create</a>
                @else
                    <a class="btn btn-primary" href="{{ route('admin.destinations.create', ['parent' => $parent]) }}"><i
                            class="fa-solid fa-plus"></i>
                        Create</a>

                    <a href="{{ route('admin.destinations.index') }}" class="btn btn-secondary"><i
                            class="fa-solid fa-arrow-left"></i>
                        Back</a>
                @endif
            </small>
        </div>

        <div class="table-responsive text-nowrap">
            @if ($destinations->isNotEmpty())
                <table class="table">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Order</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($destinations as $key => $destination)
                            <tr>
                                <td><strong>{{ $key + $destinations->firstItem() }}</strong></td>
                                <td class="">
                                    <a href="{{ $destination->image ?: 'avatar.png' }}" data-fancybox="demo"
                                        class="fancybox">
                                        <img src="{{ $destination->image ?: 'avatar.png' }}" alt="{{ $destination->name }}"
                                            width="80px">
                                    </a>
                                </td>
                                <td><strong>{{ $destination->name ?? '' }}</strong></td>
                                <td><span
                                        class="badge {{ $destination->status == 0 ? 'bg-label-danger' : 'bg-label-success' }}">{{ $destination->status == 0 ? 'Draft' : 'Published' }}</span>
                                </td>
                                <td>{{ $destination->order ?? '' }}</td>

                                <td>
                                    <a href="{{ route('admin.destinations.index', ['parent' => $destination->id]) }}"
                                        style="float: left;margin-right: 5px;" class="btn btn-sm btn-dark"><i
                                            class="fa fa-align-justify"></i> Sub/Destination</a>

                                    @if (!$parent)
                                        <a href="{{ route('admin.destinations.edit', $destination->id) }}"
                                            style="float: left;margin-right: 5px;" class="btn btn-sm btn-primary"><i
                                                class="fa-solid fa-pen-to-square"></i> Edit</a>
                                    @else
                                        <a href="{{ route('admin.destinations.edit', ['destination' => $destination->id, 'parent' => $parent]) }}"
                                            style="float: left;margin-right: 5px;" class="btn btn-sm btn-primary"><i
                                                class="fa-solid fa-pen-to-square"></i> Edit</a>
                                    @endif

                                    <form class="delete-form"
                                        action="{{ route('admin.destinations.destroy', $destination->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger delete_destination mr-2"
                                            id="" title="Delete" data-type="confirm"><i class="fa fa-trash"></i>
                                            Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $destinations->links() }}
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
        $('.delete_destination').click(function(e) {
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
