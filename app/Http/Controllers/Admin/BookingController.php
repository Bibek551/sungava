<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $bookings = Booking::when($request->start_date, function ($query) use ($request) {
            $query->whereDate('trip_date',  '>=', $request->start_date);
        })->when($request->end_date, function ($query) use ($request) {
            $query->whereDate('trip_date',  '<=', $request->end_date);
        })->latest()->paginate(20);

        $searchParams =  $_GET ?? '';
        return view('admin.booking.index', compact('bookings', 'searchParams'));
    }

    public function show(Booking $booking)
    {
        return view('admin.booking.show', compact('booking'));
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.bookings.index')->with('message', 'Delete Successfully');
    }
}
