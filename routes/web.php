<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\OurteamController;
use App\Http\Controllers\Admin\PackageCategoryController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\PaymentGatewayController;
use App\Http\Controllers\Admin\PopupController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SocialmediaController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\TermsController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\WhyChooseUsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Auth::routes();
Auth::routes(['register' => false]);

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');


//CMS routes
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {
    Route::resource('destinations', DestinationController::class);
    Route::resource('packagecategories', PackageCategoryController::class);
    Route::resource('packages', PackageController::class);

    Route::get('upload-file/{package_id}', [PackageController::class, 'galleryUpload'])->name('upload.gallery');
    Route::post('store-file/{package_id}', [PackageController::class, 'galleryUploadStore'])->name('gallery.upload.store');
    Route::get('package/delete-file/{gallery_id}', [PackageController::class, 'packageGalleryDelete'])->name('package.gallery.delete');

    Route::resource('blogcategories', BlogCategoryController::class);
    Route::resource('blogs', BlogController::class);
    Route::resource('ourteams', OurteamController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('faqs', FaqController::class);
    Route::resource('terms', TermsController::class);

    Route::resource('popups', PopupController::class);

    Route::resource('payments', PaymentGatewayController::class);
    Route::resource('branches', BranchController::class);
    Route::resource('partners', PartnerController::class);
    Route::resource('whychooseus', WhyChooseUsController::class);

    Route::resource('testimonials', TestimonialController::class);
    Route::resource('pages', PageController::class);
    Route::resource('socialmedias', SocialmediaController::class);
    Route::resource('sliders', SliderController::class);
    Route::get('inquirypersons', [InquiryController::class, 'index'])->name('inquirypersons.index');
    Route::delete('inquirypersons/{inquiryperson}', [InquiryController::class, 'destroy'])->name('inquiries.destroy');

    Route::get('subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::delete('subscriptions/{subscription}', [SubscriptionController::class, 'destroy'])->name('subscriptions.destroy');

    Route::get('bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('booking/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::delete('bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');

    Route::get('change-password', [AuthController::class, 'index'])->name('profile');
    Route::post('change-password', [AuthController::class, 'store'])->name('change.password');

    Route::get('settings', [SettingController::class, 'edit'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');

    Route::get('menus/{id?}', [MenuController::class, 'index'])->name('menu.index');
    Route::post('create-menu', [MenuController::class, 'store'])->name('menu.create');

    Route::get('add-post-to-menu', [MenuController::class, 'addPostToMenu'])->name('menu.addpost');
    Route::get('add-page-to-menu', [MenuController::class, 'addPageToMenu'])->name('menu.addpage');
    Route::get('add-package-to-menu', [MenuController::class, 'addPackageToMenu'])->name('menu.addpackage');
    Route::get('add-destination-to-menu', [MenuController::class, 'addDestinationToMenu'])->name('menu.adddestination');
    Route::get('add-custom-link', [MenuController::class, 'addCustomLink'])->name('menu.addcustom');

    Route::get('update-menu', [MenuController::class, 'updateMenu'])->name('menu.updatemenu');
    Route::post('update-menuitem/{id}', [MenuController::class, 'updateMenuItem'])->name('menu.updateitem');
    Route::get('delete-menuitem/{id}/{key}/{in?}', [MenuController::class, 'deleteMenuItem'])->name('menu.deleteitem');
    Route::get('delete-menu/{id}', [MenuController::class, 'destroy'])->name('menu.deletemenu');
});

Route::get('fileremove/{id}/{entity}/{folder}/{column}', [SettingController::class, 'globalFile'])->name('globalfile.destroy');
Route::get('/autocomplete-search', [SettingController::class, 'autocompleteSearch'])->name('autocomplete.search');
