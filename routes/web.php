<?php

use App\Http\Controllers\admin\CKEditorController;
use App\Http\Controllers\admin\CommentsController;
use App\Http\Controllers\admin\FaqController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\admin\MenuController;
use App\Http\Controllers\admin\PagesController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\admin\GalleryController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\FixedPagesController;
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

Route::get('/', function () {
    return view('welcome');
});

/* ADMIN */
Route::controller(loginController::class)->prefix("admin")->group(function (){
    Route::get("/", 'index');
    Route::post("", 'check')->name("login.check");
});


Route::prefix("admin")->name("admin.")->middleware("auth.control")->group(function(){

    /* CKEDITOR IMAGE UPLOAD */
    Route::post('image_upload', [CKEditorController::class, 'upload'])->name('ckeditor.upload');

    /* USERS */
    Route::post('users/deletePicture', [UsersController::class, 'deletePicture']);
    Route::post('users/status', [UsersController::class, 'status']);
    Route::get("logout", [UsersController::class, 'logout']);
    Route::resource('users', UsersController::class);

    /* PAGES */
    Route::post('pages/deletePicture', [PagesController::class, 'deletePicture']);
    Route::post('pages/status', [PagesController::class, 'status']);
    Route::resource('pages', PagesController::class);

    /* MENUS */
    Route::post('menus/deletePicture', [MenuController::class, 'deletePicture']);
    Route::post('menus/status', [MenuController::class, 'status']);
    Route::resource("menus", MenuController::class);

    /* COMMENTS */
    Route::post('comments/deletePicture', [CommentsController::class, 'deletePicture']);
    Route::post('comments/status', [CommentsController::class, 'status']);
    Route::resource("comments", CommentsController::class);

    /* PRODUCTS */
    Route::post('products/deletePicture', [ProductController::class, 'deletePicture']);
    Route::post('products/status', [ProductController::class, 'status']);
    Route::post('products/sortable', [ProductController::class, 'sortable']);
    Route::resource("products", ProductController::class);

    /* FAQ */
    Route::post('faq/deletePicture', [FaqController::class, 'deletePicture']);
    Route::post('faq/status', [FaqController::class, 'status']);
    Route::resource("faq", FaqController::class);

    /* GALLERY */
    Route::post('gallery/deletePicture', [GalleryController::class, 'deletePicture']);
    Route::post('gallery/status', [GalleryController::class, 'status']);
    Route::resource("gallery", GalleryController::class);

    /* BLOG */
    Route::post('blog/deletePicture', [BlogController::class, 'deletePicture']);
    Route::post('blog/status', [BlogController::class, 'status']);
    Route::post('blog/sortable', [BlogController::class, 'sortable']);
    Route::resource("blog", BlogController::class);

    /* CATEGORY */
    Route::post('category/deletePicture', [CategoryController::class, 'deletePicture']);
    Route::post('category/status', [CategoryController::class, 'status']);
    Route::resource("category", CategoryController::class);

    /* SERVICE */
    Route::post('service/deletePicture', [ServiceController::class, 'deletePicture']);
    Route::post('service/status', [ServiceController::class, 'status']);
    Route::post('service/sortable', [ServiceController::class, 'sortable']);
    Route::resource("service", ServiceController::class);

    /* FIXED PAGES */
    Route::resource("fixedpages", FixedPagesController::class);
    Route::post('fixedpages/deletePicture', [FixedPagesController::class, 'deletePicture']);

    /* SETTING */
    Route::prefix("setting")->name("setting.")->group(function() {
        Route::controller(SettingController::class)->group(function () {
            Route::get("/contact", 'contact');
            Route::post("contactStore", 'contactStore')->name("contactStore");
            Route::get("/social", 'social');
            Route::post("socialStore", 'socialStore')->name("socialStore");
        });
    });

    /* ERROR PAGES */
    Route::get("404", function (){
        return view("admin.error.404");
    })->name("404");



});


