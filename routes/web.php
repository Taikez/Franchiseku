<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FranchisorController;
use App\Http\Controllers\NewsCategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;

/*
|-------------------------------------------------------------------------- 
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/aboutUs', function () {
    return view('aboutUs');
})->name('aboutUs');

Route::get('/admin/dashboard', function () {
    return view('admin.admin_index');
})->middleware(['auth', 'verified','admin'])->name('adminDashboard');

Route::controller(UserController::class)->group(function(){
});    

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'userDashboard'])->name('dashboard');
   
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Controller
Route::controller(AdminController::class)->group(function(){
    Route::get('/admin/login', 'login')->name('admin.login');

    Route::get('/admin/logout','destroy')->name('admin.logout');
    Route::get('/admin/profile','profile')->name('admin.profile');
    Route::get('/edit/profile','editProfile')->name('edit.profile');
    Route::post('/store/profile','storeProfile')->name('store.profile');
    Route::get('/change/password','changePassword')->name('change.password');
    Route::post('/update/password','UpdatePassword')->name('update.password');
});


Route::controller(NewsCategoryController::class)->group(function(){
    Route::get('/admin/all/news/category','AllNewsCategory')->middleware('admin')->name('all.news.category');
    Route::get('/admin/add/news/category','AddNewsCategory')->middleware('admin')->name('add.news.category');
    Route::post('/admin/post/news/category','PostNewsCategory')->middleware('admin')->name('post.news.category');
    Route::get('/delete/news/{id}','DeleteNewsCategory')->middleware('admin')->name('delete.news.category');
});


Route::controller(NewsController::class)->group(function(){
    Route::get('/admin/all/news','AllNews')->middleware('admin')->name('all.news');
    Route::get('/admin/add/news','AddNews')->middleware('admin')->name('add.news');
    Route::get('/news/detail/{id}','NewsDetail')->name('news.detail');
    Route::post('/admin/post/news','PostNews')->middleware('admin')->name('post.news');
    Route::get('/news','news')->name('news');
});


Route::controller(FranchisorController::class)->group(function(){
    Route::get('/admin/all/franchisor','AllFranchisor')->middleware('admin')->name('all.franchisor');
    Route::post('/admin/store/franchisor','StoreFranchisor')->name('store.franchisor');
    
});

Route::controller(EducationController::class)->group(function(){
    Route::get('/education', function () {
        return view('educationContent');
    })->name('educationContent');

    Route::post('/education/search', 'App\Http\Controllers\EducationController@search')->name('searchEducationContent');
});


require __DIR__.'/auth.php';
