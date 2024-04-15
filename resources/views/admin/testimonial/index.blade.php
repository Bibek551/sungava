@extends('layouts.admin.master')
@section('title', 'Testimonials')

@section('content')
    @include('admin.includes.message')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Testimonials ({{ $testimonials->total() }})</h5>
            <small class="text-muted float-end">
                <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i>
                    Create</a>
            </small>
        </div>

        <div class="table-responsive text-nowrap">
            @if (!$testimonials->isEmpty())
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
                        @foreach ($testimonials as $key => $testimonial)
                            <tr>
                                <td><strong>{{ $key + $testimonials->firstItem() }}</strong></td>
                                <td class="">
                                    <a href="{{ $testimonial->image ?: 'avatar.png' }}" data-fancybox="demo"
                                        class="fancybox">
                                        <img src="{{ $testimonial->image ?: 'avatar.png' }}" alt="{{ $testimonial->name }}"
                                            width="80px">
                                    </a>
                                </td>
                                <td><strong>{{ $testimonial->name ?? '' }}</strong></td>
                                <td>{{ $testimonial->position ?? '' }}</td>
                                <td>{{ $testimonial->order ?? '' }}</td>

                                <td>{{ $testimonial->updated_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}"
                                        style="float: left;margin-right: 5px;" class="btn btn-sm btn-primary"><i
                                            class="fa-solid fa-pen-to-square"></i> Edit</a>


                                    <form class="delete-form"
                                        action="{{ route('admin.testimonials.destroy', $testimonial->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger delete_testimonial mr-2"
                                            id="" title="Delete" data-type="confirm"><i class="fa fa-trash"></i>
                                            Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $testimonials->links() }}
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
        $('.delete_testimonial').click(function(e) {
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
