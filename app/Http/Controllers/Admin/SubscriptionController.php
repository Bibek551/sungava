<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index(Request $request)
    {
        $subscriptions = Subscription::when($request->email, function ($query) use ($request) {
            $query->where('email', 'LIKE', '%' . $request->email . '%');
        })->latest()->paginate(20);

        $searchParams =  $_GET ?? '';
        return view('admin.subscription.index', compact('subscriptions', 'searchParams'));
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        return redirect()->route('admin.subscriptions.index')->with('message', 'Delete Successfully');
    }
}
