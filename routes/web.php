<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;

use App\Http\Controllers\AuthenticationController;

Route::get('login',[AuthenticationController::class,'login'])->name('login');
Route::post('post-login',[AuthenticationController::class,'postLogin'])->name('postLogin');
Route::get('logout',[AuthenticationController::class,'logout'])->name('logout');



Route::group(
    ['prefix' => 'admin','as' => 'admin.', 'middleware' => 'role'], 
    function () {
    

    /** Products */
    Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
        Route::get('/', [ProductController::class,'index'])->name('index');
        
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



