<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\BlogController; 
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FrequentlyAskedController;
use App\Http\Controllers\Admin\HomePageBlogController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\User\UserBlogController;
use App\Http\Controllers\User\UserCategoryController;
use App\Http\Controllers\User\UserCompanyController;
use App\Http\Controllers\User\UserFrequentlyAskedController;
use App\Http\Controllers\User\UserHomePageBlogController;
use App\Http\Controllers\User\UserProjectController;
use App\Http\Controllers\User\UserTestimonialController;
use App\Models\Contact;
use Illuminate\Support\Facades\Route;

 
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
 
// blog api 
Route::get("blog", [UserBlogController::class, 'index']);
Route::get("blog/{id}", [BlogController::class, 'show']);
// category api 
Route::get("category", [UserCategoryController::class, 'index']);
Route::get("category/{id}", [UserCategoryController::class, 'show']);
// company api 
Route::get("company", [UserCompanyController::class, 'index']);
Route::get("company/{id}", [UserCompanyController::class, 'show']);
// frequently ask api 
Route::get("faq", [UserFrequentlyAskedController::class, 'index']);
Route::get("faq/{id}", [UserFrequentlyAskedController::class, 'show']);
// contact  
Route::get("contact", [ContactController::class, 'store']);
// homepage blog api 
Route::get("homepage-blog", [UserHomePageBlogController::class, 'index']);
// Route::get("homepage-blog/{id}", [UserHomePageBlogController::class, 'show']);
// project api 
Route::get("project", [UserProjectController::class, 'index']);
Route::get("project/{id}", [UserProjectController::class, 'show']);
// testimonial api 
Route::get("testimonial", [UserTestimonialController::class, 'index']);
Route::get("testimonial/{id}", [UserTestimonialController::class, 'show']);
// adming route 
Route::group(['middleware' => 'adminPermission', 'prefix' => 'admin'], function () {
    // blog api 
    Route::resource("category", CategoryController::class)->only([
        'index',
        'show',
        'store',
        'update',
        'destroy',

    ]);
    // blog api 
    Route::resource("blog", BlogController::class)->only([
        'index',
        'show',
        'store',
        'update',
        'destroy',

    ]);
    // contact 
    Route::resource("contact", ContactController::class)->only([
        'index',
        'show',
        'store',
        'update',
        'destroy',

    ]);
    // company logo title 
    Route::resource("company", CompanyController::class)->only([
        'index',
        'show',
        'store',
        'update',
        'destroy',
    ]);
   
    // faq route 
    Route::resource("faq", FrequentlyAskedController::class)->only([
        'index',
        'show',
        'store',
        'update',
        'destroy',

    ]);
    // testomonial route 
    Route::resource("testimonial", TestimonialController::class)->only([
        'index',
        'show',
        'store',
        'update',
        'destroy',

    ]);
    // testomonial route 
    Route::resource("homeblog", HomePageBlogController::class)->only([
        'index',
        'show',
        'store',
        'update',
        'destroy',

    ]);
    // project route 
    Route::resource("project",ProjectController::class)->only([
        'index',
        'show',
        'store',
        'update',
        'destroy',
    ]);
    // dashboard page 
     // project route 
     Route::resource("dashboard",DashboardController::class)->only([
        'index',
        
    ]);
});
//    test monial 
 // testomonial route 
 Route::resource("seo", SeoController::class)->only([
    'index',
    'show',
    'store',
    'update',
    'destroy',

]);
 // banner route 
 Route::resource("banner",BannerController::class)->only([
    'index',
    'show',
    'store',
    'update',
    'destroy',

]);