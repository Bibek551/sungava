@extends('layouts.admin.master')
@section('title', 'Partners')

@section('content')
    @include('admin.includes.message')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Partners ({{ $partners->total() }})</h5>
            <small class="text-muted float-end">
                <a href="{{ route('admin.partners.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i>
                    Create</a>
            </small>
        </div>

        <div class="table-responsive text-nowrap">
            @if ($partners->isNotEmpty())
                <table class="table">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Order</th>
                            <th>Updated at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($partners as $key => $partner)
                            <tr>
                                <td><strong>{{ $key + $partners->firstItem() }}</strong></td>
                                <td class="">
                                    <a href="{{ $partner->image ?: 'avatar.png' }}" data-fancybox="demo" class="fancybox">
                                        <img src="{{ $partner->image ?: 'avatar.png' }}" alt="{{ $partner->name }}"
                                            width="80px">
                                    </a>
                                </td>
                                <td><strong>{{ $partner->name ?? '' }}</strong></td>
                                <td><span
                                        class="badge {{ $partner->status == 0 ? 'bg-label-danger' : 'bg-label-success' }}">{{ $partner->status == 0 ? 'Draft' : 'Published' }}</span>
                                </td>
                                <td>{{ $partner->order ?? '' }}</td>

                                <td>{{ $partner->updated_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('admin.partners.edit', $partner->id) }}"
                                        style="float: left;margin-right: 5px;" class="btn btn-sm btn-primary"><i
                                            class="fa-solid fa-pen-to-square"></i> Edit</a>


                                    <form class="delete-form" action="{{ route('admin.partners.destroy', $partner->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger delete_partner mr-2"
                                            id="" title="Delete" data-type="confirm"><i class="fa fa-trash"></i>
                                            Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $partners->links() }}
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
        $('.delete_partner').click(function(e) {
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
