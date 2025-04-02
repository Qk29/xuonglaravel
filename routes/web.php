<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;

use App\Http\Controllers\AuthenticationController;

use App\Models\Product;

Route::get('/test-product', function () {
    return Product::latest()->first();
});


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
        
    });

    /** Users */
    Route::group(['prefix'=>'users','as'=>'users.'],function(){
        Route::get('/',[UserController::class,'index'])->name('index');
    });


});



