<?php

namespace App\Http\Controllers;

use App\Mail\NotifyAdmin;
use App\Models\Blog;
use App\Models\Booking;
use App\Models\Branch;
use App\Models\Destination;
use App\Models\Faq;
use App\Models\Inquiry;
use App\Models\ItenaryPackage;
use App\Models\Menu;
use App\Models\MenuLocation;
use App\Models\OurTeam;
use App\Models\Package;
use App\Models\PackageCategory;
use App\Models\Page;
use App\Models\Partner;
use App\Models\PaymentGateway;
use App\Models\Popup;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\SocialMedia;
use App\Models\Subscription;
use App\Models\Terms;
use App\Models\Testimonial;
use App\Models\WhyChooseUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDF;
use Illuminate\Support\Facades\Mail;


use Dompdf\Dompdf;
use Dompdf\Options;


class ApiController extends Controller
{
    public function destinationIndex()
    {
        try {
            $destinations = Destination::where('status', 1)->where('parent_id', 0)->oldest('order')->get();

            foreach ($destinations as $key => $destination) {
                $destination['children'] = $destination->children;
                $destination['otherinfos'] = $destination->otherinfos ?? NULL;

                if ($destination->children) {
                    foreach ($destination->children  as $key => $c) {
                        $c['children'] = $c->children ?? NULL;
                        $c['otherinfos'] = $c->otherinfos ?? NULL;
                    }
                }
            }

            return response()->json([
                "statusCode" => 200,
                "error" => false,
                "data" => $destinations,
                'message' => 'Retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function singleDestination($slug)
    {
        try {
            $destination = Destination::where('slug', $slug)->first();
            $destination['children'] = $destination->children;

            return response()->json([
                "statusCode" => 200,
                "error" => false,
                "data" => $destination,
                'message' => 'Retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function packageCategoryIndex()
    {
        try {
            $packagecategories = PackageCategory::where('status', 1)->latest()->get();

            return response()->json([
                "statusCode" => 200,
                "error" => false,
                "data" => $packagecategories,
                'message' => 'Retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function singlePackageCategory($slug)
    {
        try {
            $PackageCategory = PackageCategory::where('slug', $slug)->first();

            return response()->json([
                "statusCode" => 200,
                "error" => false,
                "data" => $PackageCategory,
                'message' => 'Retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function packageIndex()
    {
        try {
            $packages = Package::where('status', 1)->with('galleries', 'destinations', 'category', 'itenaries', 'services', 'activity', 'otherinfos')->get();

            return response()->json([
                "statusCode" => 200,
                "error" => false,
                "data" => $packages,
                'message' => 'Retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function singlePackage($slug)
    {
        try {
            $package = Package::with('galleries', 'destinations', 'category', 'itenaries', 'services', 'activity', 'otherinfos')->where('slug', $slug)->first();

            return response()->json([
                "statusCode" => 200,
                "error" => false,
                "data" => $package,
                'message' => 'Retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function blogIndex()
    {
        try {
            $blogs =  Blog::query()->with(['category' => function ($query) {
                $query->select('id', 'name');
            }])->latest()->get();

            foreach ($blogs as $blog) {
                $blog['date'] = $blog->date ? date('F d, Y', strtotime($blog->date)) : null;
            }

            return response()->json([
                "statusCode" => 200,
                "error" => false,
                "data" => $blogs,
                'message' => 'Retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function singleBlog($slug)
    {
        try {
            $blog =  Blog::query()->with(['category' => function ($query) {
                $query->select('id', 'name');
            }])->where('slug', $slug)->first();

            $blog['date'] = $blog->date ? date('F d, Y', strtotime($blog->date)) : null;

            return response()->json([
                "statusCode" => 200,
                "error" => false,
                "data" => $blog,
                'message' => 'Retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function serviceIndex()
    {
        try {
            $services = Service::latest()->get();
            return response()->json([
                "statusCode" => 200,
                "error" => false,
                "data" => $services,
                'message' => 'Retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function singleService($slug)
    {
        try {
            $service = Service::where('slug', $slug)->first();
            return response()->json([
                "statusCode" => 200,
                "error" => false,
                "data" => $service,
                'message' => 'Retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function ourTeamIndex()
    {
        try {
            $ourteams = OurTeam::oldest('order')->get();

            return response()->json([
                "statusCode" => 200,
                "error" => false,
                "data" => $ourteams,
                'message' => 'Retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function faqIndex()
    {
        try {
            $faqs = Faq::oldest('order')->get();

            return response()->json([
                "statusCode" => 200,
                "error" => false,
                "data" => $faqs,
                'message' => 'Retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function inquiryStore(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'message' => 'required'
            ]);


            if ($validation->fails()) {
                return response()->json(['statusCode' => 401, 'error' => true, 'error_message' => $validation->errors(), 'message' => 'Please fill the input field properly']);
            }

            Inquiry::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'message' => $request->message,
            ]);

            return response()->json([
                "statusCode" => 200,
                "error" => false,
                'message' => 'Thank you, your enquiry has been submitted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function pageIndex()
    {
        try {
            $pages = Page::latest()->get();

            return response()->json([
                "statusCode" => 200,
                "error" => false,
                "data" => $pages,
                'message' => 'Retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function singlePage($slug)
    {
        try {
            $page = Page::where('slug', $slug)->first();
            return response()->json([
                "statusCode" => 200,
                "error" => false,
                "data" => $page,
                'message' => 'Retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function socialMediaIndex()
    {
        try {
            $socialmedias = SocialMedia::oldest('order')->get();

            return response()->json([
                "statusCode" => 200,
                "error" => false,
                "data" => $socialmedias,
                'message' => 'Retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function partnerIndex()
    {
        try {
            $partners = Partner::oldest('order')->where('status', 1)->get();
            return response()->json([
                "statusCode" => 200,
                "error" => false,
                "data" => $partners,
                'message' => 'Retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function branchIndex()
    {
        try {
            $branches = Branch::oldest('order')->get();

            return response()->json([
                "statusCode" => 200,
                "error" => false,
                "data" => $branches,
                'message' => 'Retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function paymentIndex()
    {
        try {
            $payments = PaymentGateway::oldest('order')->get();

            return response()->json([
                "statusCode" => 200,
                "error" => false,
                "data" => $payments,
                'message' => 'Retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function sliderIndex()
    {
        try {
            $sliders = Slider::oldest('order')->get();

            return response()->json([
                "statusCode" => 200,
                "error" => false,
                "data" => $sliders,
                'message' => 'Retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function whychooseusIndex()
    {
        try {
            $whychooseus = WhyChooseUs::latest()->get();

            return response()->json([
                "statusCode" => 200,
                "error" => false,
                "data" => $whychooseus,
                'message' => 'Retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function settings()
    {
        try {
            $settings = Setting::pluck('value', 'key');

            if ($settings['site_main_logo']) {
                $settings['site_main_logo'] = asset('admin/images/setting/' . $settings['site_main_logo']);
            }

            if ($settings['site_footer_logo']) {
                $settings['site_footer_logo'] = asset('admin/images/setting/' . $settings['site_footer_logo']);
            }

            if ($settings['fav_icon']) {
                $settings['fav_icon'] = asset('admin/images/setting/' . $settings['fav_icon']);
            }

            if ($settings['banner_image']) {
                $settings['banner_image'] = asset('admin/images/setting/' . $settings['banner_image']);
            }

            if ($settings['service_image']) {
                $settings['service_image'] = asset('admin/images/setting/' . $settings['service_image']);
            }

            if ($settings['affiliated_image']) {
                $settings['affiliated_image'] = asset('admin/images/setting/' . $settings['affiliated_image']);
            }

            if ($settings['coe_image']) {
                $settings['coe_image'] = asset('admin/images/setting/' . $settings['coe_image']);
            }

            if ($settings['about_page_image']) {
                $settings['about_page_image'] = asset('admin/images/setting/' . $settings['about_page_image']);
            }

            if ($settings['contact_page_image']) {
                $settings['contact_page_image'] = asset('admin/images/setting/' . $settings['contact_page_image']);
            }

            if ($settings['destination_page_image']) {
                $settings['destination_page_image'] = asset('admin/images/setting/' . $settings['destination_page_image']);
            }

            return response()->json([
                "statusCode" => 200,
                "error" => false,
                "data" => $settings,
                'message' => 'Retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function testimonialIndex()
    {
        try {
            $testimonials = Testimonial::oldest('order')->get();

            return response()->json([
                "statusCode" => 200,
                "error" => false,
                "data" => $testimonials,
                'message' => 'Retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function bookingStore(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'full_name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
            ]);


            if ($validation->fails()) {
                return response()->json(['statusCode' => 401, 'error' => true, 'error_message' => $validation->errors(), 'message' => 'Please fill the input field properly']);
            }

            $booking =  Booking::create([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'country' => $request->country,
                'comments' => $request->comments,
                'package_id' => $request->package_id,
            ]);

            //send email to admin
            $data = $booking;
            $package = Package::where('id', $request->package_id)->first();
            $data['package'] = $package->name ?? NULL;

            // Mail::to('sales@pdes.com.np')->send(new NotifyAdmin($data));
            //end

            return response()->json([
                "statusCode" => 200,
                "error" => false,
                'message' => 'Thank you, your enquiry has been submitted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }


    function destinationwiseFilter($slug)
    {
        try {
            $package = Destination::where('slug', $slug)->first();
            $packages = getDestinationWisePackages($package->id);
            return response()->json([
                "statusCode" => 200,
                "error" => false,
                "data" => $packages,
                'message' => 'Retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }
    public function categorywiseFilter($slug)
    {
        try {

            $category = PackageCategory::where('slug', $slug)->first();
            $packages = Package::where('package_category_id', $category->id)->where('status', 1)->with('galleries', 'destinations', 'category', 'itenaries', 'services', 'activity')->get();

            return response()->json([
                "statusCode" => 200,
                "error" => false,
                "data" => $packages,
                'message' => 'Retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function menu($id)
    {
        try {

            $nav = MenuLocation::where('location', $id)->first();
            $sitemenu = json_decode($nav->content);
            $sitemenu = $sitemenu[0];
            foreach ($sitemenu as $menu) {
                $menu->title = Menu::where('id', $menu->id)->value('title');
                $menu->name = Menu::where('id', $menu->id)->value('name');
                $menu->slug = Menu::where('id', $menu->id)->value('slug');
                $menu->target = Menu::where('id', $menu->id)->value('target');
                $menu->type = Menu::where('id', $menu->id)->value('type');
                if (!empty($menu->children[0])) {
                    foreach ($menu->children[0] as $child) {
                        $child->title = Menu::where('id', $child->id)->value('title');
                        $child->name = Menu::where('id', $child->id)->value('name');
                        $child->slug = Menu::where('id', $child->id)->value('slug');
                        $child->target = Menu::where('id', $child->id)->value('target');
                        $child->type = Menu::where('id', $child->id)->value('type');

                        if (!empty($child->children[0])) {
                            foreach ($child->children[0] as $subchild) {
                                $subchild->title = Menu::where('id', $subchild->id)->value('title');
                                $subchild->name = Menu::where('id', $subchild->id)->value('name');
                                $subchild->slug = Menu::where('id', $subchild->id)->value('slug');
                                $subchild->target = Menu::where('id', $subchild->id)->value('target');
                                $subchild->type = Menu::where('id', $subchild->id)->value('type');

                                if (!empty($subchild->children[0])) {
                                    foreach ($subchild->children[0] as $newchild) {
                                        $newchild->title = Menu::where('id', $newchild->id)->value('title');
                                        $newchild->name = Menu::where('id', $newchild->id)->value('name');
                                        $newchild->slug = Menu::where('id', $newchild->id)->value('slug');
                                        $newchild->target = Menu::where('id', $newchild->id)->value('target');
                                        $newchild->type = Menu::where('id', $newchild->id)->value('type');
                                    }
                                }
                            }
                        }
                    }
                }
            }

            return response()->json([
                "statusCode" => 200,
                "error" => false,
                "data" => $sitemenu,
                'message' => 'Retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function print($packageid)
    {
        $package = Package::where('id', $packageid)->first();
        if ($package) {
            $itineraries = ItenaryPackage::where('package_id', $package->id)->get();
            $pdf = PDF::loadView('print.index', compact('package', 'itineraries'));
            return $pdf->stream('print.pdf');
        }
    }

    public function informationDestinationWise($destination_id)
    {
        try {
            $destination = Destination::with('otherinfos')->where('id', $destination_id)->first();

            return response()->json([
                "statusCode" => 200,
                "error" => false,
                "data" => $destination,
                'message' => 'Retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function termIndex()
    {
        try {
            $terms = Terms::oldest('order')->get();

            return response()->json([
                "statusCode" => 200,
                "error" => false,
                "data" => $terms,
                'message' => 'Retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function popupIndex()
    {
        try {
            $popups = Popup::oldest('order')->where('status', 1)->get();

            return response()->json([
                "statusCode" => 200,
                "error" => false,
                "data" => $popups,
                'message' => 'Retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function subscriptionStore(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'email' => 'required|email|unique:subscriptions',
            ]);


            if ($validation->fails()) {
                return response()->json(['statusCode' => 401, 'error' => true, 'error_message' => $validation->errors(), 'message' => 'Please fill the input field properly']);
            }

            Subscription::create([
                'email' => $request->email,
            ]);

            return response()->json([
                "statusCode" => 200,
                "error" => false,
                'message' => 'Thank you, your subscription submitted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['statusCode' => 401, 'error' => true, 'message' => $e->getMessage()]);
        }
    }
}
