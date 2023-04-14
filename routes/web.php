<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\MainPostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController as SecondCategoryController;
use App\Http\Controllers\TagController as SecondTagController;
use App\Http\Controllers\SearchController;
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

Route::get('/',[HomeController::class,'index'])->name('posts.home');
Route::get('/article/{slug}',[HomeController::class,'show'])->name('posts.single');
Route::get('/category/{slug}',[SecondCategoryController::class,'show'])->name('categories.single');
Route::get('/tag/{slug}', [SecondTagController::class,'show'])->name('tags.single');
Route::get('/search',[SearchController::class,'index'])->name('search');

Route::group(['prefix' => 'admin','middleware'=>'admin'], function () {
    Route::get('/',[MainController::class,'index'])->name('admin.index');
    Route::resource('/categories',CategoryController::class);
    Route::resource('/tags',TagController::class);
    Route::resource('/post',MainPostController::class);
});
Route::group(['middleware'=>'guest'],function(){
    Route::get('/register',[UserController::class,'create'])->name('register.create');
    Route::post('/register',[UserController::class,'store'])->name('register.store');
    Route::get('/login',[UserController::class,'loginForm'])->name('login.create');
    Route::post('/login',[UserController::class,'login'])->name('login');
});
Route::group(['middleware'=>'auth'],function(){
    Route::get('/logout',[UserController::class,'logout'])->name('logout');
    Route::get('/home',[UserController::class,'home'])->name('home');
});
