@extends('layouts.admin.master')
@section('title', 'Packages')

@section('content')
    @include('admin.includes.message')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Package "{{ $package->name ?? '' }}"</h5>
            <small class="text-muted float-end">
                <a class="btn btn-primary" href="{{ route('admin.packages.index') }}"><i class="fa-solid fa-arrow-left"></i>
                    Back</a>
            </small>
        </div>

        <div class="container">
            <div class="table-responsive text-nowrap">
                <fieldset class="border p-3 border-muted mb-3">
                    <legend class="float-none w-auto legend-title">General</legend>
                    <table class="table table-borderless">
                        <tbody class="table-border-bottom-0">
                            <tr>
                                <th>THUMBNAIL</th>
                                <td><a class="fancybox" data-fancybox="demo" href="{{ $package->image ?: 'avatar.png' }}">
                                        <img src="{{ $package->image ?: 'avatar.png' }}" alt="{{ $package->name }}"
                                            width="80px">
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <th>Name</th>
                                <td><strong>{{ $package->name ?? '' }}</strong></td>
                            </tr>
                            <tr>
                                <th>Category</th>
                                <td>{{ $package->category->name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Price</th>
                                <td>{{ $package->adult_price ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Fair Price</th>
                                <td>{{ $package->fair_price ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Duration</th>
                                <td>{{ $package->duration ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Destination</th>
                                <td>
                                    @foreach ($package->destinations as $destination)
                                        <span class="badge bg-label-primary"> {{ $destination->name ?? '-' }}</span>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <span
                                        class="badge {{ $package->status == 0 ? 'bg-label-danger' : 'bg-label-success' }}">{{ $package->status == 0 ? 'Draft' : 'Published' }}</span>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </fieldset>

                @if (!$package->itenaries->isEmpty())
                    <div class="mb-3">
                        <fieldset class="border p-3 border-muted">
                            <legend class="float-none w-auto legend-title">Package Itinerary</legend>
                            <table class="table table-borderless">
                                <tr>
                                    <th>Day</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                </tr>
                                @foreach ($package->itenaries as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->title ?? '' }}</td>
                                        <td style="white-space: normal">{{ $item->description ?? '' }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </fieldset>
                    </div>
                @endif

                @if (!$package->services->isEmpty())
                    <div class="mb-3">
                        <fieldset class="border p-3 border-muted">
                            <legend class="float-none w-auto legend-title">Package Services</legend>
                            <table class="table table-borderless">
                                <tr>
                                    <th>SN</th>
                                    <th>Service</th>
                                    <th>Price</th>
                                </tr>
                                @foreach ($package->services as $k => $serv)
                                    <tr>
                                        <td>{{ $k + 1 }}</td>
                                        <td>{{ $serv->service ?? '' }}</td>
                                        <td>{{ $serv->price ?? '' }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </fieldset>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script></script>
@endsection
