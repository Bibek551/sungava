@extends('layouts.admin.master')
@section('title', 'Popups')

@section('content')
    @include('admin.includes.message')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Popups ({{ $popups->total() }})</h5>
            <small class="text-muted float-end">
                <a class="btn btn-primary" href="{{ route('admin.popups.create') }}"><i class="fa-solid fa-plus"></i>
                    Create</a>
            </small>
        </div>

        <div class="table-responsive text-nowrap">
            @if ($popups->isNotEmpty())
                <table class="table">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Link</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($popups as $key => $popup)
                            <tr>
                                <td><strong>{{ $key + $popups->firstItem() }}</strong></td>
                                <td class="">
                                    <a class="fancybox" data-fancybox="demo" href="{{ $popup->image ?: 'avatar.png' }}">
                                        <img src="{{ $popup->image ?: 'avatar.png' }}" alt="{{ $popup->title }}"
                                            width="80px">
                                    </a>
                                </td>
                                <td><strong>{{ $popup->title ?? '' }}</strong></td>
                                <td>{{ $popup->link ?? '-' }}</td>
                                <td>{{ $popup->order ?? '' }}</td>
                                <td>
                                    <span
                                        class="badge {{ $popup->status == 0 ? 'bg-label-danger' : 'bg-label-success' }}">{{ $popup->status == 0 ? 'Draft' : 'Published' }}</span>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="{{ route('admin.popups.edit', $popup->id) }}"
                                        style="float: left;margin-right: 5px;"><i class="fa-solid fa-pen-to-square"></i>
                                        Edit</a>

                                    <form class="delete-form" action="{{ route('admin.popups.destroy', $popup->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger delete_popup mr-2" id=""
                                            data-type="confirm" type="submit" title="Delete"><i class="fa fa-trash"></i>
                                            Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $popups->links() }}
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
        $('.delete_popup').click(function(e) {
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
