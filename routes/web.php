<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ImageManagerController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\TourCategory;
use App\Http\Controllers\Admin\TourController;
use App\Http\Controllers\Admin\WebsiteSettings;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\SummernoteImageupload;
use App\Http\Controllers\ToursController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/page', [PageController::class,'page'])->name('page');
Route::get('/tours', [ToursController::class,'tours'])->name('tours');
Route::get('/blogs', [BlogsController::class,'blogs'])->name('blogs');
Route::post('/newsletter/store', [NewsletterController::class, 'store'])->name('newsletter.store');
Route::post('/inquiry/store', [InquiryController::class, 'store'])->name('inquiry.store');
Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');

Route::get('/generate-pdf/{id}', [PdfController::class, 'savePDF'])->name('generatePdf');
Route::prefix('tour')->group( function () {
    Route::get('/search', [ToursController::class, 'search'])->name('tour.search');
    Route::get('/category/{slug}', [ToursController::class,'tourCategory'])->name('tour.category');
    Route::get('/{slug}', [ToursController::class,'tourDetails'])->name('tour.details');

});
Route::prefix('blog')->group( function () {
    Route::get('/{slug}', [BlogsController::class,'blogDetails'])->name('blog.details');
});


Route::prefix('admin')->group( function () {
    Auth::routes();
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/image-manager', [ImageManagerController::class, 'index'])->name('admin.image-manager');
    Route::post('/image-upload', [ImageManagerController::class, 'image_upload'])->name('admin.imageUpload');
    Route::post('/image-update/{id}', [ImageManagerController::class, 'image_update'])->name('admin.image_update');
    Route::get('/image-delete/{id}', [ImageManagerController::class, 'delete'])->name('admin.image_delete');
    Route::group(['prefix'=>'tour'],function(){
        Route::group(['prefix'=>'category'],function(){
            Route::get('/index',[TourCategory::class,'index'])->name('admin.tour.category.index');
            Route::get('/create',[TourCategory::class,'create'])->name('admin.tour.category.create');
            Route::post('/store',[TourCategory::class,'store'])->name('admin.tour.category.store');
            Route::get('/edit/{id}',[TourCategory::class,'edit'])->name('admin.tour.category.edit');
            Route::post('/update/{id}',[TourCategory::class,'update'])->name('admin.tour.category.update');
            Route::get('/delete/{id}',[TourCategory::class,'delete'])->name('admin.tour.category.delete');
           
        });
        Route::get('/index',[TourController::class,'index'])->name('admin.tour.index');
        Route::get('/create',[TourController::class,'create'])->name('admin.tour.create');
        Route::post('/store',[TourController::class,'store'])->name('admin.tour.store');
        Route::get('/edit/{id}',[TourController::class,'edit'])->name('admin.tour.edit');
        Route::post('/update/{id}',[TourController::class,'update'])->name('admin.tour.update');
        Route::get('/delete/{id}',[TourController::class,'delete'])->name('admin.tour.delete');
        Route::post('/toggle-status', [TourController::class, 'toggleStatus'])
        ->name('admin.tour.toggle-status');
        Route::post('/{id}/toggle-featured',[TourController::class, 'toggleFeatured'])->name('admin.tour.toggleFeatured');
    });
    Route::group(['prefix'=>'website'],function(){
        Route::get('/settings',[WebsiteSettings::class,'websiteSettings'])->name('admin.website.settings');
        Route::get('/change-password',[WebsiteSettings::class,'changePassword'])->name('admin.website.change-password');
        Route::post('/settings-update',[WebsiteSettings::class,'websiteSettingsUpdate'])->name('admin.website.settings-update');
        Route::post('/password-update/{id}',[WebsiteSettings::class,'passwordUpdate'])->name('admin.website.password-update');
    });
    Route::group(['prefix'=>'page'], function(){
        Route::get('/pages',[AdminPageController::class,'index'])->name('admin.page.pages');
        Route::get('/create',[AdminPageController::class,'create'])->name('admin.page.create');
        Route::get('/edit/{id}',[AdminPageController::class,'edit'])->name('admin.page.edit');
        Route::get('/delete/{id}',[AdminPageController::class,'delete'])->name('admin.page.delete');
        Route::post('/status-toggle', [AdminPageController::class, 'toggleStatus'])->name('admin.page.toggle-status');

        Route::post('/store',[AdminPageController::class,'store'])->name('admin.page.store');
        Route::post('/update/{id}',[AdminPageController::class,'update'])->name('admin.page.update');
    });
    Route::group(['prefix'=>'blog'],function(){
        Route::get('/blogs',[BlogController::class,'index'])->name('admin.blog.blogs');
        Route::get('/create',[BlogController::class,'create'])->name('admin.blog.create');
        Route::get('/edit/{id}',[BlogController::class,'edit'])->name('admin.blog.edit');
        Route::get('/delete/{id}',[BlogController::class,'delete'])->name('admin.blog.delete');
        Route::post('/store',[BlogController::class,'store'])->name('admin.blog.store');
        Route::post('/update/{id}',[BlogController::class,'update'])->name('admin.blog.update');
        Route::post('/status-toggle', [BlogController::class, 'toggleStatus'])->name('admin.blog.toggle-status');
    });
    Route::group(['prefix'=>'menu'], function () {

        Route::get('/index', [MenuController::class, 'index'])->name('admin.menu.index');
        Route::get('/create', [MenuController::class, 'create'])->name('admin.menu.create');
        Route::get('/edit/{group_id}', [MenuController::class, 'edit'])->name('admin.menu.edit');
        Route::post('/menu-group', [MenuController::class, 'menuGroupStore'])->name('admin.menu-group.store');
        Route::post('/menu-store', [MenuController::class, 'menuStore'])->name('admin.menu.store');
        Route::post('/menu-group-update/{id}', [MenuController::class, 'menuGroupUpdate'])->name('admin.menu-group.update');
        Route::post('/menu-update/{id}', [MenuController::class, 'menuUpdate'])->name('admin.menu.update');
        Route::get('/delete/{id}',[MenuController::class,'delete'])->name('admin.menu.delete');
    });
    Route::group(['prefix'=>'newsletter'], function () {
        Route::get('/subscribers', [NewsletterController::class, 'index'])->name('admin.newsletter.index');
        Route::get('/delete/{id}',[NewsletterController::class,'delete'])->name('admin.subscriber.delete');
    });
    Route::group(['prefix'=>'enquiry'], function () {
        Route::get('/index', [InquiryController::class, 'index'])->name('admin.enquiry.index');
        Route::get('/delete/{id}',[InquiryController::class,'delete'])->name('admin.enquiry.delete');
    });
    Route::group(['prefix'=>'booking'], function () {
        Route::get('/index', [AdminBookingController::class, 'index'])->name('admin.bookings.index');
        Route::get('/delete/{id}',[AdminBookingController::class,'delete'])->name('admin.bookings.delete');
        Route::get('/edit/{id}',[AdminBookingController::class,'edit'])->name('admin.bookings.edit');
        Route::post('/update/{id}',[AdminBookingController::class,'update'])->name('admin.bookings.update');
        Route::get('/view/{id}',[AdminBookingController::class,'view'])->name('admin.bookings.view');
        Route::get('/tour/{id}',[AdminBookingController::class,'tourBookings'])->name('admin.bookings.tourBookings');
    });
});
Route::group(['prefix' => 'api'], function () {
    Route::get('/users', [UserController::class, 'users']);
    Route::get('/pages', [UserController::class, 'pages']);
    Route::get('/tours', [UserController::class, 'tours']);
    Route::get('/blogs', [UserController::class, 'blogs']);
});

Route::post('/summernote-upload', [SummernoteImageupload::class, 'summernoteUpload'])
    ->name('summernote.upload');
