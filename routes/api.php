<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//destinations
Route::get('destinations', [ApiController::class, 'destinationIndex'])->name('destinations');
Route::get('destination/{slug}', [ApiController::class, 'singleDestination'])->name('destination.single');

//category
Route::get('packagecategories', [ApiController::class, 'packageCategoryIndex'])->name('packagecategories');
Route::get('packagecategory/{slug}', [ApiController::class, 'singlePackageCategory'])->name('packagecategorie.single');

//packages
Route::get('packages', [ApiController::class, 'packageIndex'])->name('packages');
Route::get('package/{slug}', [ApiController::class, 'singlePackage'])->name('package.single');

//blogs
Route::get('blogs', [ApiController::class, 'blogIndex'])->name('blogs');
Route::get('blog/{slug}', [ApiController::class, 'singleBlog'])->name('blog.single');


//services
Route::get('services', [ApiController::class, 'serviceIndex'])->name('services');
Route::get('service/{slug}', [ApiController::class, 'singleService'])->name('service.single');

//ourteams
Route::get('ourteams', [ApiController::class, 'ourTeamIndex'])->name('ourteams');

//faqs
Route::get('faqs', [ApiController::class, 'faqIndex'])->name('faqs');

//inquiry
Route::post('inquiries', [ApiController::class, 'inquiryStore'])->name('inquiries');

//pages
Route::get('pages', [ApiController::class, 'pageIndex'])->name('pages');
Route::get('page/{slug}', [ApiController::class, 'singlePage'])->name('page.single');

//social medias
Route::get('socialmedias', [ApiController::class, 'socialMediaIndex'])->name('socialmedias');

//partners
Route::get('partners', [ApiController::class, 'partnerIndex'])->name('partners');

//branches
Route::get('branches', [ApiController::class, 'branchIndex'])->name('branches');

//payment Gateways
Route::get('paymentgateways', [ApiController::class, 'paymentIndex'])->name('payments');

//whychooseus
Route::get('whychooseus', [ApiController::class, 'whychooseusIndex'])->name('whychooseus');

//settings
Route::get('settings', [ApiController::class, 'settings'])->name('settings');

//testimonials
Route::get('testimonials', [ApiController::class, 'testimonialIndex'])->name('testimonials');

//sliders
Route::get('sliders', [ApiController::class, 'sliderIndex'])->name('sliders');

//booking
Route::post('bookings', [ApiController::class, 'bookingStore'])->name('bookings');

//filter destinationwise
Route::get('tourtype/{slug}', [ApiController::class, 'destinationwiseFilter'])->name('destinations.packages');

//categorywise packages
Route::get('categorywisepackage/{categoryslug}', [ApiController::class, 'categorywiseFilter'])->name('categories.packages');

//menus
Route::get('menus/{id}', [ApiController::class, 'menu'])->name('menu');

//print pdf
Route::get('print/{package}', [ApiController::class, 'print'])->name('print');

//information destinationwise
Route::get('information/{destination_id}', [ApiController::class, 'informationDestinationWise'])->name('information');

//terms
Route::get('terms', [ApiController::class, 'termIndex'])->name('terms');

//popup
Route::get('popup', [ApiController::class, 'popupIndex'])->name('popup');

//subscription
Route::post('subscription', [ApiController::class, 'subscriptionStore'])->name('subscription.store');
