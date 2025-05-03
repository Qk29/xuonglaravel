<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;




use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;

use App\Http\Controllers\Client\ClientHomeController;

use App\Http\Controllers\Auth\AuthenticationController;

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;


Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');


Route::get('/', [ClientHomeController::class, 'index'])->name('client.home');
Route::get('product-detail/{id}', [ClientHomeController::class, 'productDetail'])->name('client.productDetail');
Route::get('/search', [ClientHomeController::class, 'search'])->name('client.search');



Route::get('login',[AuthenticationController::class,'login'])->name('login');
Route::post('post-login',[AuthenticationController::class,'postLogin'])->name('postLogin');
Route::get('logout',[AuthenticationController::class,'logout'])->name('logout');
Route::get('register',[AuthenticationController::class,'register'])->name('register');
Route::post('postRegister',[AuthenticationController::class,'postRegister'])->name('postRegister');



Route::group(
    ['prefix' => 'admin','as' => 'admin.', 'middleware' => 'role'], 
    function () {
    
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');
   

    /** Products */
    Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
        Route::get('/', [ProductController::class,'index'])->name('index');
        Route::get('product-add',[ProductController::class,'addProduct'])->name('addProduct');
        Route::post('postAddProduct',[ProductController::class,'handleAddProduct'])->name('handleAddProduct');
        Route::get('editProduct/{id}',[ProductController::class,'editProduct'])->name('editProduct');
        Route::put('postUpdateProduct/{id}',[ProductController::class,'postUpdateProduct'])->name('postUpdateProduct');
        Route::delete('deleteProduct/{id}',[ProductController::class,'deleteProduct'])->name('deleteProduct');

    });

    /** Categories */
    Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
        Route::get('/', [CategoryController::class,'index'])->name('index');
        Route::get('add', [CategoryController::class,'addCategory'])->name('addCategory');
        Route::post('postAddCategory', [CategoryController::class,'handleAddCategory'])->name('handleAddCategory');
        Route::get('edit/{id}', [CategoryController::class,'editCategory'])->name('editCategory');
        Route::put('postUpdateCategory/{id}', [CategoryController::class,'postUpdateCategory'])->name('postUpdateCategory');
        Route::delete('deleteCategory/{id}', [CategoryController::class,'deleteCategory'])->name('deleteCategory');
    });

    /** Users */
    Route::group(['prefix'=>'users','as'=>'users.'],function(){
        Route::get('/',[UserController::class,'index'])->name('index');
        Route::get('edit/{id}',[UserController::class,'editUser'])->name('editUser');
        Route::put('postUpdateUser/{id}',[UserController::class,'postUpdateUser'])->name('postUpdateUser');
        Route::delete('deleteUser/{id}',[UserController::class,'deleteUser'])->name('deleteUser');
    });


});



