@extends('layouts.admin.master')
@section('title', 'Packages')

@section('content')
    @include('admin.includes.message')
    <div class="card">
        <div class="row mt-3 mb-0 m-2">
            <div class="col-md-9">
                <form class="d-flex" method="GET" action="">
                    <div class="col-md-10">
                        <div class="input-group gap-2">
                            <input class="form-control search-input" name="search" type="text" placeholder="Search ..."
                                value="{{ request('search') ?? '' }}" aria-label="Search" autocomplete="off">

                            <button type="submit" class="input-group-text"><i class="tf-icons bx bx-search"></i>
                                Search</button>
                            <a href="{{ route('admin.packages.index') }}" class="input-group-text"> Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Packages ({{ $packages->total() }})</h5>
            <small class="text-muted float-end">
                <a href="{{ route('admin.packages.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i>
                    Create</a>
            </small>
        </div>

        <div class="table-responsive text-nowrap">
            @if ($packages->isNotEmpty())
                <table class="table">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Thumbnail</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($packages as $key => $package)
                            <tr>
                                <td><strong>{{ $key + $packages->firstItem() }}</strong></td>
                                <td class="">
                                    <a href="{{ $package->image ?: 'avatar.png' }}" data-fancybox="demo" class="fancybox">
                                        <img src="{{ $package->image ?: 'avatar.png' }}" alt="{{ $package->name }}"
                                            width="80px">
                                    </a>
                                </td>
                                <td><strong>{{ $package->name ?? '' }}</strong></td>
                                <td>{{ $package->category->name ?? '-' }}</td>

                                <td>
                                    {{ price_format($package->adult_price) ?? '-' }}</td>
                                <td><span
                                        class="badge {{ $package->status == 0 ? 'bg-label-danger' : 'bg-label-success' }}">{{ $package->status == 0 ? 'Draft' : 'Published' }}</span>
                                </td>

                                <td>
                                    <a href="{{ route('admin.packages.show', $package->id) }}"
                                        style="float: left;margin-right: 5px;" class="btn btn-sm btn-warning"><i
                                            class="fa fa-eye"></i> Show</a>

                                    <a href="{{ route('admin.packages.edit', $package->id) }}"
                                        style="float: left;margin-right: 5px;" class="btn btn-sm btn-primary"><i
                                            class="fa-solid fa-pen-to-square"></i> Edit</a>

                                    <form class="delete-form" action="{{ route('admin.packages.destroy', $package->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger delete_package mr-2"
                                            id="" title="Delete" data-type="confirm"><i class="fa fa-trash"></i>
                                            Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $packages->appends($searchParams)->links() }}
            @else
                <div class="card-body">
                    <h6>No Package Data Found!</h6>
                </div>
            @endif
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        $('.delete_package').click(function(e) {
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
