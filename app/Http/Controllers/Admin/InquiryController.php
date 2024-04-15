<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index(Request $request)
    {
        $inquiries = Inquiry::when($request->start_date, function ($query) use ($request) {
            $query->whereDate('created_at',  '>=', $request->start_date);
        })->when($request->end_date, function ($query) use ($request) {
            $query->whereDate('created_at',  '<=', $request->end_date);
        })->latest()->paginate(10);

        $searchParams =  $_GET ?? '';
        return view('admin.inquiry.index', compact('inquiries', 'searchParams'));
    }

    public function destroy(Inquiry $inquiryperson)
    {
        $inquiryperson->delete();
        return redirect()->route('admin.inquirypersons.index')->with('message', 'Delete Successfully');
    }
}
