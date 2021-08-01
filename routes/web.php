<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\PostController;

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

/*Route::get('/', function () {
    return view('frontend/home');
});*/
Route::get('/',[SiteController::class,'index'])->name('home');

Route::prefix('auth')->name('user.')->group(function (){
    Route::get('/signup',[AuthController::class,'create'])->name('signup');
    Route::post('/signup',[AuthController::class,'store'])->name('signup');
    Route::get('/login',[AuthController::class,'login_form'])->name('sign_in');
    Route::post('/login',[AuthController::class,'login'])->name('login');
});
Route::prefix('admin')->middleware('auth')->group(function (){
    Route::get('/dashboard',[AuthController::class,'index'])->name('user.dashboard');
    Route::post('/logout',[AuthController::class,'logout'])->name('user.logout');
    //The category routes
    Route::prefix('/category')->name('category.')->group(function(){
        Route::get('/add',[CategoryController::class,'create'])->name('form');
        Route::post('/add',[CategoryController::class,'store'])->name('add');
        Route::get('/edit/{id}',[CategoryController::class,'edit'])->name('edit');
        Route::post('/edit/{id}',[CategoryController::class,'update'])->name('update');
        Route::post('/delete/{id}',[CategoryController::class,'destroy'])->name('delete');
        Route::get('/manage',[CategoryController::class,'index'])->name('manage');
    });
    //The post routes
    Route::prefix('/post')->name('post.')->group(function(){
        Route::get('/add',[PostController::class,'create'])->name('form');
        Route::post('/add',[PostController::class,'store'])->name('add');
        Route::get('/edit/{id}',[PostController::class,'edit'])->name('edit');
        Route::post('/edit/{id}',[PostController::class,'update'])->name('update');
        Route::post('/delete/{id}',[PostController::class,'destroy'])->name('delete');
        Route::get('/manage',[PostController::class,'index'])->name('manage');
    });
    Route::prefix('/post')->name('post.')->group(function(){
        Route::resources([
            'categories'=>CategoryController::class,
            'posts'=>PostController::class,
        ]);
    });

});
