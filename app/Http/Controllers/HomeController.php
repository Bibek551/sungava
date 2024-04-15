<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Destination;
use App\Models\Package;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $packages = Package::count();
        $destinations = Destination::count();
        $services = Service::count();
        $blogs = Blog::count();
        return view('admin.dashboard', compact('packages', 'destinations', 'services', 'blogs'));
    }
}
