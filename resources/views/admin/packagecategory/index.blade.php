@extends('layouts.admin.master')
@section('title', 'Package categories')

@section('content')
    @include('admin.includes.message')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Package Categories ({{ $packagecategories->total() }})</h5>
            <small class="text-muted float-end">
                <a href="{{ route('admin.packagecategories.create') }}" class="btn btn-primary"><i
                        class="fa-solid fa-plus"></i>
                    Create</a>
            </small>
        </div>

        <div class="table-responsive text-nowrap">
            @if (!$packagecategories->isEmpty())
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
                        @foreach ($packagecategories as $key => $packagecategory)
                            <tr>
                                <td><strong>{{ $key + $packagecategories->firstItem() }}</strong></td>
                                <td class="">
                                    <a href="{{ $packagecategory->image ?: 'avatar.png' }}" data-fancybox="demo"
                                        class="fancybox">
                                        <img src="{{ $packagecategory->image ?: 'avatar.png' }}"
                                            alt="{{ $packagecategory->name }}" width="80px">
                                    </a>
                                </td>
                                <td><strong>{{ $packagecategory->name ?? '' }}</strong></td>
                                <td><span
                                        class="badge {{ $packagecategory->status == 0 ? 'bg-label-danger' : 'bg-label-success' }}">{{ $packagecategory->status == 0 ? 'Draft' : 'Published' }}</span>
                                </td>
                                <td>{{ $packagecategory->order ?? '' }}</td>

                                <td>{{ $packagecategory->updated_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('admin.packagecategories.edit', $packagecategory->id) }}"
                                        style="float: left;margin-right: 5px;" class="btn btn-sm btn-primary"><i
                                            class="fa-solid fa-pen-to-square"></i> Edit</a>


                                    <form class="delete-form"
                                        action="{{ route('admin.packagecategories.destroy', $packagecategory->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger delete_packagecategory mr-2"
                                            id="" title="Delete" data-type="confirm"><i class="fa fa-trash"></i>
                                            Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $packagecategories->links() }}
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
        $('.delete_packagecategory').click(function(e) {
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
