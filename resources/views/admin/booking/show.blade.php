@extends('layouts.admin.master')
@section('title', 'Bookings')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Orders "{{ $booking->first_name ?? '' }}"</h5>
            <small class="text-muted float-end">
                <a class="btn btn-primary" href="{{ route('admin.bookings.index') }}"><i class="fa-solid fa-arrow-left"></i>
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
                                <th>Full Name</th>
                                <td><strong>{{ $booking->full_name ?? '' }}</strong></td>
                            </tr>
                            <tr>
                                <th>Package</th>
                                <td>{{ $booking->package->name ?? '-' }}</td>
                            </tr>

                            <tr>
                                <th>Email</th>
                                <td>{{ $booking->email ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{ $booking->phone ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Message</th>
                                <td>{{ $booking->comments ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </fieldset>
            </div>
        </div>
    </div>

@endsection
